import { FaMapMarkerAlt, FaClock } from "react-icons/fa";
import { Link } from "react-router-dom";

export default function JobCard({ plaza }) {

  const tiempoPublicado = (fecha) => {

    const now = new Date();
    const created = new Date(fecha);

    const diff = Math.floor((now - created) / (1000 * 60 * 60 * 24));

    if (diff === 0) return "Hoy";
    if (diff === 1) return "1 día";
    return `${diff} días`;

  };

  return (

    <div className="job-card h-100">

      <div className="job-card-body">

        <span className="badge job-badge mb-2">
          {plaza.categoria}
        </span>

        <h5 className="fw-bold mb-2">
          {plaza.titulo}
        </h5>

        <p className="job-location mb-2">

          <FaMapMarkerAlt className="me-2 text-primary"/>

          {plaza.ciudad}

        </p>

        <p className="mb-2">
          <strong>Cargo:</strong> {plaza.cargo}
        </p>

        <p className="job-date mb-3">

          <FaClock className="me-2"/>

          Publicado hace {tiempoPublicado(plaza.created_at)}

        </p>

        <Link
          to={`/plazas/${plaza.id}`}
          className="btn btn-outline-primary btn-sm rounded-pill"
        >
          Ver detalles
        </Link>

      </div>

    </div>

  );

}