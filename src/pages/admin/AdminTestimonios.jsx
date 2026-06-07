import { useEffect, useState } from "react";

import AdminLayout from "../../layouts/AdminLayout";

import {
    getTestimoniosAdmin,
    aprobarTestimonio,
    destacarTestimonio,
    deleteTestimonio
} from "../../api/adminTestimoniosService";

import {
    FaCheck,
    FaStar,
    FaSearch
} from "react-icons/fa";

export default function AdminTestimonios() {

    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);
    const [busqueda, setBusqueda] = useState("");

    // ── Filtros ──────────────────────────────────────
    const [filtroEstado, setFiltroEstado] = useState("");
    const [filtroDestacado, setFiltroDestacado] = useState("");
    const [filtroCalificacion, setFiltroCalificacion] = useState("");
    // ── Paginación ───────────────────────────────────
    const [porPagina, setPorPagina] = useState(10);
    const [paginaActual, setPaginaActual] = useState(1);
    // ────────────────────────────────────────────────

    const cargar = async () => {
        try {
            const res = await getTestimoniosAdmin();
            setData(res.data.data);
        } catch (err) {
            console.error("Error cargando testimonios", err);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        cargar();
    }, []);

    // ── Resetear página al cambiar filtros ───────────
    useEffect(() => {
        setPaginaActual(1);
    }, [busqueda, filtroEstado, filtroDestacado, filtroCalificacion, porPagina]);

    // ── Filtrado combinado ───────────────────────────
    const filtrados = data.filter(t => {

        const coincideBusqueda = `${t.nombre} ${t.comentario}`
            .toLowerCase()
            .includes(busqueda.toLowerCase());

        const coincideEstado =
            filtroEstado === "" ||
            (filtroEstado === "aprobado"  && t.aprobado) ||
            (filtroEstado === "pendiente" && !t.aprobado);

        const coincideDestacado =
            filtroDestacado === "" ||
            (filtroDestacado === "si" && t.destacado) ||
            (filtroDestacado === "no" && !t.destacado);

        const coincideCalificacion =
            filtroCalificacion === "" ||
            t.calificacion === parseInt(filtroCalificacion);

        return coincideBusqueda && coincideEstado && coincideDestacado && coincideCalificacion;

    });

    // ── Paginación ───────────────────────────────────
    const totalPaginas  = Math.ceil(filtrados.length / porPagina);
    const datosPagina   = filtrados.slice(
        (paginaActual - 1) * porPagina,
        paginaActual * porPagina
    );
    // ────────────────────────────────────────────────

    const handleAprobar = async (id) => {
        await aprobarTestimonio(id);
        cargar();
    };

    const handleDestacar = async (id) => {
        await destacarTestimonio(id);
        cargar();
    };

    const handleDelete = async (id) => {
        if (!confirm("¿Eliminar comentario?")) return;
        await deleteTestimonio(id);
        cargar();
    };

    const renderStars = (num) =>
        "★".repeat(num) + "☆".repeat(5 - num);

    return (

        <AdminLayout>

            <div className="admin-header">
                <h2>Administración de Comentarios</h2>
            </div>

            <div className="admin-toolbar">

                {/* Buscador */}
                <div className="search-box">
                    <FaSearch />
                    <input
                        placeholder="Buscar comentario..."
                        value={busqueda}
                        onChange={(e) => setBusqueda(e.target.value)}
                    />
                </div>

                {/* Filtro Estado */}
                <select
                    className="form-select"
                    value={filtroEstado}
                    onChange={(e) => setFiltroEstado(e.target.value)}
                >
                    <option value="">Todos los estados</option>
                    <option value="aprobado">Aprobado</option>
                    <option value="pendiente">Pendiente</option>
                </select>

                {/* Filtro Destacado */}
                <select
                    className="form-select"
                    value={filtroDestacado}
                    onChange={(e) => setFiltroDestacado(e.target.value)}
                >
                    <option value="">Destacado: Todos</option>
                    <option value="si">Sí</option>
                    <option value="no">No</option>
                </select>

                {/* Filtro Calificación */}
                <select
                    className="form-select"
                    value={filtroCalificacion}
                    onChange={(e) => setFiltroCalificacion(e.target.value)}
                >
                    <option value="">Todas las calificaciones</option>
                    {[5, 4, 3, 2, 1].map(n => (
                        <option key={n} value={n}>
                            {"★".repeat(n)} ({n})
                        </option>
                    ))}
                </select>

                {/* Por página */}
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
                                    <th>Usuario</th>
                                    <th>Comentario</th>
                                    <th>Calificación</th>
                                    <th>Estado</th>
                                    <th>Destacado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {datosPagina.map(t => (
                                    <tr key={t.id}>
                                        <td>{t.id}</td>
                                        <td>{t.nombre}</td>
                                        <td>{t.comentario}</td>
                                        <td className="text-warning">
                                            {renderStars(t.calificacion)}
                                        </td>
                                        <td>
                                            {t.aprobado
                                                ? <span className="badge bg-success">Aprobado</span>
                                                : <span className="badge bg-warning text-dark">Pendiente</span>}
                                        </td>
                                        <td>
                                            {t.destacado
                                                ? <span className="badge bg-primary">Sí</span>
                                                : <span className="badge bg-secondary">No</span>}
                                        </td>
                                        <td className="actions">
                                            <button
                                                className="btn-icon edit"
                                                title="Aprobar"
                                                onClick={() => handleAprobar(t.id)}
                                            >
                                                <FaCheck />
                                            </button>
                                            <button
                                                className="btn-icon delete"
                                                title="Destacar"
                                                onClick={() => handleDestacar(t.id)}
                                            >
                                                <FaStar />
                                            </button>
                                            <button
                                                className="btn-icon delete"
                                                title="Eliminar"
                                                onClick={() => handleDelete(t.id)}
                                            >
                                                🗑️
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
                            Mostrando {datosPagina.length} de {filtrados.length} comentarios
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

        </AdminLayout>

    );
}