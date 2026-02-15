import { motion } from "framer-motion";
import { FaMapMarkerAlt, FaClock } from "react-icons/fa";

export default function LatestJobs() {
  const plazas = [
    {
      titulo: "Asistente Administrativo",
      ubicacion: "Tegucigalpa",
      fecha: "1 día",
      actividad: "Financiero",
      categoria: "Administración",
    },
    {
      titulo: "Técnico en Soporte",
      ubicacion: "Santa Ana",
      fecha: "2 días",
      actividad: "Soporte TI",
      categoria: "Tecnología",
    },
    {
      titulo: "Diseñador Gráfico",
      ubicacion: "La Ceiba",
      fecha: "3 días",
      actividad: "Creativo",
      categoria: "Diseño",
    },
  ];

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
            <div className="col-md-6 col-lg-4" key={index}>
              
              <motion.div
                initial={{ opacity: 0, y: 40 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.5, delay: index * 0.1 }}
                viewport={{ once: true }}
                whileHover={{ y: -6 }}
                className="job-card"
              >
                <div className="job-card-body">

                  <span className="badge job-badge mb-2">
                    {p.categoria}
                  </span>

                  <h5 className="fw-bold mb-2">{p.titulo}</h5>

                  <p className="job-location mb-2">
                    <FaMapMarkerAlt className="me-2 text-primary" />
                    {p.ubicacion}
                  </p>

                  <p className="mb-2">
                    <strong>Actividad:</strong> {p.actividad}
                  </p>

                  <p className="job-date mb-3">
                    <FaClock className="me-2" />
                    Publicado hace {p.fecha}
                  </p>

                  <button className="btn btn-outline-primary btn-sm rounded-pill">
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
