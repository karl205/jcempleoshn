import { useEffect, useState } from "react";

import AdminLayout from "../../layouts/AdminLayout";
import RolModal from "../../components/admin/RolModal";

import {
    getRoles,
    crearRol,
    actualizarRol,
    desactivarRol
} from "../../api/adminRolesService";

import {
    FaPlus,
    FaEdit,
    FaUserSlash,
    FaSearch
} from "react-icons/fa";

export default function AdminRoles() {

    const [roles, setRoles] = useState([]);
    const [loading, setLoading] = useState(true);
    const [busqueda, setBusqueda] = useState("");

    const [showModal, setShowModal] = useState(false);
    const [rolEditar, setRolEditar] = useState(null);

    const cargarRoles = async () => {

        try {

            const response = await getRoles();

            console.log("RESPUESTA API ROLES:", response);

            setRoles(response.data.data);

        } catch (error) {

            console.error("Error cargando roles", error);

        } finally {

            setLoading(false);

        }

    };

    useEffect(() => {

        cargarRoles();

    }, []);

    const rolesFiltrados = roles.filter(r =>
        `${r.nombre} ${r.descripcion}`
            .toLowerCase()
            .includes(busqueda.toLowerCase())
    );

    const handleCrear = () => {

        setRolEditar(null);
        setShowModal(true);

    };

    const handleEditar = (r) => {

        setRolEditar(r);
        setShowModal(true);

    };

    const handleGuardar = async (form) => {

        try {

            if (rolEditar) {

                await actualizarRol(rolEditar.id, form);

            } else {

                await crearRol(form);

            }

            setShowModal(false);

            cargarRoles();

        } catch (error) {

            console.error("Error guardando rol", error);

        }

    };

    const handleDesactivar = async (id) => {

        if (!window.confirm("¿Desea desactivar este rol?")) return;

        try {

            await desactivarRol(id);

            cargarRoles();

        } catch (error) {

            console.error("Error desactivando rol", error);

        }

    };

    return (

        <AdminLayout>

            <div className="admin-header">

                <h2>Administración de Roles</h2>

                <button
                    className="btn btn-primary rounded-pill"
                    onClick={handleCrear}
                >
                    <FaPlus className="me-2" />
                    Nuevo Rol
                </button>

            </div>

            <div className="admin-toolbar">

                <div className="search-box">

                    <FaSearch />

                    <input
                        placeholder="Buscar rol..."
                        value={busqueda}
                        onChange={(e) => setBusqueda(e.target.value)}
                    />

                </div>

            </div>

            {loading ? (

                <p>Cargando...</p>

            ) : (

                <div className="admin-table-wrapper">

                    <table className="admin-table">

                        <thead>

                            <tr>

                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Acciones</th>

                            </tr>

                        </thead>

                        <tbody>

                            {rolesFiltrados.map(r => (

                                <tr key={r.id}>

                                    <td>{r.id}</td>

                                    <td>{r.nombre}</td>

                                    <td>{r.descripcion}</td>

                                    <td>

                                        {r.estado === 1
                                            ? <span className="badge bg-success">Activo</span>
                                            : <span className="badge bg-danger">Inactivo</span>}

                                    </td>

                                    <td className="actions">

                                        <button
                                            className="btn-icon edit"
                                            onClick={() => handleEditar(r)}
                                        >
                                            <FaEdit />
                                        </button>

                                        <button
                                            className="btn-icon delete"
                                            onClick={() => handleDesactivar(r.id)}
                                        >
                                            <FaUserSlash />
                                        </button>

                                    </td>

                                </tr>

                            ))}

                        </tbody>

                    </table>

                </div>

            )}

            <RolModal
                show={showModal}
                onClose={() => setShowModal(false)}
                onSave={handleGuardar}
                rol={rolEditar}
            />

        </AdminLayout>

    );

}