import { useState } from "react";
import { updateBasic } from "../../../api/profileService";
import apiClient from "../../../api/apiClient";

export default function AccountTab({ form, setForm }) {

    const [loading, setLoading] = useState(false);
    const [message, setMessage] = useState(null);
    const [error, setError] = useState(null);

    const [showDelete, setShowDelete] = useState(false);
    const [password, setPassword] = useState("");
    const [deleting, setDeleting] = useState(false);

    // GUARDAR DATOS
    const handleSave = async () => {
        try {
            setLoading(true);
            setError(null);
            setMessage(null);

            await updateBasic({
                nombre: form?.nombre?.trim(),
                apellido: form?.apellido?.trim(),
            });

            setMessage("Datos actualizados correctamente");

            localStorage.setItem(
                "user_name",
                `${form.nombre} ${form.apellido}`
            );

            window.dispatchEvent(new Event("userUpdated"));

        } catch (err) {
            console.error("ERROR REAL:", err.response?.data);
            setError(err.response?.data?.message || "Error al guardar");
        } finally {
            setLoading(false);
        }
    };

    // ELIMINAR CUENTA
    const handleDelete = async () => {
        try {
            setError(null);

            if (!password) {
                setError("Ingrese su contraseña");
                return;
            }

            setDeleting(true);

            await apiClient.post("/profile/delete", {
                password
            });

            setMessage("Cuenta eliminada correctamente. Redirigiendo...");

            localStorage.clear();

            setTimeout(() => {
                window.location.href = "/login";
            }, 1500);

        } catch (err) {
            setError(err.response?.data?.message || "Error al eliminar cuenta");
        } finally {
            setDeleting(false);
        }
    };

    return (
        <div className="card border-0 shadow-sm rounded-4 p-4">

            {/* DATOS GENERALES */}
            <h6 className="fw-bold mb-3">Datos de cuenta</h6>

            <div className="mb-2">
                <input
                    className="form-control"
                    placeholder="Nombre"
                    value={form?.nombre || ""}
                    onChange={(e) =>
                        setForm({ ...form, nombre: e.target.value })
                    }
                />
            </div>

            <div className="mb-3">
                <input
                    className="form-control"
                    placeholder="Apellido"
                    value={form?.apellido || ""}
                    onChange={(e) =>
                        setForm({ ...form, apellido: e.target.value })
                    }
                />
            </div>

            {error && <div className="text-danger mb-2">{error}</div>}
            {message && <div className="text-success mb-2">{message}</div>}

            <button
                className="btn btn-primary mb-4"
                onClick={handleSave}
                disabled={
                    loading ||
                    !form?.nombre ||
                    !form?.apellido
                }
            >
                {loading ? "Guardando..." : "Guardar cambios"}
            </button>

            <hr />

            {/* 🗑 ELIMINAR CUENTA */}
            <h6 className="fw-bold text-danger mt-4">Eliminar cuenta</h6>

            {!showDelete && (
                <button
                    className="btn btn-outline-danger mt-2"
                    onClick={() => {
                        setShowDelete(true);
                        setError(null);
                    }}
                >
                    Eliminar cuenta
                </button>
            )}

            {showDelete && (
                <div className="mt-3">

                    <div className="alert alert-warning py-2">
                        ⚠ Esta acción no se puede deshacer.
                    </div>

                    <input
                        type="password"
                        className="form-control mb-2"
                        placeholder="Ingrese su contraseña"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />

                    <div className="d-flex gap-2">
                        <button
                            className="btn btn-danger"
                            onClick={handleDelete}
                            disabled={deleting}
                        >
                            {deleting ? "Eliminando..." : "Confirmar eliminación"}
                        </button>

                        <button
                            className="btn btn-secondary"
                            onClick={() => {
                                setShowDelete(false);
                                setPassword("");
                                setError(null);
                            }}
                        >
                            Cancelar
                        </button>
                    </div>

                </div>
            )}

        </div>
    );
}