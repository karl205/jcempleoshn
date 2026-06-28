import { useState } from "react";
import { useNavigate } from "react-router-dom";
import PublicLayout from "../../layouts/PublicLayout";
import "../../styles/login.css";
import { FiEye, FiEyeOff } from "react-icons/fi";
import api from "../../api/apiClient";

const reglas = [
    { id: "length",  label: "Mínimo 8 caracteres",                    test: (p) => p.length >= 8 },
    { id: "upper",   label: "Al menos una mayúscula",                  test: (p) => /[A-Z]/.test(p) },
    { id: "number",  label: "Al menos un número",                      test: (p) => /[0-9]/.test(p) },
    { id: "special", label: "Al menos un carácter especial (@#$%...)", test: (p) => /[^A-Za-z0-9]/.test(p) },
];

export default function ChangePasswordRequired() {

    const navigate = useNavigate();

    const [currentPassword, setCurrentPassword] = useState("");
    const [password, setPassword]               = useState("");
    const [confirmPassword, setConfirmPassword] = useState("");
    const [showCurrent, setShowCurrent]         = useState(false);
    const [showPassword, setShowPassword]       = useState(false);
    const [error, setError]                     = useState("");
    const [success, setSuccess]                 = useState("");
    const [loading, setLoading]                 = useState(false);

    const reglasOk = reglas.map(r => ({ ...r, ok: r.test(password) }));
    const todasOk  = reglasOk.every(r => r.ok);

    const handleSubmit = async (e) => {
        e.preventDefault();

        if (!currentPassword || !password || !confirmPassword) {
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
            await api.post("/change-password", {
                current_password:          currentPassword,
                new_password:              password,
                new_password_confirmation: confirmPassword,
            });

            setSuccess("✅ Contraseña actualizada. Iniciá sesión nuevamente.");

            localStorage.removeItem("token");
            localStorage.removeItem("user");
            localStorage.removeItem("roles");
            localStorage.removeItem("permisos");

            setTimeout(() => navigate("/login"), 2000);

        } catch (err) {
            setError(err.response?.data?.message || "Error al actualizar la contraseña");
        } finally {
            setLoading(false);
        }
    };

    return (
        <PublicLayout>
            <div className="login-container">
                <form className="login-card" onSubmit={handleSubmit}>

                    <h2>Cambiar contraseña</h2>
                    <p style={{ color: "#666", fontSize: "0.9rem", marginBottom: "1rem", textAlign: "center" }}>
                        Por seguridad, debés cambiar tu contraseña temporal antes de continuar.
                    </p>

                    {error   && <p className="error">{error}</p>}
                    {success && <p className="success">{success}</p>}

                    <div className="input-group password-group">
                        <input
                            type={showCurrent ? "text" : "password"}
                            placeholder="Contraseña temporal actual"
                            value={currentPassword}
                            onChange={(e) => setCurrentPassword(e.target.value)}
                        />
                        <div className="eye-icon" onClick={() => setShowCurrent(!showCurrent)}>
                            {showCurrent ? <FiEyeOff /> : <FiEye />}
                        </div>
                    </div>

                    <div className="input-group password-group">
                        <input
                            type={showPassword ? "text" : "password"}
                            placeholder="Nueva contraseña"
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                        />
                        <div className="eye-icon" onClick={() => setShowPassword(!showPassword)}>
                            {showPassword ? <FiEyeOff /> : <FiEye />}
                        </div>
                    </div>

                    {password.length > 0 && (
                        <ul className="password-rules">
                            {reglasOk.map(r => (
                                <li key={r.id} className={r.ok ? "rule-ok" : "rule-fail"}>
                                    {r.ok ? "✔" : "✖"} {r.label}
                                </li>
                            ))}
                        </ul>
                    )}

                    <div className="input-group">
                        <input
                            type="password"
                            placeholder="Confirmar nueva contraseña"
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