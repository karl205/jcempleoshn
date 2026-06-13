import { useEffect, useState } from "react";
import AdminLayout from "../../layouts/AdminLayout";
import AdminDataTable from "./AdminDataTable";
import { FaEdit, FaPowerOff } from "react-icons/fa";

export default function AdminCatalogo({
    title,
    service,
    fields = [],
    catalogos = {}
}) {

    const { getAll, create, update, toggle } = service;

    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);
    const [form, setForm] = useState({});
    const [editing, setEditing] = useState(null);

    const [filtroEstado, setFiltroEstado] = useState("activo");

    // ── Modal toggle ─────────────────────────────────
    const [showToggle, setShowToggle] = useState(false);
    const [itemToggle, setItemToggle] = useState(null);
    const [comentarioToggle, setComentarioToggle] = useState("");
    // ────────────────────────────────────────────────

    const cargar = async () => {
        try {
            setLoading(true);
            const res = await getAll();
            setData(res.data.data);
        } catch (err) {
            console.error(err);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        cargar();
    }, []);

    const handleSave = async () => {
        try {
            if (editing) {
                await update(editing.id, form);
            } else {
                await create(form);
            }
            setForm({});
            setEditing(null);
            cargar();
        } catch (err) {
            console.error(err);
        }
    };

    const handleEdit = (item) => {
        setEditing(item);
        setForm(item);
    };

    // ── Abrir modal toggle ───────────────────────────
    const handleToggle = (row) => {
        setItemToggle(row);
        setComentarioToggle("");
        setShowToggle(true);
    };

    // ── Confirmar toggle ─────────────────────────────
    const confirmarToggle = async () => {
        if (!comentarioToggle.trim()) return;
        try {
            await toggle(itemToggle.id, { comentario: comentarioToggle });
            setShowToggle(false);
            setItemToggle(null);
            setComentarioToggle("");
            cargar();
        } catch (err) {
            console.error(err);
        }
    };
    // ────────────────────────────────────────────────

    const dataFiltrada = data.filter(r => {
        if (filtroEstado === "activo")   return r.estado === 1 || r.estado === true;
        if (filtroEstado === "inactivo") return r.estado === 0 || r.estado === false;
        return true;
    });

    const esActivo = itemToggle?.estado === 1 || itemToggle?.estado === true;

    return (
        <AdminLayout>

            <div className="admin-header d-flex justify-content-between mb-3">
                <h2>{title}</h2>
            </div>

            <div className="admin-card mb-3">
                <div className="d-flex gap-2 align-items-center flex-wrap">

                    {fields.map(field => {

                        if (typeof field === "string") {
                            return (
                                <input
                                    key={field}
                                    className="form-control"
                                    style={{ maxWidth: "250px" }}
                                    placeholder={`Ingrese ${field}`}
                                    value={form[field] || ""}
                                    onChange={(e) =>
                                        setForm({ ...form, [field]: e.target.value })
                                    }
                                />
                            );
                        }

                        if (field.type === "select") {
                            return (
                                <select
                                    key={field.name}
                                    className="form-select"
                                    style={{ maxWidth: "250px" }}
                                    value={form[field.name] || ""}
                                    onChange={(e) =>
                                        setForm({ ...form, [field.name]: e.target.value })
                                    }
                                >
                                    <option value="">Seleccione {field.label}</option>
                                    {Array.isArray(catalogos[field.source]) && catalogos[field.source].map(opt => (
                                        <option key={opt.id} value={opt.id}>
                                            {opt.nombre}
                                        </option>
                                    ))}
                                </select>
                            );
                        }

                    })}

                    <button className="btn btn-primary" onClick={handleSave}>
                        {editing ? "Actualizar" : "Agregar"}
                    </button>

                    {editing && (
                        <button
                            className="btn btn-light"
                            onClick={() => { setEditing(null); setForm({}); }}
                        >
                            Cancelar
                        </button>
                    )}

                </div>
            </div>

            <div className="admin-toolbar mb-3">
                <select
                    className="form-select"
                    value={filtroEstado}
                    onChange={(e) => setFiltroEstado(e.target.value)}
                >
                    <option value="">Todos los estados</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>

            <AdminDataTable
                data={dataFiltrada}
                loading={loading}
                columns={[
                    { label: "ID", key: "id" },
                    ...fields.map(field => {
                        if (typeof field === "string") {
                            return { label: field, key: field };
                        }
                        if (field.type === "select") {
                            return {
                                label: field.label,
                                render: (row) => {
                                    const list = catalogos[field.source] || [];
                                    const item = list.find(x => Number(x.id) === Number(row[field.name]));
                                    return item?.nombre || "-";
                                }
                            };
                        }
                        return null;
                    }),
                    {
                        label: "Estado",
                        render: (row) => (
                            <span className={`badge ${row.estado ? "bg-success" : "bg-danger"}`}>
                                {row.estado ? "Activo" : "Inactivo"}
                            </span>
                        )
                    }
                ]}
                actions={[
                    {
                        icon: <FaEdit />,
                        class: "btn-icon edit",
                        onClick: handleEdit
                    },
                    {
                        icon: <FaPowerOff />,
                        class: "btn-icon delete",
                        onClick: (row) => handleToggle(row)
                    }
                ]}
            />

            {/* ── Modal toggle estado ── */}
            {showToggle && (
                <div className="modal-overlay">
                    <div className="modal-card">
                        <div className="modal-header">
                            <h5>{esActivo ? "Desactivar" : "Activar"} registro</h5>
                            <button className="modal-close" onClick={() => setShowToggle(false)}>✕</button>
                        </div>
                        <div className="modal-body">
                            <p>
                                ¿Estás seguro de {esActivo ? "desactivar" : "activar"} el registro{" "}
                                <strong>"{itemToggle?.nombre}"</strong>?
                            </p>
                            <div className="mt-3">
                                <label>Motivo <span className="text-danger">*</span></label>
                                <textarea
                                    className="form-control mt-1"
                                    rows="3"
                                    placeholder="Escribe el motivo..."
                                    value={comentarioToggle}
                                    onChange={(e) => setComentarioToggle(e.target.value)}
                                />
                            </div>
                        </div>
                        <div className="modal-footer">
                            <button
                                className="btn btn-light"
                                onClick={() => setShowToggle(false)}
                            >
                                Cancelar
                            </button>
                            <button
                                className="btn btn-danger"
                                onClick={confirmarToggle}
                                disabled={!comentarioToggle.trim()}
                            >
                                {esActivo ? "Desactivar" : "Activar"}
                            </button>
                        </div>
                    </div>
                </div>
            )}

        </AdminLayout>
    );
}