import { createContext, useContext, useState, useEffect } from "react";
import { logoutRequest } from "../api/authService";

const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
    const [user, setUser] = useState(null);

    useEffect(() => {
        const storedUser = localStorage.getItem("user");

        if (storedUser && storedUser !== "undefined") {
            try {
                setUser(JSON.parse(storedUser));
            } catch (error) {
                console.error("Error parseando user:", error);
                localStorage.removeItem("user");
            }
        }
    }, []);

    const logout = async () => {
        try {
            await logoutRequest();
        } catch (error) {
            console.log("Error cerrando sesión en backend:", error);
        }

        localStorage.removeItem("token");
        localStorage.removeItem("user");
        setUser(null);
    };

    return (
        <AuthContext.Provider value={{ user, setUser, logout }}>
            {children}
        </AuthContext.Provider>
    );
};

export const useAuth = () => useContext(AuthContext);