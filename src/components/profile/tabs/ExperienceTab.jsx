import { useEffect, useState } from "react";

export default function ExperienceTab({ data, catalogos, onChange }) {

    const [items, setItems] = useState([]);

    useEffect(() => {
        setItems(data || []);
    }, [data]);

    const handleChange = (index, field, value) => {
        const updated = items.map((item, i) =>
            i === index ? { ...item, [field]: value } : item
        );

        setItems(updated);
        onChange(updated);
    };

    const latestItems = items.slice(-3);

    const addItem = () => {
        const updated = [
            ...items,
            {
                empresa: "",
                cargo: "",
                pais_id: "",
                actividad_id: "",
                categoria_id: "",
                fecha_desde: "",
                fecha_hasta: ""
            }
        ];

        setItems(updated);
        onChange(updated);
    };

    const removeItem = (index) => {
        const updated = items.filter((_, i) => i !== index);
        setItems(updated);
        onChange(updated);
    };

    return (
        <div>

            {/* HEADER */}
            <div className="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5 className="fw-bold mb-0">Experiencia Laboral</h5>
                    <small className="text-muted">Agrega hasta 3 experiencias recientes</small>
                </div>
                <button
                    className="btn btn-primary btn-sm px-3"
                    onClick={addItem}
                    disabled={items.length >= 3}
                >
                    + Agregar
                </button>
            </div>

            {/* ESTADO VACÍO */}
            {latestItems.length === 0 && (
                <div className="text-center py-5 text-muted border rounded-3">
                    <i className="bi bi-briefcase fs-2 d-block mb-2"></i>
                    <p className="mb-0">No hay experiencia laboral registrada</p>
                    <small>Haz clic en "+ Agregar" para comenzar</small>
                </div>
            )}

            {/* ITEMS */}
            {latestItems.map((item, index) => (
                <div key={item.id || index} className="card border-0 shadow-sm mb-3">
                    <div className="card-body p-4">

                        <div className="d-flex justify-content-between align-items-center mb-3">
                            <span className="badge bg-primary bg-opacity-10 text-primary fw-semibold px-3 py-2">
                                Experiencia #{index + 1}
                            </span>
                            <button
                                className="btn btn-sm btn-outline-danger rounded-pill px-3"
                                onClick={() => removeItem(index)}
                            >
                                Eliminar
                            </button>
                        </div>

                        <div className="row g-3">

                            {/* EMPRESA */}
                            <div className="col-md-6">
                                <label className="form-label fw-semibold text-secondary small">
                                    Nombre del patrono
                                </label>
                                <input
                                    type="text"
                                    className="form-control"
                                    placeholder="Ej: Empresa S.A."
                                    value={item.empresa || ""}
                                    onChange={(e) => handleChange(index, "empresa", e.target.value)}
                                />
                            </div>

                            {/* CARGO */}
                            <div className="col-md-6">
                                <label className="form-label fw-semibold text-secondary small">
                                    Cargo que operaba
                                </label>
                                <input
                                    type="text"
                                    className="form-control"
                                    placeholder="Ej: Desarrollador Web"
                                    value={item.cargo || ""}
                                    onChange={(e) => handleChange(index, "cargo", e.target.value)}
                                />
                            </div>

                            {/* PAÍS */}
                            <div className="col-md-4">
                                <label className="form-label fw-semibold text-secondary small">
                                    País
                                </label>
                                <select
                                    className="form-select"
                                    value={item.pais_id || ""}
                                    onChange={(e) => handleChange(index, "pais_id", e.target.value)}
                                >
                                    <option value="">Seleccione</option>
                                    {catalogos?.paises?.map(p => (
                                        <option key={p.id} value={p.id}>{p.nombre}</option>
                                    ))}
                                </select>
                            </div>

                            {/* CATEGORÍA */}
                            <div className="col-md-4">
                                <label className="form-label fw-semibold text-secondary small">
                                    Categoría laboral
                                </label>
                                <select
                                    className="form-select"
                                    value={item.categoria_id || ""}
                                    onChange={(e) => handleChange(index, "categoria_id", e.target.value)}
                                >
                                    <option value="">Seleccione</option>
                                    {catalogos?.categorias?.map(c => (
                                        <option key={c.id} value={c.id}>{c.nombre}</option>
                                    ))}
                                </select>
                            </div>

                            {/* ACTIVIDAD */}
                            <div className="col-md-4">
                                <label className="form-label fw-semibold text-secondary small">
                                    Actividad laboral
                                </label>
                                <select
                                    className="form-select"
                                    value={item.actividad_id || ""}
                                    onChange={(e) => handleChange(index, "actividad_id", e.target.value)}
                                >
                                    <option value="">Seleccione</option>
                                    {catalogos?.actividades?.map(a => (
                                        <option key={a.id} value={a.id}>{a.nombre}</option>
                                    ))}
                                </select>
                            </div>

                            {/* FECHA INICIO */}
                            <div className="col-md-6">
                                <label className="form-label fw-semibold text-secondary small">
                                    Fecha de inicio
                                </label>
                                <input
                                    type="date"
                                    className="form-control"
                                    value={item.fecha_desde || ""}
                                    max={new Date().toISOString().split("T")[0]}
                                    onChange={(e) => handleChange(index, "fecha_desde", e.target.value)}
                                />
                            </div>

                            {/* FECHA FIN */}
                            <div className="col-md-6">
                                <label className="form-label fw-semibold text-secondary small">
                                    Fecha de finalización
                                </label>
                                <input
                                    type="date"
                                    className="form-control"
                                    value={item.fecha_hasta || ""}
                                    min={item.fecha_desde || ""}
                                    onChange={(e) => handleChange(index, "fecha_hasta", e.target.value)}
                                />
                            </div>

                        </div>
                    </div>
                </div>
            ))}

        </div>
    );
}