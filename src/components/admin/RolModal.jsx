import { useEffect, useState } from "react";

const toastStyle = {
    position: "fixed",
    bottom: "2rem",
    right: "2rem",
    zIndex: 9999,
    backgroundColor: "#198754",
    color: "#fff",
    padding: "0.85rem 1.5rem",
    borderRadius: "8px",
    fontWeight: "500",
    fontSize: "0.9rem",
    boxShadow: "0 4px 12px rgba(0,0,0,0.2)",
    display: "flex",
    alignItems: "center",
    gap: "0.5rem",
    animation: "fadeInUp 0.3s ease"
};

const toastKeyframes = `
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}`;

export default function RolModal({ show, onClose, onSave, rol = null }) {

    const [form, setForm] = useState({
        nombre: "",
        descripcion: "",
        estado: true
    });

    const [toast, setToast] = useState(null);

    useEffect(() => {
        if (rol) {
            setForm({
                nombre: rol.nombre || "",
                descripcion: rol.descripcion || "",
                estado: rol.estado === 1
            });
        } else {
            setForm({
                nombre: "",
                descripcion: "",
                estado: true
            });
        }
    }, [rol, show]);

    const mostrarToast = (mensaje) => {
        setToast(mensaje);
        setTimeout(() => setToast(null), 3000);
    };

    if (!show && !toast) return null;

    const handleChange = (e) => {
        const { name, value, type, checked } = e.target;
        setForm({
            ...form,
            [name]: type === "checkbox" ? checked : value
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        onSave(form);
        onClose();
        mostrarToast(rol ? "Rol actualizado exitosamente" : "Rol creado exitosamente");
    };

    return (
        <>
            <style>{toastKeyframes}</style>

            {/* MODAL */}
            {show && (
                <div className="modal-overlay">
                    <div className="modal-card">

                        <div className="modal-header">
                            <h5>{rol ? "Editar Rol" : "Crear Rol"}</h5>
                            <button className="modal-close" onClick={onClose}>✕</button>
                        </div>

                        <form onSubmit={handleSubmit} className="modal-body">

                            <div className="row g-3">

                                <div className="col-md-12">
                                    <label>Nombre del Rol</label>
                                    <input
                                        className="form-control"
                                        name="nombre"
                                        value={form.nombre}
                                        onChange={handleChange}
                                        required
                                    />
                                </div>

                                <div className="col-md-12">
                                    <label>Descripción</label>
                                    <textarea
                                        className="form-control"
                                        name="descripcion"
                                        value={form.descripcion}
                                        onChange={handleChange}
                                        rows="3"
                                        required
                                    />
                                </div>

                                <div className="col-md-12">
                                    <label className="form-check">
                                        <input
                                            type="checkbox"
                                            name="estado"
                                            checked={form.estado}
                                            onChange={handleChange}
                                        />
                                        <span className="ms-2">Activo</span>
                                    </label>
                                </div>

                            </div>

                            <div className="modal-footer">
                                <button type="button" className="btn btn-light" onClick={onClose}>
                                    Cancelar
                                </button>
                                <button type="submit" className="btn btn-primary">
                                    Guardar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            )}

            {/* TOAST */}
            {toast && (
                <div style={toastStyle}>
                    ✅ {toast}
                </div>
            )}
        </>
    );
}