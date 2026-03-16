import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import logo from "../assets/logo.png";

import {
  getCargos,
  getCategorias,
  getDepartamentos
} from "../api/catalogosService";

export default function HeroSection() {

  const navigate = useNavigate();

  const [cargos, setCargos] = useState([]);
  const [categorias, setCategorias] = useState([]);
  const [departamentos, setDepartamentos] = useState([]);

  const [filtros, setFiltros] = useState({
    categoria: "",
    cargo: "",
    departamento: ""
  });

  useEffect(() => {
    cargarCatalogos();
  }, []);

  const cargarCatalogos = async () => {

    try {

      const [
        cargosRes,
        categoriasRes,
        departamentosRes
      ] = await Promise.all([
        getCargos(),
        getCategorias(),
        getDepartamentos()
      ]);

      setCargos(cargosRes.data.data);
      setCategorias(categoriasRes.data.data);
      setDepartamentos(departamentosRes.data.data);

    } catch (error) {

      console.error("Error cargando catálogos", error);

    }

  };

  const handleChange = (e) => {

    const { name, value } = e.target;

    setFiltros({
      ...filtros,
      [name]: value
    });

  };

  const buscar = () => {

    const query = new URLSearchParams(filtros).toString();

    navigate(`/plazas?${query}`);

  };

  return (

    <section className="hero-wrapper position-relative">

      <img
        src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d"
        className="w-100 hero-image"
        alt="Banner"
      />

      <div className="hero-overlay"></div>

      <div className="position-absolute top-50 start-50 translate-middle w-100 px-3">

        <div className="hero-panel mx-auto text-center">

          <img
            src={logo}
            alt="JC Empleos"
            className="hero-logo mb-3"
          />

          <h2 className="fw-bold mb-2">
            Encuentra tu próxima oportunidad laboral
          </h2>

          <p className="text-muted mb-4">
            Plazas actualizadas diariamente en Honduras
          </p>

          <div className="row g-3">

            {/* AREA */}

            <div className="col-md-4">

              <select
                className="form-select rounded-pill"
                name="categoria"
                value={filtros.categoria}
                onChange={handleChange}
              >

                <option value="">Área</option>

                {categorias.map(c => (

                  <option key={c.id} value={c.id}>
                    {c.nombre}
                  </option>

                ))}

              </select>

            </div>

            {/* CARGO */}

            <div className="col-md-4">

              <select
                className="form-select rounded-pill"
                name="cargo"
                value={filtros.cargo}
                onChange={handleChange}
              >

                <option value="">Cargo</option>

                {cargos.map(c => (

                  <option key={c.id} value={c.id}>
                    {c.nombre}
                  </option>

                ))}

              </select>

            </div>

            {/* DEPARTAMENTO */}

            <div className="col-md-4">

              <select
                className="form-select rounded-pill"
                name="departamento"
                value={filtros.departamento}
                onChange={handleChange}
              >

                <option value="">Departamento</option>

                {departamentos.map(d => (

                  <option key={d.id} value={d.id}>
                    {d.nombre}
                  </option>

                ))}

              </select>

            </div>

            <div className="col-12 d-grid mt-3">

              <button
                className="btn btn-primary btn-lg rounded-pill"
                onClick={buscar}
              >
                Buscar empleos
              </button>

            </div>

          </div>

        </div>

      </div>

    </section>

  );

}