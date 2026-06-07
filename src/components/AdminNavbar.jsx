import { useNavigate } from "react-router-dom";
import { useAuth } from "../context/AuthContext";
import { FaSignOutAlt, FaBell, FaBars } from "react-icons/fa";

export default function AdminNavbar({ onMenuClick }) {

    const { user, logout } = useAuth();
    const navigate = useNavigate();

    const handleLogout = async () => {
        await logout();
        navigate("/");
    };

    const iniciales = `${user?.nombre?.[0] || ""}${user?.apellido?.[0] || ""}`.toUpperCase();

    return (
        <nav className="admin-navbar">
            <div className="admin-navbar-inner">

                <div className="admin-navbar-brand">
                    {/* Hamburguesa solo en móvil */}
                    <button
                        className="hamburger-btn"
                        onClick={onMenuClick}
                    >
                        <FaBars />
                    </button>

                    <span className="brand-dot"></span>
                    JC Empleos
                    <span className="brand-tag">Admin</span>
                </div>

                <div className="admin-navbar-actions">

                    <button className="navbar-icon-btn" title="Notificaciones">
                        <FaBell />
                    </button>

                    <div className="admin-user-chip">
                        <div className="user-avatar">{iniciales}</div>
                        <div className="user-info">
                            <span className="user-name">
                                {user?.nombre} {user?.apellido}
                            </span>
                        </div>
                    </div>

                    <button
                        className="btn-logout"
                        onClick={handleLogout}
                        title="Cerrar sesión"
                    >
                        <FaSignOutAlt />
                        <span>Salir</span>
                    </button>

                </div>

            </div>
        </nav>
    );
}