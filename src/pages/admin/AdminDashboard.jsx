import AdminLayout from "../../layouts/AdminLayout";
import { useAuth } from "../../context/AuthContext";

export default function AdminDashboard() {

    const { user, roles } = useAuth();

    const rolPrincipal = roles?.length ? roles[0] : "usuario";

    return (

        <AdminLayout>

            <h1>Panel Administrativo</h1>

            <p>
                Bienvenido {user?.nombre}

                <span className="badge bg-primary ms-2">
                    {rolPrincipal}
                </span>
            </p>

        </AdminLayout>

    );

}