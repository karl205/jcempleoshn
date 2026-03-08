import { useEffect, useState } from "react";

export default function UsuarioModal({
    show,
    onClose,
    onSave,
    roles = [],
    usuario = null
}) {

    const [form, setForm] = useState({
        nombre: "",
        apellido: "",
        email: "",
        password: "",
        rol: "",
        estado: true
    });

    useEffect(() => {
        if (usuario) {
            setForm({
                nombre: usuario.nombre || "",
                apellido: usuario.apellido || "",
                email: usuario.email || "",
                password: "",
                rol: usuario.rol_id || "",
                estado: usuario.estado === 1
            });
        } else {
            setForm({
                nombre: "",
                apellido: "",
                email: "",
                password: "",
                rol: "",
                estado: true
            });
        }
    }, [usuario, show]);

    if (!show) return null;

    const handleChange = (e) => {
        const { name, value, type, checked } = e.target;
        
        setForm({
            ...form,
            [name]: type === "checkbox"
                ? checked
                : name === "rol"
                ? parseInt(value)
                : value
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        console.log("FORM ENVIADO:", form);
        
        onSave(form);
    };

    return (
        <div className="modal-overlay">
            <div className="modal-card">

                <div className="modal-header">
                    <h5>{usuario ? "Editar Usuario" : "Crear Usuario"}</h5>
                    <button className="modal-close" onClick={onClose}>✕</button>
                </div>

                <form onSubmit={handleSubmit} className="modal-body">

                    <div className="row g-3">

                        <div className="col-md-6">
                            <label>Nombre</label>
                            <input
                                className="form-control"
                                name="nombre"
                                value={form.nombre}
                                onChange={handleChange}
                                required
                            />
                        </div>

                        <div className="col-md-6">
                            <label>Apellido</label>
                            <input
                                className="form-control"
                                name="apellido"
                                value={form.apellido}
                                onChange={handleChange}
                                required
                            />
                        </div>

                        <div className="col-md-6">
                            <label>Email</label>
                            <input
                                className="form-control"
                                name="email"
                                type="email"
                                value={form.email}
                                onChange={handleChange}
                                required
                            />
                        </div>

                        <div className="col-md-6">
                            <label>Rol</label>
                            <select
                                className="form-select"
                                name="rol"
                                value={form.rol}
                                onChange={handleChange}
                                required
                            >
                                <option value="">Seleccione...</option>

                                {roles.map(r => (

                                    <option key={r.id} value={r.id}>
                                        {r.descripcion}
                                    </option>

                                ))}

                            </select>
                        </div>

                        {!usuario && (
                            <div className="col-md-12">
                                <label>Contraseña</label>
                                <input
                                    className="form-control"
                                    type="password"
                                    name="password"
                                    value={form.password}
                                    onChange={handleChange}
                                    required
                                />
                            </div>
                        )}

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
    );
}