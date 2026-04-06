import { useEffect, useState } from "react";

export default function AcademicTab({ data, catalogos, onChange }) {
  const [items, setItems] = useState([]);

  useEffect(() => {
    const cleanData = (data || []).map(item => ({
      ...item,
      institucion: item.institucion || "",
      nivel_educativo_id: item.nivel_educativo_id || "",
      area_estudio_id: item.area_estudio_id || "",
      pais_id: item.pais_id || "",
      fecha_desde: item.fecha_desde || "",
      fecha_hasta: item.fecha_hasta || ""
    }));

    setItems(cleanData);
  }, [data]);

  const handleChange = (index, field, value) => {
    const updated = items.map((item, i) =>
      i === index ? { ...item, [field]: value } : item
    );

    setItems(updated);
    onChange(updated);
  };

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
        institucion: "",
        nivel_educativo_id: "",
        area_estudio_id: "",
        pais_id: "",
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
        <h6 className="fw-bold">Formación Académica</h6>
        <button className="btn btn-sm btn-outline-primary" onClick={addItem}>
          + Agregar
        </button>
      </div>

      {latestItems.map((item, index) => (
        <div key={index} className="border rounded p-3 mb-3">

          <div className="row g-2">

            {/* NOMBRE */}
            <div className="col-md-6">
              <input
                className="form-control"
                placeholder="Nombre institución"
                value={item.institucion}
                onChange={(e) =>
                  handleChange(index, "institucion", e.target.value)
                }
              />
            </div>

            {/* FECHA INICIO */}
            <div className="col-md-3">
              <input
                type="date"
                className="form-control"
                value={item.fecha_desde}
                onChange={(e) =>
                  handleChange(index, "fecha_desde", e.target.value)
                }
              />
            </div>

            {/* FECHA FIN */}
            <div className="col-md-3">
              <input
                type="date"
                className="form-control"
                value={item.fecha_hasta}
                onChange={(e) =>
                  handleChange(index, "fecha_hasta", e.target.value)
                }
              />
            </div>

            {/* PAÍS */}
            <div className="col-md-4">
              <select
                className="form-select"
                value={item.pais_id}
                onChange={(e) =>
                  handleChange(index, "pais_id", e.target.value)
                }
              >
                <option value="">País de estudio</option>
                {catalogos.paises?.map(p => (
                  <option key={p.id} value={p.id}>{p.nombre}</option>
                ))}
              </select>
            </div>

            {/* NIVEL */}
            <div className="col-md-4">
              <select
                className="form-select"
                value={item.nivel_educativo_id}
                onChange={(e) =>
                  handleChange(index, "nivel_educativo_id", e.target.value)
                }
              >
                <option value="">Nivel de estudio</option>
                {catalogos.niveles?.map(n => (
                  <option key={n.id} value={n.id}>{n.nombre}</option>
                ))}
              </select>
            </div>

            {/* ÁREA */}
            <div className="col-md-3">
              <select
                className="form-select"
                value={item.area_estudio_id}
                onChange={(e) =>
                  handleChange(index, "area_estudio_id", e.target.value)
                }
              >
                <option value="">Área de estudio</option>
                {catalogos.areas_estudio?.map(a => (
                  <option key={a.id} value={a.id}>{a.nombre}</option>
                ))}
              </select>
            </div>

            {/* ELIMINAR */}
            <div className="col-md-1 d-flex align-items-center">
              <button
                className="btn btn-sm btn-outline-danger w-100"
                onClick={() => removeItem(index)}
              >
                X
              </button>
            </div>

          </div>

        </div>
      ))}

    </div>
  );
}