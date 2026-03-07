import { useNavigate } from "react-router-dom";
import { useAuth } from "../context/AuthContext";
import { FaUserCircle, FaSignOutAlt } from "react-icons/fa";

export default function AdminNavbar() {

    const { user, logout } = useAuth();
    const navigate = useNavigate();

    const handleLogout = async () => {
        await logout();
        navigate("/");
    };

    return (

        <nav className="navbar navbar-modern admin-navbar">
            <div className="container-fluid d-flex justify-content-between">
                <div className="d-flex align-items-center gap-2">
                    <span className="brand-text">
                        JC Empleos Admin
                    </span>
                </div>

                <div className="d-flex align-items-center gap-3">
                    <div className="admin-user-info">
                        <FaUserCircle className="admin-user-icon" />
                        <span>
                            {user?.nombre} {user?.apellido}
                        </span>
                    </div>

                    <button
                        className="btn btn-sm btn-outline-danger rounded-pill"
                        onClick={handleLogout}
                    >
                        <FaSignOutAlt className="me-2" />
                        Cerrar sesión
                    </button>
                </div>
            </div>
        </nav>
    );
}