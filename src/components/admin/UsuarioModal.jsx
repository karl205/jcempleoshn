import { useEffect, useState } from "react";
import { FiEye, FiEyeOff } from "react-icons/fi";

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

const reglas = [
    { id: "length",  label: "Mínimo 8 caracteres",                     test: (p) => p.length >= 8 },
    { id: "upper",   label: "Al menos una mayúscula",                   test: (p) => /[A-Z]/.test(p) },
    { id: "number",  label: "Al menos un número",                       test: (p) => /[0-9]/.test(p) },
    { id: "special", label: "Al menos un carácter especial (@#$%...)",  test: (p) => /[^A-Za-z0-9]/.test(p) },
];

export default function UsuarioModal({ show, onClose, onSave, roles = [], usuario = null }) {

    const [form, setForm] = useState({
        nombre: "",
        apellido: "",
        email: "",
        password: "",
        rol: "",
        estado: true
    });

    const [showPassword, setShowPassword] = useState(false);
    const [toast, setToast] = useState(null);

    const reglasOk = reglas.map(r => ({ ...r, ok: r.test(form.password) }));
    const todasOk  = reglasOk.every(r => r.ok);

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
        setShowPassword(false);
    }, [usuario, show]);

    const mostrarToast = (mensaje) => {
        setToast(mensaje);
        setTimeout(() => setToast(null), 3000);
    };

    if (!show && !toast) return null;

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
        if (!usuario && !todasOk) return;
        onSave(form);
        onClose();
        mostrarToast(usuario ? "Usuario actualizado exitosamente" : "Usuario creado exitosamente");
    };

    return (
        <>
            <style>{toastKeyframes}</style>

            {show && (
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
                                        <label>Contraseña temporal</label>
                                        <div style={{ position: "relative" }}>
                                            <input
                                                className="form-control"
                                                type={showPassword ? "text" : "password"}
                                                name="password"
                                                value={form.password}
                                                onChange={handleChange}
                                                required
                                                placeholder="El empleado deberá cambiarla al ingresar"
                                                style={{ paddingRight: "2.5rem" }}
                                            />
                                            <div
                                                onClick={() => setShowPassword(!showPassword)}
                                                style={{
                                                    position: "absolute",
                                                    right: "0.75rem",
                                                    top: "50%",
                                                    transform: "translateY(-50%)",
                                                    cursor: "pointer",
                                                    color: "#666"
                                                }}
                                            >
                                                {showPassword ? <FiEyeOff /> : <FiEye />}
                                            </div>
                                        </div>

                                        {form.password.length > 0 && (
                                            <ul className="password-rules mt-2">
                                                {reglasOk.map(r => (
                                                    <li key={r.id} className={r.ok ? "rule-ok" : "rule-fail"}>
                                                        {r.ok ? "✔" : "✖"} {r.label}
                                                    </li>
                                                ))}
                                            </ul>
                                        )}

                                        <small className="text-muted">
                                            El empleado será obligado a cambiar esta contraseña en su primer inicio de sesión.
                                        </small>
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
                                <button
                                    type="submit"
                                    className="btn btn-primary"
                                    disabled={!usuario && !todasOk}
                                >
                                    Guardar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            )}

            {toast && (
                <div style={toastStyle}>
                    ✅ {toast}
                </div>
            )}
        </>
    );
}