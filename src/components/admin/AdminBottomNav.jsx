import { Link, useLocation } from "react-router-dom";
import {
    FaTachometerAlt, FaUsers, FaBriefcase,
    FaComments, FaBook
} from "react-icons/fa";

export default function AdminBottomNav() {

    const location = useLocation();

    const items = [
        { label: "Dashboard", path: "/admin",          icon: <FaTachometerAlt /> },
        { label: "Usuarios",  path: "/admin/usuarios",  icon: <FaUsers /> },
        { label: "Plazas",    path: "/admin/plazas",    icon: <FaBriefcase /> },
        { label: "Comentarios", path: "/admin/testimonios", icon: <FaComments /> },
        { label: "Bitácora",  path: "/admin/bitacora",  icon: <FaBook /> },
    ];

    const isActive = (path) =>
        path === "/admin"
            ? location.pathname === "/admin"
            : location.pathname.startsWith(path);

    return (
        <nav className="admin-bottom-nav">
            {items.map((item, i) => (
                <Link
                    key={i}
                    to={item.path}
                    className={`bottom-nav-item ${isActive(item.path) ? "active" : ""}`}
                >
                    <span className="bottom-nav-icon">{item.icon}</span>
                    <span className="bottom-nav-label">{item.label}</span>
                </Link>
            ))}
        </nav>
    );
}