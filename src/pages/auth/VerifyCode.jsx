import { useState } from "react";
import { useNavigate, useLocation } from "react-router-dom";
import PublicLayout from "../../layouts/PublicLayout";
import "../../styles/login.css";
import api from "../../api/axios";

export default function VerifyCode() {
  const navigate = useNavigate();
  const location = useLocation();
  const email = location.state?.email || "";

  const [code, setCode] = useState("");
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();

    if (!code) {
      setError("El código es obligatorio");
      return;
    }

    setLoading(true);

    try {
      await api.post("/verify-code", { email, code });

      navigate("/reset-password", { state: { email } });

    } catch (err) {
      setError(
        err.response?.data?.message || "Código inválido"
      );
    } finally {
      setLoading(false);
    }
  };

  return (
    <PublicLayout>
      <div className="login-container">
        <form className="login-card" onSubmit={handleSubmit}>
          <h2>Verificar código</h2>

          {error && <p className="error">{error}</p>}

          <div className={`input-group ${error ? "invalid" : ""}`}>
            <input
              type="text"
              placeholder="Código recibido por correo"
              value={code}
              onChange={(e) => {
                setCode(e.target.value);
                setError("");
              }}
            />
          </div>

          <button type="submit" disabled={loading}>
            {loading ? "Verificando..." : "Verificar"}
          </button>
        </form>
      </div>
    </PublicLayout>
  );
}