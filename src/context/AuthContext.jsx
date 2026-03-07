import { createContext, useContext, useState, useEffect } from "react";
import { logoutRequest } from "../api/authService";

const AuthContext = createContext();

export const AuthProvider = ({ children }) => {

    const [user, setUser] = useState(null);
    const [roles, setRoles] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {

        const storedUser = localStorage.getItem("user");
        const storedRoles = localStorage.getItem("roles");

        if (storedUser) {
            try {
                setUser(JSON.parse(storedUser));
            } catch {
                localStorage.removeItem("user");
            }
        }

        if (storedRoles) {
            try {
                setRoles(JSON.parse(storedRoles));
            } catch {
                localStorage.removeItem("roles");
            }
        }

        setLoading(false);

    }, []);

    const logout = async () => {

        try {
            await logoutRequest();
        } catch {}

        localStorage.removeItem("token");
        localStorage.removeItem("user");
        localStorage.removeItem("roles");

        setUser(null);
        setRoles([]);
    };

    return (
        <AuthContext.Provider value={{ user, roles, setUser, setRoles, logout, loading }}>
            {children}
        </AuthContext.Provider>
    );
};

export const useAuth = () => useContext(AuthContext);