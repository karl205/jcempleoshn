import { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { login } from "../../api/authService";
import PublicLayout from "../../layouts/PublicLayout";
import "../../styles/login.css";
import { FiEye, FiEyeOff } from "react-icons/fi";
import { useAuth } from "../../context/AuthContext";
import { hasPermission } from "../../utils/permissions";

export default function Login() {
    const navigate = useNavigate();
    const { setUser, setRoles } = useAuth();

    const [form, setForm] = useState({
        email: "",
        password: "",
        remember: false
    });

    const [errors, setErrors] = useState({});
    const [showPassword, setShowPassword] = useState(false);
    const [loading, setLoading] = useState(false);

    // 🔹 Cargar email recordado
    useEffect(() => {
        const remembered = localStorage.getItem("rememberedEmail");
        if (remembered) {
            setForm((prev) => ({ ...prev, email: remembered, remember: true }));
        }
    }, []);

    // 🔹 Validación en tiempo real (campo por campo, al escribir)
    const validate = (name, value) => {
        let error = "";

        if (name === "email") {
            if (!value) error = "El correo es obligatorio";
            else if (!/^\S+@\S+\.\S+$/.test(value))
                error = "Correo inválido";
        }

        if (name === "password") {
            if (!value) error = "La contraseña es obligatoria";
            else if (value.length < 6)
                error = "Mínimo 6 caracteres";
        }

        setErrors((prev) => ({
            ...prev,
            [name]: error,
        }));
    };

    // 🔹 Validación completa del formulario (al enviar)
    const validateForm = () => {
        const newErrors = {};

        if (!form.email) {
            newErrors.email = "El correo es obligatorio";
        } else if (!/^\S+@\S+\.\S+$/.test(form.email)) {
            newErrors.email = "Correo inválido";
        }

        if (!form.password) {
            newErrors.password = "La contraseña es obligatoria";
        } else if (form.password.length < 6) {
            newErrors.password = "Mínimo 6 caracteres";
        }

        return newErrors;
    };

    const handleChange = (e) => {
        const { name, value, type, checked } = e.target;

        const newValue = type === "checkbox" ? checked : value;

        setForm({
            ...form,
            [name]: newValue,
        });

        validate(name, newValue);
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        const validationErrors = validateForm();

        if (Object.keys(validationErrors).length > 0) {
            setErrors(validationErrors);
            return;
        }

        setErrors({});
        setLoading(true);

        try {
            const response = await login(form.email, form.password);

            // console.log("RESPUESTA LOGIN:", response);

            if (response.success) {
    const userData = response.data.user;
    const roles = response.data.roles || [];
    const permisos = response.data.permisos || [];
    const token = response.data.token;
    const mustChangePassword = response.data.must_change_password;

    localStorage.setItem("token", token);
    localStorage.setItem("user", JSON.stringify(userData));
    localStorage.setItem("roles", JSON.stringify(roles));
    localStorage.setItem("permisos", JSON.stringify(permisos));

    // 🔹 Recordar correo
    if (form.remember) {
        localStorage.setItem("rememberedEmail", form.email);
    } else {
        localStorage.removeItem("rememberedEmail");
    }

    setUser(userData);
    setRoles(roles);

    // 🔹 Si es contraseña temporal, obligar cambio antes de continuar
    if (mustChangePassword) {
        navigate("/change-password-required");
        return;
    }

    // redirección según rol
    if (permisos.includes("ver_dashboard")) {
        navigate("/admin");
    } else {
        navigate("/");
    }
}

        } catch (err) {
            if (err.response?.data?.code === "EMAIL_NOT_VERIFIED") {
                navigate("/verify-email", {
                    state: { email: form.email }
                });
                return;
            }

            setErrors({
                server: err.response?.data?.message || "Error al iniciar sesión",
            });
        } finally {
            setLoading(false);
        }
    };

    return (
        <PublicLayout>
            <div className="login-container">
                <form className="login-card" onSubmit={handleSubmit}>
                    <h2>Iniciar Sesión</h2>

                    {errors.server && (
                        <p className="error">{errors.server}</p>
                    )}

                    <div
                        className={`input-group ${errors.email
                            ? "invalid"
                            : form.email && !errors.email
                                ? "valid"
                                : ""
                            }`}
                    >
                        <input
                            type="email"
                            name="email"
                            placeholder="Correo electrónico"
                            value={form.email}
                            onChange={handleChange}
                            autoComplete="email"
                        />

                        {errors.email && (
                            <span className="error-text">{errors.email}</span>
                        )}
                    </div>

                    <div className="input-group">
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
                    </div>

                    <div className="options">
                        <label className="remember-container">
                            <input
                                type="checkbox"
                                name="remember"
                                checked={form.remember}
                                onChange={handleChange}
                            />
                            <span className="checkmark"></span>
                            Recordar correo
                        </label>

                        <a href="/forgot-password">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                    <button type="submit" disabled={loading}>
                        {loading ? "Ingresando..." : "Ingresar"}
                    </button>
                </form>
            </div>
        </PublicLayout>
    );
}