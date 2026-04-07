import { useEffect, useState } from "react";
import logo from "../assets/logo.png";
import { Link, useNavigate } from "react-router-dom";
import { useAuth } from "../context/AuthContext";
import {
  FaUserCircle,
  FaChevronDown,
  FaHome,
  FaBriefcase,
  FaSignOutAlt,
  FaUserCog,
  FaClipboardList
} from "react-icons/fa";

export default function Navbar() {
  const { user, logout } = useAuth();
  const navigate = useNavigate();

  const [userName, setUserName] = useState("");

  // cargar nombre inicial
  useEffect(() => {
    const stored = localStorage.getItem("user_name");

    if (stored) {
      setUserName(stored);
    } else if (user) {
      setUserName(`${user.nombre} ${user.apellido}`);
    }
  }, [user]);

  useEffect(() => {
    const updateName = () => {
      const stored = localStorage.getItem("user_name");
      if (stored) setUserName(stored);
    };

    window.addEventListener("userUpdated", updateName);

    return () => {
      window.removeEventListener("userUpdated", updateName);
    };
  }, []);

  const handleLogout = async () => {
    await logout();

    // limpiar nombre
    localStorage.removeItem("user_name");

    navigate("/");
  };

  return (
    <nav className="navbar navbar-expand-lg navbar-modern">
      <div className="container">

        <Link to="/" className="navbar-brand d-flex align-items-center gap-2">
          <span className="brand-text">JC Empleos</span>
        </Link>

        <div className="d-flex align-items-center gap-4">

          <Link to="/" className="nav-link-custom d-flex align-items-center gap-2">
            <FaHome size={14} />
            Inicio
          </Link>

          <Link to="/plazas" className="nav-link-custom d-flex align-items-center gap-2">
            <FaBriefcase size={14} />
            Plazas
          </Link>

          {!user && (
            <>
              <Link to="/login" className="nav-link-custom">
                Iniciar sesión
              </Link>
              <Link to="/register" className="btn btn-primary rounded-pill px-3">
                Registrarse
              </Link>
            </>
          )}

          {user && (
            <div className="dropdown">
              <button
                className="user-dropdown-btn"
                data-bs-toggle="dropdown"
              >
                <FaUserCircle className="me-2 user-icon" />

                <span className="user-name">
                  {userName || `${user.nombre} ${user.apellido}`}
                </span>

                <FaChevronDown className="ms-2 small-chevron" />
              </button>

              <ul className="dropdown-menu dropdown-menu-end shadow-sm">
                <li>
                  <Link to="/perfil" className="dropdown-item">
                    <FaUserCog className="me-2" />
                    Administrar perfil
                  </Link>
                </li>
                <li>
                  <Link to="/mis-postulaciones" className="dropdown-item">
                    <FaClipboardList className="me-2" />
                    Mis postulaciones
                  </Link>
                </li>
                <li>
                  <button onClick={handleLogout} className="dropdown-item">
                    <FaSignOutAlt className="me-2" />
                    Cerrar sesión
                  </button>
                </li>
              </ul>
            </div>
          )}

        </div>

      </div>
    </nav>
  );
}