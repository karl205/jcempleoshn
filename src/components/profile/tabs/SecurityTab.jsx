import { useState, useEffect } from "react";
import { updatePassword } from "../../../api/profileService";
import apiClient from "../../../api/apiClient";

export default function SecurityTab() {

    const [form, setForm] = useState({
        password_actual: "",
        password: "",
        password_confirmation: ""
    });

    const [email, setEmail] = useState("");

    const [loading, setLoading] = useState(false);
    const [message, setMessage] = useState(null);
    const [error, setError] = useState(null);

    // obtener correo del usuario
    useEffect(() => {
        const getProfile = async () => {
            try {
                const res = await apiClient.get("/profile");
                setEmail(res.data.perfil.email);
            } catch (err) {
                console.error(err);
            }
        };

        getProfile();
    }, []);

    const handleChange = (e) => {
        setForm({
            ...form,
            [e.target.name]: e.target.value
        });
    };

    const handleSave = async () => {
        try {
            setLoading(true);
            setError(null);
            setMessage(null);

            await updatePassword(form);

            setMessage("Contraseña actualizada correctamente");

            setForm({
                password_actual: "",
                password: "",
                password_confirmation: ""
            });

        } catch (err) {
            setError(err.response?.data?.message || "Error al actualizar");
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="card border-0 shadow-sm rounded-4 p-4">

            {/* 🔐 CAMBIO DE CONTRASEÑA */}
            <h6 className="fw-bold mb-3">Cambiar contraseña</h6>

            <div className="mb-2">
                <input
                    type="password"
                    name="password_actual"
                    placeholder="Contraseña actual"
                    className="form-control"
                    value={form.password_actual}
                    onChange={handleChange}
                />
            </div>

            <div className="mb-2">
                <input
                    type="password"
                    name="password"
                    placeholder="Nueva contraseña"
                    className="form-control"
                    value={form.password}
                    onChange={handleChange}
                />
            </div>

            <div className="mb-3">
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirmar contraseña"
                    className="form-control"
                    value={form.password_confirmation}
                    onChange={handleChange}
                />
            </div>

            {error && <div className="text-danger mb-2">{error}</div>}
            {message && <div className="text-success mb-2">{message}</div>}

            <button
                className="btn btn-primary mb-4"
                onClick={handleSave}
                disabled={loading}
            >
                {loading ? "Guardando..." : "Guardar cambios"}
            </button>

            <hr />

            {/* 📧 CORREO */}
            <h6 className="fw-bold mt-4 mb-3">Correo electrónico</h6>

            <div className="mb-2">
                <input
                    type="text"
                    className="form-control"
                    value={email || ""}
                    readOnly
                />
            </div>

            <small className="text-muted">
                Este es el correo asociado a tu cuenta. Actualmente no se puede modificar.
            </small>

        </div>
    );
}