import { Navigate } from "react-router-dom";
import { useAuth } from "../context/AuthContext";

export default function AdminRoute({ children }) {

    const { user, roles, loading } = useAuth();

    // Esperar a que cargue la sesión
    if (loading) {
        return null;
    }

    if (!user) {
        return <Navigate to="/login" replace />;
    }

    if (!roles.includes("admin")) {
        return <Navigate to="/" replace />;
    }

    return children;
}