import { useEffect } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import { useAuth } from "../context/AuthContext";

export default function RequirePasswordChangeGuard({ children }) {
    const { user } = useAuth();
    const location = useLocation();
    const navigate = useNavigate();

    useEffect(() => {
        const debeCambiar = user?.must_change_password;
        const yaEstaEnLaPantalla = location.pathname === "/change-password-required";

        if (debeCambiar && !yaEstaEnLaPantalla) {
            navigate("/change-password-required", { replace: true });
        }
    }, [user, location.pathname, navigate]);

    return children;
}