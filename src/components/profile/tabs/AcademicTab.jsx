import { useEffect, useState } from "react";

export default function AcademicTab({ data, catalogos, onChange }) {
  const [items, setItems] = useState([]);

  useEffect(() => {
    setItems(data || []);
  }, [data]);

  const handleChange = (index, field, value) => {
    const updated = [...items];
    updated[index][field] = value;

    console.log("Academic updated:", updated);

    onChange(updated);
  };

  const addItem = () => {
    onChange([
      ...items,
      {
        institucion: "",
        nivel_educativo_id: "",
        area_estudio_id: "",
        fecha_desde: "",
        fecha_hasta: ""
      },
    ]);
  };

  const removeItem = (index) => {
    onChange(items.filter((_, i) => i !== index));
  };

  return (
    <div>

      <div className="d-flex justify-content-between mb-3">
        <h6 className="fw-bold">Formación Académica</h6>
        <button className="btn btn-sm btn-outline-primary" onClick={addItem}>
          + Agregar
        </button>
      </div>

      {items.map((item, index) => (
        <div key={index} className="border rounded p-3 mb-2">

          <div className="row g-2">

            <div className="col-md-6">
              <input
                className="form-control"
                placeholder="Institución"
                value={item.institucion}
                onChange={(e) =>
                  handleChange(index, "institucion", e.target.value)
                }
              />
            </div>

            <div className="col-md-6">
              <select
                className="form-select"
                value={item.nivel_educativo_id}
                onChange={(e) =>
                  handleChange(index, "nivel_educativo_id", e.target.value)
                }
              >
                <option value="">Nivel educativo</option>
                {catalogos.niveles?.map((n) => (
                  <option key={n.id} value={n.id}>
                    {n.nombre}
                  </option>
                ))}
              </select>
            </div>

            <div className="col-md-10">
              <input
                className="form-control"
                placeholder="Área de estudio"
                value={item.area_estudio}
                onChange={(e) =>
                  handleChange(index, "area_estudio", e.target.value)
                }
              />
            </div>

            <div className="col-md-2 d-flex align-items-center">
              <button
                className="btn btn-sm btn-outline-danger w-100"
                onClick={() => removeItem(index)}
              >
                Eliminar
              </button>
            </div>

          </div>

        </div>
      ))}

    </div>
  );
}