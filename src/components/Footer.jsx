import { FaEnvelope, FaPhone, FaFacebook, FaInstagram } from "react-icons/fa";

export default function Footer() {
  return (
    <footer className="bg-dark text-white py-3">
      <div className="container">

        {/* Línea 1 */}
        <div className="d-flex flex-column flex-md-row justify-content-between align-items-center">

          {/* Izquierda */}
          <div className="fw-semibold">
            JC Empleos
          </div>

          {/* Derecha */}
          <div className="d-flex align-items-center gap-3 small mt-2 mt-md-0 flex-wrap">

            {/* Correo */}
            <a
              href="mailto:contacto@jcempleos.com"
              className="text-light text-decoration-none"
            >
              <FaEnvelope className="me-1" />
              contacto@jcempleos.com
            </a>

            {/* Teléfono */}
            <a
              href="tel:+50422223333"
              className="text-light text-decoration-none"
            >
              <FaPhone className="me-1" />
              (504) 2222-3333
            </a>

            {/* Redes */}
            <a
              href="https://facebook.com"
              target="_blank"
              rel="noopener noreferrer"
              className="text-light"
            >
              <FaFacebook />
            </a>

            <a
              href="https://instagram.com"
              target="_blank"
              rel="noopener noreferrer"
              className="text-light"
            >
              <FaInstagram />
            </a>

          </div>
        </div>

        {/* Línea 2 */}
        <div className="text-secondary small mt-1">
          Conectamos talento hondureño con oportunidades laborales reales.
        </div>

        {/* Línea 3 */}
        <div className="text-center text-secondary small mt-2">
          © {new Date().getFullYear()} JC Empleos. Todos los derechos reservados.
        </div>

      </div>
    </footer>
  );
}