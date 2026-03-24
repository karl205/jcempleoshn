import { useState } from "react";

export default function LanguagesTab({ data, catalogos, onChange }) {
    const items = data || [];

    const handleChange = (index, field, value) => {
        const updated = [...items];
        updated[index][field] = value;
        setItems(updated);
        onChange(updated);
    };

    const addItem = () => {
        const updated = [
            ...items,
            { idioma_id: "", nivel_id: "" },
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
                <h6 className="fw-bold">Idiomas</h6>
                <button className="btn btn-sm btn-outline-primary" onClick={addItem}>
                    + Agregar
                </button>
            </div>

            {items.map((item, index) => (
                <div key={index} className="row g-2 mb-2">

                    <div className="col-md-5">
                        <select
                            className="form-select"
                            value={item.idioma_id}
                            onChange={(e) =>
                                handleChange(index, "idioma_id", e.target.value)
                            }
                        >
                            <option value="">Idioma</option>
                            {catalogos.idiomas?.map((i) => (
                                <option key={i.id} value={i.id}>
                                    {i.nombre}
                                </option>
                            ))}
                        </select>
                    </div>

                    <div className="col-md-5">
                        <select
                            className="form-select"
                            value={item.nivel_id}
                            onChange={(e) =>
                                handleChange(index, "nivel_id", e.target.value)
                            }
                        >
                            <option value="">Nivel</option>
                            {catalogos.niveles_idioma?.map((n) => (
                                <option key={n.id} value={n.id}>
                                    {n.nombre}
                                </option>
                            ))}
                        </select>
                    </div>

                    <div className="col-md-2">
                        <button
                            className="btn btn-outline-danger w-100"
                            onClick={() => removeItem(index)}
                        >
                            ✕
                        </button>
                    </div>

                </div>
            ))}

        </div>
    );
}