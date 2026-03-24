import { useState } from "react";
import { useNavigate } from "react-router-dom";
import PublicLayout from "../../layouts/PublicLayout";
import "../../styles/login.css";
import { FiEye, FiEyeOff } from "react-icons/fi";
import api from "../../api/apiClient";

export default function Register() {
    const navigate = useNavigate();

    const [form, setForm] = useState({
        nombre: "",
        apellido: "",
        email: "",
        password: "",
        confirmPassword: ""
    });

    const [errors, setErrors] = useState({});
    const [showPassword, setShowPassword] = useState(false);
    const [loading, setLoading] = useState(false);

    const passwordRegex =
        /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&.#_-])[A-Za-z\d@$!%*?&.#_-]{8,}$/;

    const validate = (name, value) => {
        let error = "";

        if (!value) error = "Este campo es obligatorio";

        if (name === "email" && value) {
            if (!/^\S+@\S+\.\S+$/.test(value))
                error = "Correo inválido";
        }

        if (name === "password" && value) {
            if (!passwordRegex.test(value))
                error =
                    "Mínimo 8 caracteres, 1 letra, 1 número y 1 carácter especial";
        }

        if (name === "confirmPassword" && value) {
            if (value !== form.password)
                error = "Las contraseñas no coinciden";
        }

        setErrors(prev => ({
            ...prev,
            [name]: error
        }));
    };

    const handleChange = (e) => {
        const { name, value } = e.target;

        setForm({
            ...form,
            [name]: value
        });

        validate(name, value);
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        if (Object.values(errors).some(err => err)) return;

        setLoading(true);

        try {
            await api.post("/register", {
                nombre: form.nombre,
                apellido: form.apellido,
                email: form.email,
                password: form.password,
                password_confirmation: form.confirmPassword
            });

            navigate("/verify-email", {
                state: {
                    email: form.email,
                    justRegistered: true
                }
            });

        } catch (err) {
            setErrors({
                server: err.response?.data?.message || "Error al registrarse"
            });
        } finally {
            setLoading(false);
        }
    };

    const inputClass = (field) =>
        `input-group ${errors[field]
            ? "invalid"
            : form[field] && !errors[field]
                ? "valid"
                : ""
        }`;

    return (
        <PublicLayout>
            <div className="login-container">
                <form className="login-card" onSubmit={handleSubmit}>
                    <h2>Crear cuenta</h2>

                    {errors.server && (
                        <p className="error">{errors.server}</p>
                    )}

                    <div className="row-fields">

                        <div className={inputClass("nombre")}>
                            <input
                                type="text"
                                name="nombre"
                                placeholder="Nombres"
                                value={form.nombre}
                                onChange={handleChange}
                            />
                            {errors.nombre && (
                                <span className="error-text">{errors.nombre}</span>
                            )}
                        </div>

                        <div className={inputClass("apellido")}>
                            <input
                                type="text"
                                name="apellido"
                                placeholder="Apellidos"
                                value={form.apellido}
                                onChange={handleChange}
                            />
                            {errors.apellido && (
                                <span className="error-text">{errors.apellido}</span>
                            )}
                        </div>

                    </div>

                    <div className={inputClass("email")}>
                        <input
                            type="email"
                            name="email"
                            placeholder="Correo electrónico"
                            value={form.email}
                            onChange={handleChange}
                        />
                        {errors.email && (
                            <span className="error-text">{errors.email}</span>
                        )}
                    </div>

                    <div className={`input-group password-group ${errors.password ? "invalid" : form.password && !errors.password ? "valid" : ""}`}>
                        <input
                            type={showPassword ? "text" : "password"}
                            name="password"
                            placeholder="Contraseña"
                            value={form.password}
                            onChange={handleChange}
                        />
                        <div
                            className={`eye-icon ${showPassword ? "active" : ""}`}
                            onClick={() => setShowPassword(!showPassword)}
                        >
                            {showPassword ? <FiEyeOff /> : <FiEye />}
                        </div>
                        {errors.password && (
                            <span className="error-text">{errors.password}</span>
                        )}
                    </div>

                    <div className={inputClass("confirmPassword")}>
                        <input
                            type="password"
                            name="confirmPassword"
                            placeholder="Repetir contraseña"
                            value={form.confirmPassword}
                            onChange={handleChange}
                        />
                        {errors.confirmPassword && (
                            <span className="error-text">{errors.confirmPassword}</span>
                        )}
                    </div>

                    <button type="submit" disabled={loading}>
                        {loading ? "Registrando..." : "Registrarse"}
                    </button>
                </form>
            </div>
        </PublicLayout>
    );
}