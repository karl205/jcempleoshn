export default function ExperienceTab({ data, onChange }) {
    const items = data || [];

    const addItem = () => {
        const updated = [
            ...items,
            {
                empresa: "",
                pais_id: "",
                cargo: "",
                fecha_desde: "",
                fecha_hasta: "",
                descripcion: ""
            },
        ];
        onChange(updated);
    };

    const handleChange = (i, field, value) => {
        const updated = [...items];
        updated[i][field] = value;

        console.log("Experience updated:", updated);


        onChange(updated);
    };

    const removeItem = (index) => {
        const updated = items.filter((_, i) => i !== index);
        onChange(updated);
    };

    return (
        <div>
            <div className="d-flex justify-content-between mb-3">
                <h6 className="fw-bold">Experiencia</h6>
                <button
                    className="btn btn-sm btn-outline-primary"
                    onClick={addItem}
                >
                    + Agregar
                </button>
            </div>

            {items.map((item, i) => (
                <div key={i} className="border p-3 rounded mb-2">

                    <input
                        className="form-control mb-2"
                        placeholder="Empresa"
                        value={item.empresa || ""}
                        onChange={(e) =>
                            handleChange(i, "empresa", e.target.value)
                        }
                    />

                    <input
                        className="form-control mb-2"
                        placeholder="Cargo"
                        value={item.cargo || ""}
                        onChange={(e) =>
                            handleChange(i, "cargo", e.target.value)
                        }
                    />

                    <textarea
                        className="form-control mb-2"
                        placeholder="Descripción"
                        value={item.descripcion || ""}
                        onChange={(e) =>
                            handleChange(i, "descripcion", e.target.value)
                        }
                    />

                    <button
                        className="btn btn-outline-danger btn-sm w-100"
                        onClick={() => removeItem(i)}
                    >
                        Eliminar
                    </button>

                </div>
            ))}
        </div>
    );
}