import { useEffect, useState } from "react";
import {
  FaLayerGroup,
  FaUserTie,
  FaMapMarkerAlt,
  FaFileContract,
  FaMoneyBillWave,
  FaTimes,
} from "react-icons/fa";
import {
  getCategorias,
  getCargos,
  getDepartamentos
} from "../../api/catalogosService";

export default function PlazaFilters({ filtros, setFiltros, tiposContratacion }) {

  const [categorias, setCategorias] = useState([]);
  const [cargos, setCargos] = useState([]);
  const [departamentos, setDepartamentos] = useState([]);

  const [cargosFiltrados, setCargosFiltrados] = useState([]);

  useEffect(() => {
    cargarCatalogos();
  }, [])

  const cargarCatalogos = async () => {

    const [cat, car, dep] = await Promise.all([
      getCategorias(),
      getCargos(),
      getDepartamentos()
    ]);

    setCategorias(cat.data.data);
    setCargos(car.data.data);
    setDepartamentos(dep.data.data);

  }

  useEffect(() => {

    if (!filtros.categoria) {
      setCargosFiltrados(cargos);
      return;
    }

    const categoriaSeleccionada = categorias.find(
      c => String(c.id) === String(filtros.categoria)
    );

    if (!categoriaSeleccionada) return;

    const filtrados = cargos.filter(
      c => c.categoria === categoriaSeleccionada.nombre
    );

    setCargosFiltrados(filtrados);

    if (!filtrados.some(c => String(c.id) === String(filtros.cargo))) {
      setFiltros(prev => ({
        ...prev,
        cargo: ""
      }));
    }

  }, [filtros.categoria, categorias, cargos]);

  const handleChange = (e) => {
    setFiltros({
      ...filtros,
      [e.target.name]: e.target.value
    });
  };

  const setOrden = (valor) => {
    setFiltros({ ...filtros, orden: valor });
  };

  const nombreCategoria = categorias.find(c => String(c.id) === String(filtros.categoria))?.nombre;
  const nombreCargo = cargos.find(c => String(c.id) === String(filtros.cargo))?.nombre;
  const nombreDepartamento = departamentos.find(d => String(d.id) === String(filtros.departamento))?.nombre;

  const chips = [
    filtros.categoria && { key: "categoria", label: nombreCategoria },
    filtros.cargo && { key: "cargo", label: nombreCargo },
    filtros.departamento && { key: "departamento", label: nombreDepartamento },
    filtros.tipoContratacion && { key: "tipoContratacion", label: filtros.tipoContratacion },
    filtros.salarioMinimo && { key: "salarioMinimo", label: `Desde L. ${Number(filtros.salarioMinimo).toLocaleString()}` },
  ].filter(Boolean);

  const quitarChip = (key) => {
    setFiltros({ ...filtros, [key]: "" });
  };

  return (

    <div className="pf-card">

      <div className="pf-header">
        <h5>Filtros</h5>
        {chips.length > 0 && (
          <span className="pf-count-badge">{chips.length}</span>
        )}
      </div>

      {chips.length > 0 && (
        <div className="pf-chips">
          {chips.map(chip => (
            <button
              key={chip.key}
              type="button"
              className="pf-chip"
              onClick={() => quitarChip(chip.key)}
            >
              {chip.label}
              <FaTimes className="pf-chip-x" />
            </button>
          ))}
        </div>
      )}

      <div className="pf-group">
        <label className="pf-label">
          <FaLayerGroup className="pf-label-icon" />
          Área
        </label>
        <select
          className="pf-select"
          name="categoria"
          value={filtros.categoria}
          onChange={handleChange}
        >
          <option value="">Todas</option>
          {categorias.map(c => (
            <option key={c.id} value={c.id}>{c.nombre}</option>
          ))}
        </select>
      </div>

      <div className="pf-group">
        <label className="pf-label">
          <FaUserTie className="pf-label-icon" />
          Cargo
        </label>
        <select
          className="pf-select"
          name="cargo"
          value={filtros.cargo}
          onChange={handleChange}
        >
          <option value="">
            {filtros.categoria ? "Todos en esta área" : "Todos"}
          </option>
          {cargosFiltrados.map(c => (
            <option key={c.id} value={c.id}>{c.nombre}</option>
          ))}
        </select>
      </div>

      <div className="pf-group">
        <label className="pf-label">
          <FaMapMarkerAlt className="pf-label-icon" />
          Departamento
        </label>
        <select
          className="pf-select"
          name="departamento"
          value={filtros.departamento}
          onChange={handleChange}
        >
          <option value="">Todos</option>
          {departamentos.map(d => (
            <option key={d.id} value={d.id}>{d.nombre}</option>
          ))}
        </select>
      </div>

      <div className="pf-group">
        <label className="pf-label">
          <FaFileContract className="pf-label-icon" />
          Tipo de contratación
        </label>
        <select
          className="pf-select"
          name="tipoContratacion"
          value={filtros.tipoContratacion}
          onChange={handleChange}
        >
          <option value="">Todos</option>
          {tiposContratacion.map(t => (
            <option key={t} value={t}>{t}</option>
          ))}
        </select>
      </div>

      <div className="pf-group">
        <label className="pf-label">
          <FaMoneyBillWave className="pf-label-icon" />
          Salario mínimo deseado
        </label>

        <div className="pf-range-value">
          {filtros.salarioMinimo
            ? `L. ${Number(filtros.salarioMinimo).toLocaleString()}+`
            : "Cualquier salario"}
        </div>

        <input
          type="range"
          className="pf-range"
          name="salarioMinimo"
          min={0}
          max={100000}
          step={1000}
          value={filtros.salarioMinimo || 0}
          onChange={handleChange}
        />
      </div>

      <div className="pf-group pf-group-last">
        <label className="pf-label">
          Ordenar por
        </label>

        <div className="pf-segmented">
          <button
            type="button"
            className={`pf-segment ${filtros.orden === "recientes" ? "pf-segment-active" : ""}`}
            onClick={() => setOrden("recientes")}
          >
            Recientes
          </button>
          <button
            type="button"
            className={`pf-segment ${filtros.orden === "salario_desc" ? "pf-segment-active" : ""}`}
            onClick={() => setOrden("salario_desc")}
          >
            Mayor salario
          </button>
          <button
            type="button"
            className={`pf-segment ${filtros.orden === "salario_asc" ? "pf-segment-active" : ""}`}
            onClick={() => setOrden("salario_asc")}
          >
            Menor salario
          </button>
        </div>
      </div>

    </div>

  );

}