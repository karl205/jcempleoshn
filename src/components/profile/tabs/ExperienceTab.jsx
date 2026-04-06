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

    // ordenar (nuevos primero + últimos 3)
    const latestItems = [...items]
        .sort((a, b) => {
            if (!a.id) return -1;
            if (!b.id) return 1;
            return b.id - a.id;
        })
        .slice(0, 3);

    const addItem = () => {
        const updated = [
            {
                empresa: "",
                cargo: "",
                pais_id: "",
                actividad_id: "",
                categoria_id: "",
                fecha_desde: "",
                fecha_hasta: ""
            },
            ...items
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

            <div className="d-flex justify-content-between mb-3">
                <h6 className="fw-bold">Experiencia laboral</h6>
                <button
                    className="btn btn-sm btn-outline-primary"
                    onClick={addItem}
                >
                    + Agregar
                </button>
            </div>

            {latestItems.map((item, index) => (
                <div key={item.id || index} className="border p-3 rounded mb-2">

                    <div className="row g-2">

                        {/* EMPRESA */}
                        <div className="col-md-6">
                            <input
                                className="form-control"
                                placeholder="Nombre patrono"
                                value={item.empresa || ""}
                                onChange={(e) =>
                                    handleChange(index, "empresa", e.target.value)
                                }
                            />
                        </div>

                        {/* CARGO */}
                        <div className="col-md-6">
                            <input
                                className="form-control"
                                placeholder="Cargo operaba"
                                value={item.cargo || ""}
                                onChange={(e) =>
                                    handleChange(index, "cargo", e.target.value)
                                }
                            />
                        </div>

                        {/* FECHA INICIO */}
                        <div className="col-md-6">
                            <input
                                type="date"
                                className="form-control"
                                value={item.fecha_desde || ""}
                                onChange={(e) =>
                                    handleChange(index, "fecha_desde", e.target.value)
                                }
                            />
                        </div>

                        {/* FECHA FIN */}
                        <div className="col-md-6">
                            <input
                                type="date"
                                className="form-control"
                                value={item.fecha_hasta || ""}
                                onChange={(e) =>
                                    handleChange(index, "fecha_hasta", e.target.value)
                                }
                            />
                        </div>

                        {/* PAIS */}
                        <div className="col-md-4">
                            <select
                                className="form-select"
                                value={item.pais_id || ""}
                                onChange={(e) =>
                                    handleChange(index, "pais_id", e.target.value)
                                }
                            >
                                <option value="">País</option>
                                {catalogos?.paises?.map(p => (
                                    <option key={p.id} value={p.id}>
                                        {p.nombre}
                                    </option>
                                ))}
                            </select>
                        </div>

                        {/* CATEGORIA */}
                        <div className="col-md-4">
                            <select
                                className="form-select"
                                value={item.categoria_id || ""}
                                onChange={(e) =>
                                    handleChange(index, "categoria_id", e.target.value)
                                }
                            >
                                <option value="">Categoría laboral</option>
                                {catalogos?.categorias?.map(c => (
                                    <option key={c.id} value={c.id}>
                                        {c.nombre}
                                    </option>
                                ))}
                            </select>
                        </div>

                        {/* ACTIVIDAD */}
                        <div className="col-md-4">
                            <select
                                className="form-select"
                                value={item.actividad_id || ""}
                                onChange={(e) =>
                                    handleChange(index, "actividad_id", e.target.value)
                                }
                            >
                                <option value="">Actividad laboral</option>
                                {catalogos?.actividades?.map(a => (
                                    <option key={a.id} value={a.id}>
                                        {a.nombre}
                                    </option>
                                ))}
                            </select>
                        </div>

                        {/* ELIMINAR */}
                        <div className="col-md-12">
                            <button
                                className="btn btn-outline-danger w-100"
                                onClick={() => removeItem(index)}
                            >
                                ✕ Eliminar
                            </button>
                        </div>

                    </div>

                </div>
            ))}

        </div>
    );
}