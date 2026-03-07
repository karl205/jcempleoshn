import AdminLayout from "../../layouts/AdminLayout";

export default function AdminDashboard() {

    return (

        <AdminLayout>

            <div className="admin-dashboard">

                <h2 className="mb-4">Panel Administrativo</h2>

                <div className="row g-4">

                    <div className="col-md-4">

                        <div className="admin-card">

                            <h5>Usuarios</h5>

                            <p>
                                Administración de cuentas del sistema.
                            </p>

                        </div>

                    </div>

                    <div className="col-md-4">

                        <div className="admin-card">

                            <h5>Roles</h5>

                            <p>
                                Gestión de roles del sistema.
                            </p>

                        </div>

                    </div>

                    <div className="col-md-4">

                        <div className="admin-card">

                            <h5>Permisos</h5>

                            <p>
                                Control de accesos y permisos.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </AdminLayout>

    );

}