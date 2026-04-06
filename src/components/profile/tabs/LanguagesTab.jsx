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

    // ordenar: nuevos primero + últimos 3
    const latestItems = [...items]
        .sort((a, b) => {
            if (!a.id) return -1;
            if (!b.id) return 1;
            return b.id - a.id;
        })
        .slice(0, 3);

    // agregar arriba
    const addItem = () => {
        const updated = [
            {
                idioma_id: "",
                nivel_id: ""
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
                <h6 className="fw-bold">Idiomas</h6>
                <button
                    className="btn btn-sm btn-outline-primary"
                    onClick={addItem}
                >
                    + Agregar
                </button>
            </div>

            {latestItems.map((item, index) => (
                <div key={item.id || index} className="row g-2 mb-2">

                    {/* IDIOMA */}
                    <div className="col-md-5">
                        <select
                            className="form-select"
                            value={item.idioma_id || ""}
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

                    {/* NIVEL */}
                    <div className="col-md-5">
                        <select
                            className="form-select"
                            value={item.nivel_id || ""}
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

                    {/* ELIMINAR */}
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