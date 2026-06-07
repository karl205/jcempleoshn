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

    // ── Filtros (con defaults) ───────────────────────
    const [filtroRol, setFiltroRol] = useState("");      // se asigna después de cargar roles
    const [filtroEstado, setFiltroEstado] = useState("activo");
    // ── Paginación ───────────────────────────────────
    const [porPagina, setPorPagina] = useState(10);
    const [paginaActual, setPaginaActual] = useState(1);
    // ────────────────────────────────────────────────

    const [showModal, setShowModal] = useState(false);
    const [usuarioEditar, setUsuarioEditar] = useState(null);
    const [roles, setRoles] = useState([]);

    const cargarRoles = async () => {
        try {
            const response = await getRoles();
            const data = response.data.data;
            setRoles(data);

            // ── Default: primer rol cuyo nombre incluya "administrador" ──
            const rolAdmin = data.find(r =>
                r.descripcion?.toLowerCase().includes("administrador")
            );
            if (rolAdmin) setFiltroRol(String(rolAdmin.id));

        } catch (error) {
            console.error("Error cargando roles", error);
        }
    };

    const cargarUsuarios = async () => {
        try {
            const response = await getUsuarios();
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

    // ── Resetear página al cambiar filtros ───────────
    useEffect(() => {
        setPaginaActual(1);
    }, [busqueda, filtroRol, filtroEstado, porPagina]);

    // ── Filtrado combinado ───────────────────────────
    const usuariosFiltrados = usuarios.filter(u => {

        const coincideBusqueda = `${u.nombre} ${u.apellido} ${u.email}`
            .toLowerCase()
            .includes(busqueda.toLowerCase());

        const coincideRol =
            filtroRol === "" || u.rol_id === parseInt(filtroRol);

        const coincideEstado =
            filtroEstado === "" ||
            (filtroEstado === "activo" && u.estado === 1) ||
            (filtroEstado === "inactivo" && u.estado === 0);

        return coincideBusqueda && coincideRol && coincideEstado;

    });

    // ── Paginación ───────────────────────────────────
    const totalPaginas = Math.ceil(usuariosFiltrados.length / porPagina);
    const usuariosPagina = usuariosFiltrados.slice(
        (paginaActual - 1) * porPagina,
        paginaActual * porPagina
    );
    // ────────────────────────────────────────────────

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

                {/* Buscador */}
                <div className="search-box">
                    <FaSearch />
                    <input
                        placeholder="Buscar usuario..."
                        value={busqueda}
                        onChange={(e) => setBusqueda(e.target.value)}
                    />
                </div>

                {/* Filtro por Rol */}
                <select
                    className="form-select"
                    value={filtroRol}
                    onChange={(e) => setFiltroRol(e.target.value)}
                >
                    <option value="">Todos los roles</option>
                    {roles.map(r => (
                        <option key={r.id} value={r.id}>
                            {r.descripcion}
                        </option>
                    ))}
                </select>

                {/* Filtro por Estado */}
                <select
                    className="form-select"
                    value={filtroEstado}
                    onChange={(e) => setFiltroEstado(e.target.value)}
                >
                    <option value="">Todos los estados</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>

                {/* Registros por página */}
                <select
                    className="form-select"
                    value={porPagina}
                    onChange={(e) => setPorPagina(parseInt(e.target.value))}
                >
                    <option value={5}>5 por página</option>
                    <option value={10}>10 por página</option>
                    <option value={25}>25 por página</option>
                    <option value={50}>50 por página</option>
                </select>

            </div>

            {loading ? (

                <p>Cargando...</p>

            ) : (

                <>
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
                                {usuariosPagina.map(u => (
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

                    {/* ── Paginación ── */}
                    <div className="admin-pagination">

                        <span className="pagination-info">
                            Mostrando {usuariosPagina.length} de {usuariosFiltrados.length} usuarios
                        </span>

                        <div className="pagination-controls">

                            <button
                                className="btn btn-sm btn-light"
                                onClick={() => setPaginaActual(p => Math.max(p - 1, 1))}
                                disabled={paginaActual === 1}
                            >
                                ‹ Anterior
                            </button>

                            {Array.from({ length: totalPaginas }, (_, i) => i + 1).map(n => (
                                <button
                                    key={n}
                                    className={`btn btn-sm ${paginaActual === n ? "btn-primary" : "btn-light"}`}
                                    onClick={() => setPaginaActual(n)}
                                >
                                    {n}
                                </button>
                            ))}

                            <button
                                className="btn btn-sm btn-light"
                                onClick={() => setPaginaActual(p => Math.min(p + 1, totalPaginas))}
                                disabled={paginaActual === totalPaginas || totalPaginas === 0}
                            >
                                Siguiente ›
                            </button>

                        </div>

                    </div>
                </>

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