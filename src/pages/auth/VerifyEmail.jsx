import { useEffect, useState } from "react";
import { useSearchParams, useNavigate, useLocation } from "react-router-dom";
import { FiCheckCircle, FiXCircle, FiMail } from "react-icons/fi";
import PublicLayout from "../../layouts/PublicLayout";
import "../../styles/login.css";
import api from "../../api/axios";

export default function VerifyEmail() {

    const [searchParams] = useSearchParams();
    const navigate = useNavigate();
    const location = useLocation();

    const token = searchParams.get("token");
    const emailFromState = location.state?.email || "";
    const justRegistered = location.state?.justRegistered || false;

    const [status, setStatus] = useState("");
    const [loading, setLoading] = useState(false);
    const [resending, setResending] = useState(false);

    const [cooldown, setCooldown] = useState(0);

    useEffect(() => {

        // 🔹 CASO 1: Usuario viene desde enlace del correo
        if (token) {
            setStatus("verifying");
            setLoading(true);

            api.post("/verify-email", { token })
                .then(() => {
                    setStatus("verified");
                    setTimeout(() => navigate("/login"), 2500);
                })
                .catch(() => {
                    setStatus("invalid");
                })
                .finally(() => setLoading(false));

            return;
        }

        // 🔹 CASO 2: Usuario recién registrado
        if (justRegistered) {
            setStatus("registered");
            return;
        }

        // 🔹 CASO 3: Usuario bloqueado en login
        setStatus("pending");

    }, []);

    useEffect(() => {
        if (cooldown <= 0) return;

        const timer = setInterval(() => {
            setCooldown(prev => prev - 1);
        }, 1000);

        return () => clearInterval(timer);
    }, [cooldown]);

    // 🔁 Reenviar correo
    const handleResend = async () => {
        if (!emailFromState || cooldown > 0) return;

        setResending(true);

        try {
            await api.post("/resend-verification", { email: emailFromState });
            setStatus("resent");
            setCooldown(60); // ⏳ 60 segundos
        } catch (err) {
            setStatus("errorResend");
        } finally {
            setResending(false);
        }
    };

    return (
        <PublicLayout>
            <div className="login-container">
                <div className="login-card text-center">

                    <div className="verify-wrapper">

                        {status === "verifying" && (
                            <>
                                <FiMail className="verify-icon pending" />
                                <h2>Verificando tu correo...</h2>
                            </>
                        )}

                        {status === "verified" && (
                            <>
                                <FiCheckCircle className="verify-icon success" />
                                <h2>Correo verificado correctamente</h2>
                                <p>Serás redirigido al login...</p>
                            </>
                        )}

                        {status === "invalid" && (
                            <>
                                <FiXCircle className="verify-icon error" />
                                <h2>Token inválido o expirado</h2>
                                <p>Puedes solicitar un nuevo correo.</p>
                            </>
                        )}

                        {status === "registered" && (
                            <>
                                <FiMail className="verify-icon pending" />
                                <h2>Cuenta creada correctamente 🎉</h2>
                                <p>Revisa tu correo para verificar tu cuenta.</p>
                            </>
                        )}

                        {status === "pending" && (
                            <>
                                <FiMail className="verify-icon pending" />
                                <h2>Debes verificar tu correo</h2>
                                <p>Revisa tu bandeja de entrada.</p>
                            </>
                        )}

                        {status === "resent" && (
                            <>
                                <FiCheckCircle className="verify-icon success" />
                                <h2>Correo reenviado correctamente</h2>
                                <p>Revisa tu bandeja de entrada.</p>
                            </>
                        )}

                        {status === "errorResend" && (
                            <>
                                <FiXCircle className="verify-icon error" />
                                <h2>Error al reenviar el correo</h2>
                            </>
                        )}

                        {/* Botón reenviar */}
                        {!token && emailFromState && (
                            <button
                                className="mt-3"
                                onClick={handleResend}
                                disabled={resending || cooldown > 0}
                            >
                                {cooldown > 0
                                    ? `Reenviar en ${cooldown}s`
                                    : resending
                                        ? "Reenviando..."
                                        : "Reenviar correo"}
                            </button>
                        )}

                    </div>

                </div>
            </div>
        </PublicLayout>
    );
}