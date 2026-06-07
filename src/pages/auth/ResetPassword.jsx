import { useState } from "react";
import { useNavigate, useLocation } from "react-router-dom";
import PublicLayout from "../../layouts/PublicLayout";
import "../../styles/login.css";
import { FiEye, FiEyeOff } from "react-icons/fi";
import api from "../../api/apiClient";

// ── Reglas de contraseña ─────────────────────────
const reglas = [
    { id: "length",  label: "Mínimo 8 caracteres",        test: (p) => p.length >= 8 },
    { id: "upper",   label: "Al menos una mayúscula",      test: (p) => /[A-Z]/.test(p) },
    { id: "number",  label: "Al menos un número",          test: (p) => /[0-9]/.test(p) },
    { id: "special", label: "Al menos un carácter especial (@#$%...)", test: (p) => /[^A-Za-z0-9]/.test(p) },
];

export default function ResetPassword() {

    const navigate = useNavigate();
    const location = useLocation();
    const email = location.state?.email || "";

    const [password, setPassword] = useState("");
    const [confirmPassword, setConfirmPassword] = useState("");
    const [showPassword, setShowPassword] = useState(false);
    const [error, setError] = useState("");
    const [success, setSuccess] = useState("");
    const [loading, setLoading] = useState(false);

    // ── Validar reglas ───────────────────────────────
    const reglasOk = reglas.map(r => ({ ...r, ok: r.test(password) }));
    const todasOk  = reglasOk.every(r => r.ok);
    // ────────────────────────────────────────────────

    const handleSubmit = async (e) => {
        e.preventDefault();

        if (!password || !confirmPassword) {
            setError("Todos los campos son obligatorios");
            return;
        }

        if (!todasOk) {
            setError("La contraseña no cumple con todos los requisitos");
            return;
        }

        if (password !== confirmPassword) {
            setError("Las contraseñas no coinciden");
            return;
        }

        setLoading(true);
        setError("");

        try {
            await api.post("/reset-password", {
                email,
                password,
                password_confirmation: confirmPassword
            });

            setSuccess("🔐 Contraseña actualizada correctamente.");

            setTimeout(() => {
                navigate("/login");
            }, 2000);

        } catch (err) {
            setError(
                err.response?.data?.message || "Error al actualizar contraseña"
            );
        } finally {
            setLoading(false);
        }
    };

    return (
        <PublicLayout>
            <div className="login-container">
                <form className="login-card" onSubmit={handleSubmit}>

                    <h2>Nueva contraseña</h2>

                    {error   && <p className="error">{error}</p>}
                    {success && <p className="success">{success}</p>}

                    <div className="input-group password-group">
                        <input
                            type={showPassword ? "text" : "password"}
                            placeholder="Nueva contraseña"
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                        />
                        <div
                            className="eye-icon"
                            onClick={() => setShowPassword(!showPassword)}
                        >
                            {showPassword ? <FiEyeOff /> : <FiEye />}
                        </div>
                    </div>

                    {/* ── Indicador de requisitos ── */}
                    {password.length > 0 && (
                        <ul className="password-rules">
                            {reglasOk.map(r => (
                                <li
                                    key={r.id}
                                    className={r.ok ? "rule-ok" : "rule-fail"}
                                >
                                    {r.ok ? "✔" : "✖"} {r.label}
                                </li>
                            ))}
                        </ul>
                    )}

                    <div className="input-group">
                        <input
                            type="password"
                            placeholder="Confirmar contraseña"
                            value={confirmPassword}
                            onChange={(e) => setConfirmPassword(e.target.value)}
                        />
                    </div>

                    <button type="submit" disabled={loading || !todasOk}>
                        {loading ? "Actualizando..." : "Actualizar contraseña"}
                    </button>

                </form>
            </div>
        </PublicLayout>
    );
}