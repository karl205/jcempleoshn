import { useEffect, useState, useMemo } from "react";
import { useSearchParams } from "react-router-dom";

import PublicLayout from "../../layouts/PublicLayout";
import JobCard from "../../components/plazas/JobCard";
import PlazaFilters from "../../components/plazas/PlazaFilters";

import { getPlazas } from "../../api/plazasService";

export default function Plazas() {

  const [plazas, setPlazas] = useState([]);
  const [searchParams] = useSearchParams();

  const [busqueda, setBusqueda] = useState("");

  const [filtros, setFiltros] = useState({
    categoria: searchParams.get("categoria") || "",
    cargo: searchParams.get("cargo") || "",
    departamento: searchParams.get("departamento") || "",
    tipoContratacion: "",
    salarioMinimo: "",
    orden: "recientes"
  });

  useEffect(() => {
    cargarPlazas();
  }, []);

  const cargarPlazas = async () => {
    const res = await getPlazas();
    setPlazas(res.data.data);
  };

  // Tipos de contratación que realmente existen en las plazas cargadas
  const tiposContratacion = useMemo(() => {
    const unicos = new Set(
      plazas
        .map(p => p.tipo_contratacion)
        .filter(Boolean)
    );
    return Array.from(unicos);
  }, [plazas]);

  // FILTRO PRINCIPAL
  const plazasFiltradas = plazas.filter(p => {

    // CATEGORÍA
    if (filtros.categoria && filtros.categoria !== "todos") {
      if (String(p.categoria_id) !== String(filtros.categoria)) return false;
    }

    // CARGO
    if (filtros.cargo && filtros.cargo !== "todos") {
      if (String(p.cargo_id) !== String(filtros.cargo)) return false;
    }

    // DEPARTAMENTO
    if (filtros.departamento && filtros.departamento !== "todos") {
      if (String(p.departamento_id) !== String(filtros.departamento)) return false;
    }

    // TIPO DE CONTRATACIÓN
    if (filtros.tipoContratacion) {
      if (p.tipo_contratacion !== filtros.tipoContratacion) return false;
    }

    // SALARIO MÍNIMO DESEADO
    if (filtros.salarioMinimo) {
      const minimo = Number(filtros.salarioMinimo);
      const salarioPlaza = p.salario_max ?? p.salario_min ?? 0;
      if (salarioPlaza < minimo) return false;
    }

    // BUSCADOR INTELIGENTE
    if (busqueda.trim() !== "") {

      const texto = busqueda.toLowerCase();

      const match =
        p.titulo?.toLowerCase().includes(texto) ||
        p.ciudad?.toLowerCase().includes(texto) ||
        p.cargo?.toLowerCase().includes(texto) ||
        p.categoria?.toLowerCase().includes(texto);

      if (!match) return false;
    }

    return true;
  });

  // ORDENAMIENTO
  const plazasOrdenadas = [...plazasFiltradas].sort((a, b) => {

    if (filtros.orden === "salario_desc") {
      return (b.salario_max ?? b.salario_min ?? 0) - (a.salario_max ?? a.salario_min ?? 0);
    }

    if (filtros.orden === "salario_asc") {
      return (a.salario_min ?? a.salario_max ?? 0) - (b.salario_min ?? b.salario_max ?? 0);
    }

    // recientes (por defecto)
    return new Date(b.created_at) - new Date(a.created_at);
  });

  return (
    <PublicLayout>

      <div className="container py-4">

        {/* HEADER */}
        <div className="mb-4">

          <h3 className="fw-bold mb-3">
            Buscar empleos
          </h3>

          {/* BUSCADOR */}
          <div className="position-relative">

            <input
              type="text"
              className="form-control shadow-sm rounded-pill ps-4 pe-5"
              placeholder="Buscar por título, ciudad, cargo o área..."
              value={busqueda}
              onChange={(e) => setBusqueda(e.target.value)}
              style={{ height: "48px" }}
            />

            <span className="position-absolute top-50 end-0 translate-middle-y me-3 text-muted">
              🔎
            </span>

          </div>

        </div>

        <div className="row g-4">

          {/* FILTROS */}
          <div className="col-lg-3">

            <div className="sticky-top" style={{ top: "90px" }}>

              <PlazaFilters
                filtros={filtros}
                setFiltros={setFiltros}
                tiposContratacion={tiposContratacion}
              />

            </div>

          </div>

          {/* RESULTADOS */}
          <div className="col-lg-9">

            <div className="d-flex justify-content-between align-items-center mb-3">

              <h6 className="fw-semibold mb-0">
                {plazasOrdenadas.length} plazas disponibles
              </h6>

              {/* LIMPIAR FILTROS */}
              <button
                className="btn btn-sm btn-outline-secondary rounded-pill"
                onClick={() => {
                  setFiltros({
                    categoria: "",
                    cargo: "",
                    departamento: "",
                    tipoContratacion: "",
                    salarioMinimo: "",
                    orden: "recientes"
                  });
                  setBusqueda("");
                }}
              >
                Limpiar filtros
              </button>

            </div>

            {/* RESULTADOS */}
            <div className="row g-4">

              {plazasOrdenadas.length > 0 ? (

                plazasOrdenadas.map(p => (
                  <div className="col-md-6 col-lg-4" key={p.id}>
                    <JobCard plaza={p} />
                  </div>
                ))

              ) : (

                <div className="text-center py-5 text-muted">

                  <h6>No se encontraron resultados</h6>
                  <p className="mb-0">
                    Intenta cambiar los filtros o la búsqueda
                  </p>

                </div>

              )}

            </div>

          </div>

        </div>

      </div>

    </PublicLayout>
  );
}