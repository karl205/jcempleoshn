import { useState } from "react";

export default function ExperienceTab({ data, onChange }) {
    const items = data || [];

    const addItem = () => {
        const updated = [
            ...items,
            { empresa: "", puesto: "", descripcion: "" },
        ];
        setItems(updated);
        onChange(updated);
    };

    const handleChange = (i, field, value) => {
        const updated = [...items];
        updated[i][field] = value;
        setItems(updated);
        onChange(updated);
    };

    return (
        <div>

            <div className="d-flex justify-content-between mb-3">
                <h6 className="fw-bold">Experiencia</h6>
                <button className="btn btn-sm btn-outline-primary" onClick={addItem}>
                    + Agregar
                </button>
            </div>

            {items.map((item, i) => (
                <div key={i} className="border p-3 rounded mb-2">

                    <input
                        className="form-control mb-2"
                        placeholder="Empresa"
                        value={item.empresa}
                        onChange={(e) =>
                            handleChange(i, "empresa", e.target.value)
                        }
                    />

                    <input
                        className="form-control mb-2"
                        placeholder="Puesto"
                        value={item.puesto}
                        onChange={(e) =>
                            handleChange(i, "puesto", e.target.value)
                        }
                    />

                    <textarea
                        className="form-control"
                        placeholder="Descripción"
                        value={item.descripcion}
                        onChange={(e) =>
                            handleChange(i, "descripcion", e.target.value)
                        }
                    />

                </div>
            ))}

        </div>
    );
}