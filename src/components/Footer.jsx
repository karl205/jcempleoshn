import { FaEnvelope, FaPhone, FaHome, FaSearch } from "react-icons/fa";

export default function Footer() {
  return (
    <footer className="footer-modern text-white pt-5 pb-3">
      <div className="container">
        <div className="row justify-content-between gy-4">

          {/* Columna 1 */}
          <div className="col-md-4">
            <h5 className="fw-bold mb-3">JC Empleos</h5>
            <p className="small text-light mb-0">
              Conectamos talento hondureño con oportunidades laborales reales.
            </p>
          </div>

          {/* Columna 2 */}
          <div className="col-md-3">
            <h6 className="fw-bold mb-3">Navegación</h6>
            <ul className="list-unstyled">
              <li className="mb-2">
                <a href="/" className="footer-link">
                  <FaHome className="me-2" />
                  Inicio
                </a>
              </li>
              <li>
                <a href="#" className="footer-link">
                  <FaSearch className="me-2" />
                  Buscar plazas
                </a>
              </li>
            </ul>
          </div>

          {/* Columna 3 */}
          <div className="col-md-3">
            <h6 className="fw-bold mb-3">Contáctanos</h6>

            <p className="small mb-2 footer-contact">
              <FaEnvelope className="me-2" />
              contacto@jcempleos.com
            </p>

            <p className="small footer-contact">
              <FaPhone className="me-2" />
              (504) 2222-3333
            </p>
          </div>

        </div>

        <hr className="border-secondary my-4" />

        <div className="text-center small text-secondary">
          © {new Date().getFullYear()} JC Empleos. Todos los derechos reservados.
        </div>
      </div>
    </footer>
  );
}
