import { useState } from "react";
import { useNavigate } from "react-router-dom";
import PublicLayout from "../../layouts/PublicLayout";
import "../../styles/login.css";
import api from "../../api/axios";

export default function ForgotPassword() {

  const navigate = useNavigate();

  const [email, setEmail] = useState("");
  const [error, setError] = useState("");
  const [success, setSuccess] = useState("");
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();

    if (!email) {
      setError("El correo es obligatorio");
      return;
    }

    setLoading(true);
    setError("");
    setSuccess("");

    try {

      await api.post("/forgot-password", { email });

      setSuccess("📩 Código enviado correctamente. Revisa tu correo.");

      setTimeout(() => {
        navigate("/verify-code", { state: { email } });
      }, 1500);

    } catch (err) {
      setError(
        err.response?.data?.message || "Error al enviar código"
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
          {success && <p className="success">{success}</p>}

          <div className={`input-group ${error ? "invalid" : email ? "valid" : ""}`}>
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