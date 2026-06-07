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

    // ── Filtros y paginación ─────────────────────────
    const [filtroEstado, setFiltroEstado] = useState("activo");
    const [porPagina, setPorPagina] = useState(10);
    const [paginaActual, setPaginaActual] = useState(1);
    // ────────────────────────────────────────────────

    const [showModal, setShowModal] = useState(false);
    const [rolEditar, setRolEditar] = useState(null);

    const cargarRoles = async () => {
        try {
            const response = await getRoles();
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

    // ── Resetear página al cambiar filtros ───────────
    useEffect(() => {
        setPaginaActual(1);
    }, [busqueda, filtroEstado, porPagina]);

    // ── Filtrado combinado ───────────────────────────
    const rolesFiltrados = roles.filter(r => {

        const coincideBusqueda = `${r.nombre} ${r.descripcion}`
            .toLowerCase()
            .includes(busqueda.toLowerCase());

        const coincideEstado =
            filtroEstado === "" ||
            (filtroEstado === "activo" && r.estado === 1) ||
            (filtroEstado === "inactivo" && r.estado === 0);

        return coincideBusqueda && coincideEstado;

    });

    // ── Paginación ───────────────────────────────────
    const totalPaginas = Math.ceil(rolesFiltrados.length / porPagina);
    const rolesPagina = rolesFiltrados.slice(
        (paginaActual - 1) * porPagina,
        paginaActual * porPagina
    );
    // ────────────────────────────────────────────────

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

                {/* Buscador */}
                <div className="search-box">
                    <FaSearch />
                    <input
                        placeholder="Buscar rol..."
                        value={busqueda}
                        onChange={(e) => setBusqueda(e.target.value)}
                    />
                </div>

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
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {rolesPagina.map(r => (
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

                    {/* ── Paginación ── */}
                    <div className="admin-pagination">

                        <span className="pagination-info">
                            Mostrando {rolesPagina.length} de {rolesFiltrados.length} roles
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

            <RolModal
                show={showModal}
                onClose={() => setShowModal(false)}
                onSave={handleGuardar}
                rol={rolEditar}
            />

        </AdminLayout>

    );
}