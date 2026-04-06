import { useEffect, useState } from "react";
import AdminLayout from "../../layouts/AdminLayout";
import AdminDataTable from "./AdminDataTable";

export default function AdminCatalogo({
    title,
    service,
    fields = [],
    catalogos = {}
}) {

    const {
        getAll,
        create,
        update,
        remove,
        toggle
    } = service;

    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);
    const [form, setForm] = useState({});
    const [editing, setEditing] = useState(null);

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

    // CREAR / ACTUALIZAR
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

    const handleDelete = async (id) => {
        if (!confirm("¿Eliminar registro?")) return;

        await remove(id);
        cargar();
    };

    const handleToggle = async (id) => {
        await toggle(id);
        cargar();
    };



    return (
        <AdminLayout>

            {/* HEADER */}
            <div className="admin-header d-flex justify-content-between mb-3">
                <h2>{title}</h2>
            </div>

            {/* FORM DINÁMICO */}
            <div className="admin-card mb-3">

                <div className="d-flex gap-2 align-items-center flex-wrap">

                    {fields.map(field => {

                        // TEXT
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

                        // SELECT
                        if (field.type === "select") {
                            return (
                                <select
                                    key={field.name}
                                    className="form-select"
                                    style={{ maxWidth: "250px" }}
                                    value={form[field.name] || ""}
                                    onChange={(e) => 
                                        // console.log("SELECT VALUE:", e.target.value);

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

                </div>

            </div>

            {/* TABLA DINÁMICA */}
            <AdminDataTable
                data={data}
                loading={loading}
                columns={[
                    { label: "ID", key: "id" },

                    ...fields.map(field => {

                        // TEXT
                        if (typeof field === "string") {
                            return {
                                label: field,
                                key: field
                            };
                        }


                        // SELECT (FK)
                        if (field.type === "select") {
                            return {
                                label: field.label,
                                render: (row) => {

                                    // console.log("ROW:", row);
                                    // console.log("FIELD:", field.name);
                                    // console.log("CATALOGO:", catalogos[field.source]);

                                    const list = catalogos[field.source] || [];

                                    const item = list.find(x => Number(x.id) === Number(row[field.name]));

                                    // console.log("MATCH:", item);

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
                        icon: "✏",
                        class: "btn-light",
                        onClick: handleEdit
                    },
                    {
                        icon: "✔",
                        class: "btn-light",
                        onClick: (row) => handleToggle(row.id)
                    },
                    {
                        icon: "✖",
                        class: "btn-light text-danger",
                        onClick: (row) => handleDelete(row.id)
                    }
                ]}
            />

        </AdminLayout>
    );
}