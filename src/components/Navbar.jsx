import { Link } from "react-router-dom";
import logo from "../assets/logo.png";

export default function Navbar() {
  return (
    <nav className="navbar navbar-expand-lg navbar-modern">
      <div className="container">

        <Link to="/" className="navbar-brand d-flex align-items-center gap-2">
          {/* <img 
            src={logo} 
            alt="JC Empleos"
            className="navbar-logo"
          /> */}
          <span className="brand-text">
            JC Empleos
          </span>
        </Link>

        <div className="d-flex align-items-center gap-4">
          <Link to="/" className="nav-link-custom">Inicio</Link>
          <Link to="/plazas" className="nav-link-custom">Plazas</Link>
          <Link to="/login" className="nav-link-custom">Iniciar sesión</Link>
          <Link to="/register" className="btn btn-primary rounded-pill px-3">
            Registrarse
          </Link>
        </div>

      </div>
    </nav>
  );
}
