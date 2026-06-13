import { useEffect, useState } from "react";
import { motion } from "framer-motion";
import { FaMapMarkerAlt, FaClock } from "react-icons/fa";
import { getUltimasPlazas } from "../api/plazasService";
import { useNavigate } from "react-router-dom";

export default function LatestJobs() {

  const navigate = useNavigate();
  const [plazas, setPlazas] = useState([]);

  useEffect(() => {
    cargarPlazas();
  }, []);

  const cargarPlazas = async () => {
    try {
      const response = await getUltimasPlazas();
      setPlazas(response.data.data);
    } catch (error) {
      console.error("Error cargando últimas plazas", error);
    }
  };

  const tiempoPublicado = (fecha) => {
    const ahora = new Date();
    const publicada = new Date(fecha);
    const diffSegundos = Math.floor((ahora - publicada) / 1000);

    if (diffSegundos < 60) {
      return "Publicado hace unos segundos";
    }

    const diffMin = Math.floor(diffSegundos / 60);
    if (diffMin < 60) {
      return `Publicado hace ${diffMin} minuto${diffMin > 1 ? "s" : ""}`;
    }

    const diffHoras = Math.floor(diffMin / 60);
    if (diffHoras < 24) {
      return `Publicado hace ${diffHoras} hora${diffHoras > 1 ? "s" : ""}`;
    }

    const diffDias = Math.floor(diffHoras / 24);
    if (diffDias === 1) {
      return "Publicado hace 1 día";
    }

    return `Publicado hace ${diffDias} días`;
  };

  return (
    <section className="latest-section py-5">
      <div className="container">

        <div className="text-center mb-5">
          <h3 className="fw-bold">Últimas plazas publicadas</h3>
          <p className="text-muted">
            Oportunidades recientes que podrían interesarte
          </p>
        </div>

        <div className="row g-4">

          {plazas.map((p, index) => (

            <div className="col-md-6 col-lg-4" key={p.id}>

              <motion.div
                initial={{ opacity: 0, y: 40 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.5, delay: index * 0.1 }}
                viewport={{ once: true }}
                whileHover={{ y: -6, scale: 1.01 }}
                className="job-card cursor-pointer"
                onClick={() => navigate(`/plazas/${p.id}`)}
              >

                <div className="job-card-body">

                  <span className="badge job-badge mb-2">
                    {p.categoria}
                  </span>

                  <h5 className="fw-bold mb-2">{p.titulo}</h5>

                  <p className="job-location mb-2">
                    <FaMapMarkerAlt className="me-2 text-primary" />
                   {p.departamento}, {p.ciudad}
                  </p>

                  <p className="mb-2">
                    <strong>Actividad:</strong> {p.actividad}
                  </p>

                  <p className="job-date mb-3">
                    <FaClock className="me-2" />
                    {tiempoPublicado(p.created_at)}
                  </p>

                  <button
                    className="btn btn-outline-primary btn-sm rounded-pill"
                    onClick={() => navigate(`/plazas/${p.id}`)}
                  >
                    Ver detalles
                  </button>

                </div>

              </motion.div>

            </div>

          ))}

        </div>

      </div>
    </section>
  );
}