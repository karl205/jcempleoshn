import { FaMapMarkerAlt, FaClock, FaMoneyBillWave } from "react-icons/fa";
import { Link } from "react-router-dom";

export default function JobCard({ plaza }) {

  const tiempoPublicado = (fecha) => {

    const now = new Date();
    const created = new Date(fecha);

    const diff = Math.floor((now - created) / (1000 * 60 * 60 * 24));

    if (diff === 0) return "hoy";
    if (diff === 1) return "1 día";
    return `${diff} días`;

  };

  return (

    <div className="job-card h-100 border-0 shadow-sm rounded-4">

      <div className="job-card-body">

        <span className="badge job-badge mb-2">
          {plaza.categoria}
        </span>

        <h5 className="fw-bold mb-2">
          {plaza.titulo}
        </h5>

        <p className="job-location mb-1">

          <FaMapMarkerAlt className="me-2 text-primary" />

          {plaza.ciudad}, {plaza.departamento}

        </p>

        <p className="mb-1">
          <strong>Cargo:</strong> {plaza.cargo}
        </p>

        <p className="mb-2 text-success fw-semibold">
          <FaMoneyBillWave className="me-2" />
          L. {plaza.salario_min ?? "—"} - L. {plaza.salario_max ?? "—"}
        </p>

        <p className="job-date mb-3">

          <FaClock className="me-2" />

          {tiempoPublicado(plaza.created_at) === "hoy"
            ? "Publicado hoy"
            : `Publicado hace ${tiempoPublicado(plaza.created_at)}`
          }

        </p>

        <Link
          to={`/plazas/${plaza.id}`}
          className="btn btn-outline-primary btn-sm rounded-pill w-100"
        >
          Ver detalles
        </Link>

      </div>

    </div>

  );

}