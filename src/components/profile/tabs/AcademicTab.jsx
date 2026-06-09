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

  const latestItems = items.slice(-3);

  const addItem = () => {
    const updated = [
      ...items,
      {
        institucion: "",
        nivel_educativo_id: "",
        area_estudio_id: "",
        pais_id: "",
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
          <h5 className="fw-bold mb-0">Formación Académica</h5>
          <small className="text-muted">Agrega hasta 3 estudios recientes</small>
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
          <i className="bi bi-mortarboard fs-2 d-block mb-2"></i>
          <p className="mb-0">No hay formación académica registrada</p>
          <small>Haz clic en "+ Agregar" para comenzar</small>
        </div>
      )}

      {/* ITEMS */}
      {latestItems.map((item, index) => (
        <div key={index} className="card border-0 shadow-sm mb-3">
          <div className="card-body p-4">

            <div className="d-flex justify-content-between align-items-center mb-3">
              <span className="badge bg-primary bg-opacity-10 text-primary fw-semibold px-3 py-2">
                Estudio #{index + 1}
              </span>
              <button
                className="btn btn-sm btn-outline-danger rounded-pill px-3"
                onClick={() => removeItem(index)}
              >
                Eliminar
              </button>
            </div>

            <div className="row g-3">

              {/* INSTITUCIÓN */}
              <div className="col-12">
                <label className="form-label fw-semibold text-secondary small">
    Nombre de la institución <span className="text-danger">*</span>
</label>
                <input
                  type="text"
                  className="form-control"
                  placeholder="Ej: Universidad Nacional Autónoma"
                  value={item.institucion}
                  onChange={(e) => handleChange(index, "institucion", e.target.value.toUpperCase())}
                />
              </div>

              {/* NIVEL */}
              <div className="col-md-6">
                <label className="form-label fw-semibold text-secondary small">
    Nivel de estudio <span className="text-danger">*</span>
</label>
                <select
                  className="form-select"
                  value={item.nivel_educativo_id}
                  onChange={(e) => handleChange(index, "nivel_educativo_id", e.target.value)}
                >
                  <option value="">Seleccione</option>
                  {catalogos.niveles?.map(n => (
                    <option key={n.id} value={n.id}>{n.nombre}</option>
                  ))}
                </select>
              </div>

              {/* ÁREA */}
              <div className="col-md-6">
                <label className="form-label fw-semibold text-secondary small">
    Área de estudio <span className="text-danger">*</span>
</label>
                <select
                  className="form-select"
                  value={item.area_estudio_id}
                  onChange={(e) => handleChange(index, "area_estudio_id", e.target.value)}
                >
                  <option value="">Seleccione</option>
                  {catalogos.areas_estudio?.map(a => (
                    <option key={a.id} value={a.id}>{a.nombre}</option>
                  ))}
                </select>
              </div>

              {/* PAÍS */}
              <div className="col-md-4">
                <label className="form-label fw-semibold text-secondary small">
    País de estudio <span className="text-danger">*</span>
</label>
                <select
                  className="form-select"
                  value={item.pais_id}
                  onChange={(e) => handleChange(index, "pais_id", e.target.value)}
                >
                  <option value="">Seleccione</option>
                  {catalogos.paises?.map(p => (
                    <option key={p.id} value={p.id}>{p.nombre}</option>
                  ))}
                </select>
              </div>

              {/* FECHA INICIO */}
              <div className="col-md-4">
                <label className="form-label fw-semibold text-secondary small">
    Fecha de inicio <span className="text-danger">*</span>
</label>
                <input
                  type="date"
                  className="form-control"
                  value={item.fecha_desde}
                  max={new Date().toISOString().split("T")[0]}
                  onChange={(e) => handleChange(index, "fecha_desde", e.target.value)}
                />
              </div>

              {/* FECHA FIN */}
              <div className="col-md-4">
                <label className="form-label fw-semibold text-secondary small">
                  Fecha de finalización
                </label>
                <input
                  type="date"
                  className="form-control"
                  value={item.fecha_hasta}
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