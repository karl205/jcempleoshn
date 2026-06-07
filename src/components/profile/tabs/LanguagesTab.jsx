import { useEffect, useState } from "react";

export default function LanguagesTab({ data, catalogos, onChange }) {

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
            { idioma_id: "", nivel_id: "" }
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
                    <h5 className="fw-bold mb-0">Idiomas</h5>
                    <small className="text-muted">Agrega hasta 3 idiomas</small>
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
                    <i className="bi bi-translate fs-2 d-block mb-2"></i>
                    <p className="mb-0">No hay idiomas registrados</p>
                    <small>Haz clic en "+ Agregar" para comenzar</small>
                </div>
            )}

            {/* ITEMS */}
            {latestItems.map((item, index) => (
                <div key={item.id || index} className="card border-0 shadow-sm mb-3">
                    <div className="card-body p-4">

                        <div className="d-flex justify-content-between align-items-center mb-3">
                            <span className="badge bg-primary bg-opacity-10 text-primary fw-semibold px-3 py-2">
                                Idioma #{index + 1}
                            </span>
                            <button
                                className="btn btn-sm btn-outline-danger rounded-pill px-3"
                                onClick={() => removeItem(index)}
                            >
                                Eliminar
                            </button>
                        </div>

                        <div className="row g-3">

                            {/* IDIOMA */}
                            <div className="col-md-6">
                                <label className="form-label fw-semibold text-secondary small">
                                    Idioma
                                </label>
                                <select
                                    className="form-select"
                                    value={item.idioma_id || ""}
                                    onChange={(e) => handleChange(index, "idioma_id", e.target.value)}
                                >
                                    <option value="">Seleccione</option>
                                    {catalogos.idiomas?.map((i) => (
                                        <option key={i.id} value={i.id}>{i.nombre}</option>
                                    ))}
                                </select>
                            </div>

                            {/* NIVEL */}
                            <div className="col-md-6">
                                <label className="form-label fw-semibold text-secondary small">
                                    Nivel
                                </label>
                                <select
                                    className="form-select"
                                    value={item.nivel_id || ""}
                                    onChange={(e) => handleChange(index, "nivel_id", e.target.value)}
                                >
                                    <option value="">Seleccione</option>
                                    {catalogos.niveles_idioma?.map((n) => (
                                        <option key={n.id} value={n.id}>{n.nombre}</option>
                                    ))}
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            ))}

        </div>
    );
}