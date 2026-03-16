import { useEffect, useState } from "react";
import {
  getCategorias,
  getCargos,
  getDepartamentos
} from "../../api/catalogosService";

export default function PlazaFilters({ filtros, setFiltros }) {

  const [categorias,setCategorias] = useState([]);
  const [cargos,setCargos] = useState([]);
  const [departamentos,setDepartamentos] = useState([]);

  useEffect(()=>{

    cargarCatalogos();

  },[])

  const cargarCatalogos = async () => {

    const [
      cat,
      car,
      dep
    ] = await Promise.all([
      getCategorias(),
      getCargos(),
      getDepartamentos()
    ]);

    setCategorias(cat.data.data);
    setCargos(car.data.data);
    setDepartamentos(dep.data.data);

  }

  const handleChange = (e) => {

    setFiltros({
      ...filtros,
      [e.target.name]: e.target.value
    });

  };

  return (

    <div className="card shadow-sm border-0">

      <div className="card-body">

        <h5 className="fw-bold mb-4">
          Filtros
        </h5>

        {/* AREA */}

        <label className="form-label">
          Área
        </label>

        <select
          className="form-select mb-3"
          name="categoria"
          value={filtros.categoria}
          onChange={handleChange}
        >

          <option value="">Todas</option>

          {categorias.map(c=>(
            <option key={c.id} value={c.id}>
              {c.nombre}
            </option>
          ))}

        </select>

        {/* CARGO */}

        <label className="form-label">
          Cargo
        </label>

        <select
          className="form-select mb-3"
          name="cargo"
          value={filtros.cargo}
          onChange={handleChange}
        >

          <option value="">Todos</option>

          {cargos.map(c=>(
            <option key={c.id} value={c.id}>
              {c.nombre}
            </option>
          ))}

        </select>

        {/* DEPARTAMENTO */}

        <label className="form-label">
          Departamento
        </label>

        <select
          className="form-select"
          name="departamento"
          value={filtros.departamento}
          onChange={handleChange}
        >

          <option value="">Todos</option>

          {departamentos.map(d=>(
            <option key={d.id} value={d.id}>
              {d.nombre}
            </option>
          ))}

        </select>

      </div>

    </div>

  );

}