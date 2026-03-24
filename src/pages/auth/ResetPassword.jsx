import { useState } from "react";
import { useNavigate, useLocation } from "react-router-dom";
import PublicLayout from "../../layouts/PublicLayout";
import "../../styles/login.css";
import { FiEye, FiEyeOff } from "react-icons/fi";
import api from "../../api/apiClient";

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

    const handleSubmit = async (e) => {
        e.preventDefault();

        if (!password || !confirmPassword) {
            setError("Todos los campos son obligatorios");
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

                    {error && <p className="error">{error}</p>}
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

                    <div className="input-group">
                        <input
                            type="password"
                            placeholder="Confirmar contraseña"
                            value={confirmPassword}
                            onChange={(e) => setConfirmPassword(e.target.value)}
                        />
                    </div>

                    <button type="submit" disabled={loading}>
                        {loading ? "Actualizando..." : "Actualizar contraseña"}
                    </button>

                </form>
            </div>
        </PublicLayout>
    );
}