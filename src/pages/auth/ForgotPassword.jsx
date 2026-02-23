import { useState } from "react";
import { useNavigate } from "react-router-dom";
import PublicLayout from "../../layouts/PublicLayout";
import "../../styles/login.css";
import api from "../../api/axios";

export default function ForgotPassword() {
  const navigate = useNavigate();
  const [email, setEmail] = useState("");
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);

  const validateEmail = (value) => {
    if (!value) return "El correo es obligatorio";
    if (!/^\S+@\S+\.\S+$/.test(value)) return "Correo inválido";
    return "";
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    const emailError = validateEmail(email);
    if (emailError) {
      setError(emailError);
      return;
    }

    setLoading(true);

    try {
      await api.post("/forgot-password", { email });

      navigate("/verify-code", { state: { email } });

    } catch (err) {
      setError(
        err.response?.data?.message || "Error enviando código"
      );
    } finally {
      setLoading(false);
    }
  };

  return (
    <PublicLayout>
      <div className="login-container">
        <form className="login-card" onSubmit={handleSubmit}>
          <h2>Recuperar contraseña</h2>

          {error && <p className="error">{error}</p>}

          <div className={`input-group ${error ? "invalid" : ""}`}>
            <input
              type="email"
              placeholder="Correo electrónico"
              value={email}
              onChange={(e) => {
                setEmail(e.target.value);
                setError("");
              }}
            />
          </div>

          <button type="submit" disabled={loading}>
            {loading ? "Enviando..." : "Enviar código"}
          </button>
        </form>
      </div>
    </PublicLayout>
  );
}