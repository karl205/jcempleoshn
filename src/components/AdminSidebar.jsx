import { Link } from "react-router-dom";
import { FaUsers, FaUserShield, FaKey, FaTachometerAlt } from "react-icons/fa";

export default function AdminSidebar() {
    return (
        <aside className="admin-sidebar">
            <div className="admin-sidebar-header">
                Panel
            </div>
            <nav className="admin-menu">

                <Link to="/admin" className="admin-menu-item">
                    <FaTachometerAlt />
                    Dashboard
                </Link>

                <Link to="/admin/usuarios" className="admin-menu-item">
                    <FaUsers />
                    Usuarios
                </Link>

                <Link to="/admin/roles" className="admin-menu-item">
                    <FaUserShield />
                    Roles
                </Link>

                <Link to="/admin/permisos" className="admin-menu-item">
                    <FaKey />
                    Permisos
                </Link>

            </nav>
        </aside>
    );
}