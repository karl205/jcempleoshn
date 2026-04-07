import { useState } from "react";
import { updatePassword } from "../../api/profileService";
import Swal from "sweetalert2";

export default function PasswordForm() {

    const [form, setForm] = useState({
        password_actual: "",
        password: "",
        password_confirmation: "",
    });

    const [loading, setLoading] = useState(false);

    const handleChange = (e) => {
        setForm({
            ...form,
            [e.target.name]: e.target.value,
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        // Validación frontend
        if (!form.password_actual || !form.password || !form.password_confirmation) {
            Swal.fire("Error", "Todos los campos son obligatorios", "error");
            return;
        }

        if (form.password.length < 8) {
            Swal.fire("Error", "La contraseña debe tener al menos 8 caracteres", "error");
            return;
        }

        if (form.password !== form.password_confirmation) {
            Swal.fire("Error", "Las contraseñas no coinciden", "error");
            return;
        }

        try {
            setLoading(true);

            await updatePassword(form);

            Swal.fire("Éxito", "Contraseña actualizada correctamente", "success");

            // limpiar formulario
            setForm({
                password_actual: "",
                password: "",
                password_confirmation: "",
            });

        } catch (error) {
            console.log(error.response?.data);

            Swal.fire(
                "Error",
                error.response?.data?.message || "Error",
                "error"
            );
        } finally {
            setLoading(false);
        }
    };

    return (
        <form onSubmit={handleSubmit} className="row g-3">

            <div>
                <label>Contraseña actual</label>
                <input
                    type="password"
                    name="password_actual"
                    placeholder="Ingrese su contraseña actual"
                    className="form-control"
                    value={form.password_actual}
                    onChange={handleChange}
                />
            </div>

            <div>
                <label>Nueva contraseña</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Ingrese nueva contraseña"
                    className="form-control"
                    value={form.password}
                    onChange={handleChange}
                />
            </div>

            <div>
                <label>Confirmar contraseña</label>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirme la contraseña"
                    className="form-control"
                    value={form.password_confirmation}
                    onChange={handleChange}
                />
            </div>

            <div className="text-end">
                <button
                    className="btn btn-primary rounded-pill"
                    disabled={loading}
                >
                    {loading ? (
                        <>
                            <span className="spinner-border spinner-border-sm me-2"></span>
                            Guardando...
                        </>
                    ) : (
                        "Cambiar contraseña"
                    )}
                </button>
            </div>

        </form>
    );
}