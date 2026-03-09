import { useEffect, useState } from "react";
import AdminLayout from "../../layouts/AdminLayout";
import UsuarioModal from "../../components/admin/UsuarioModal";
import { can } from "../../utils/permissions";

import {
    getUsuarios,
    crearUsuario,
    actualizarUsuario,
    desactivarUsuario
} from "../../api/adminUsuariosService";

import { getRoles } from "../../api/adminRolesService";

import {
    FaPlus,
    FaEdit,
    FaUserSlash,
    FaSearch
} from "react-icons/fa";

export default function AdminUsuarios() {

    const [usuarios, setUsuarios] = useState([]);
    const [loading, setLoading] = useState(true);
    const [busqueda, setBusqueda] = useState("");

    const [showModal, setShowModal] = useState(false);
    const [usuarioEditar, setUsuarioEditar] = useState(null);

    const [roles, setRoles] = useState([]);

    const cargarRoles = async () => {

        try {

            const response = await getRoles();

            setRoles(response.data.data);

        } catch (error) {

            console.error("Error cargando roles", error);

        }

    };

    const cargarUsuarios = async () => {

        try {

            const response = await getUsuarios();

            console.log("RESPUESTA API USUARIOS:", response);

            setUsuarios(response.data.data);

        } catch (error) {

            console.error("Error cargando usuarios", error);

        } finally {

            setLoading(false);

        }

    };

    useEffect(() => {

        cargarUsuarios();
        cargarRoles();

    }, []);

    const usuariosFiltrados = usuarios.filter(u =>
        `${u.nombre} ${u.apellido} ${u.email}`
            .toLowerCase()
            .includes(busqueda.toLowerCase())
    );

    const handleCrear = () => {

        setUsuarioEditar(null);
        setShowModal(true);

    };

    const handleEditar = (u) => {

        setUsuarioEditar(u);
        setShowModal(true);

    };

    const handleGuardar = async (form) => {

        try {

            if (usuarioEditar) {

                await actualizarUsuario(usuarioEditar.id, form);

            } else {

                await crearUsuario(form);

            }

            setShowModal(false);
            cargarUsuarios();

        } catch (error) {

            console.error("Error guardando usuario", error);

        }

    };

    const handleDesactivar = async (id) => {

        if (!window.confirm("¿Desea desactivar este usuario?")) return;

        try {

            await desactivarUsuario(id);
            cargarUsuarios();

        } catch (error) {

            console.error("Error desactivando usuario", error);

        }

    };

    return (

        <AdminLayout>

            <div className="admin-header">

                <h2>Administración de Usuarios</h2>

                {can("usuarios.crear") && (

                    <button
                        className="btn btn-primary rounded-pill"
                        onClick={handleCrear}
                    >
                        <FaPlus className="me-2" />
                        Nuevo Usuario
                    </button>

                )}

            </div>

            <div className="admin-toolbar">

                <div className="search-box">
                    <FaSearch />
                    <input
                        placeholder="Buscar usuario..."
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
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>

                            {usuariosFiltrados.map(u => (

                                <tr key={u.id}>

                                    <td>{u.id}</td>

                                    <td>{u.nombre} {u.apellido}</td>

                                    <td>{u.email}</td>

                                    <td>
                                        <span className="badge bg-primary">
                                            {u.rol}
                                        </span>
                                    </td>

                                    <td>
                                        {u.estado === 1
                                            ? <span className="badge bg-success">Activo</span>
                                            : <span className="badge bg-danger">Inactivo</span>}
                                    </td>

                                    <td className="actions">

                                        {can("usuarios.editar") && (

                                            <button
                                                className="btn-icon edit"
                                                onClick={() => handleEditar(u)}
                                            >
                                                <FaEdit />
                                            </button>

                                        )}

                                        {can("usuarios.eliminar") && (

                                            <button
                                                className="btn-icon delete"
                                                onClick={() => handleDesactivar(u.id)}
                                            >
                                                <FaUserSlash />
                                            </button>

                                        )}

                                    </td>

                                </tr>

                            ))}

                        </tbody>

                    </table>

                </div>

            )}

            <UsuarioModal
                show={showModal}
                onClose={() => setShowModal(false)}
                onSave={handleGuardar}
                roles={roles}
                usuario={usuarioEditar}
            />

        </AdminLayout>

    );

}