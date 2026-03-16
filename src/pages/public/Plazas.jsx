import { useEffect, useState } from "react";
import { useSearchParams } from "react-router-dom";

import PublicLayout from "../../layouts/PublicLayout";
import JobCard from "../../components/plazas/JobCard";
import PlazaFilters from "../../components/plazas/PlazaFilters";

import { getPlazas } from "../../api/plazasService";

export default function Plazas() {

  const [plazas, setPlazas] = useState([]);
  const [searchParams] = useSearchParams();

  const [filtros, setFiltros] = useState({

    categoria: searchParams.get("categoria") || "",
    cargo: searchParams.get("cargo") || "",
    departamento: searchParams.get("departamento") || ""

  });

  useEffect(() => {

    cargarPlazas();

  }, [])

  const cargarPlazas = async () => {

    const res = await getPlazas();

    setPlazas(res.data.data);

  }

  const plazasFiltradas = plazas.filter(p => {

    if (filtros.categoria && filtros.categoria !== "todos") {
      if (p.categoria_id != filtros.categoria) return false;
    }

    if (filtros.cargo && filtros.cargo !== "todos") {
      if (p.cargo_id != filtros.cargo) return false;
    }

    if (filtros.departamento && filtros.departamento !== "todos") {
      if (p.departamento_id != filtros.departamento) return false;
    }

    return true;

  });

  return (

    <PublicLayout>

      <div className="container py-5">

        <h3 className="fw-bold mb-4">
          Buscar empleos
        </h3>

        <div className="row">

          {/* FILTROS */}

          <div className="col-lg-3">

            <PlazaFilters
              filtros={filtros}
              setFiltros={setFiltros}
            />

          </div>

          {/* RESULTADOS */}

          <div className="col-lg-9">

            <h5 className="fw-bold mb-4">

              {plazasFiltradas.length} plazas disponibles

            </h5>

            <div className="row g-4">

              {plazasFiltradas.map(p => (
                <div className="col-md-6 col-lg-4" key={p.id}>
                  <JobCard plaza={p} />
                </div>
              ))}

            </div>

          </div>

        </div>

      </div>

    </PublicLayout>

  )

}