import { useEffect, useState } from "react";
import AdminLayout from "../../layouts/AdminLayout";
import { getBitacora } from "../../api/adminBitacoraService";
import { FaSearch } from "react-icons/fa";

export default function AdminBitacora() {

    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);
    const [busqueda, setBusqueda] = useState("");

    // ── Filtros ──────────────────────────────────────
    const [filtroModulo, setFiltroModulo] = useState("");
    const [filtroAccion, setFiltroAccion] = useState("");
    const [fechaDesde, setFechaDesde] = useState("");
    const [fechaHasta, setFechaHasta] = useState("");
    // ── Paginación ───────────────────────────────────
    const [porPagina, setPorPagina] = useState(10);
    const [paginaActual, setPaginaActual] = useState(1);
    // ────────────────────────────────────────────────

    const cargar = async () => {
        try {
            const res = await getBitacora();
            setData(res.data.data);
        } catch (err) {
            console.error("Error cargando bitácora", err);
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
    }, [busqueda, filtroModulo, filtroAccion, fechaDesde, fechaHasta, porPagina]);

    // ── Opciones dinámicas ───────────────────────────
    const modulos  = [...new Set(data.map(b => b.modulo).filter(Boolean))].sort();
    const acciones = [...new Set(data.map(b => b.accion).filter(Boolean))].sort();

    // ── Filtrado combinado ───────────────────────────
    const filtrados = data.filter(b => {

        const coincideBusqueda = `${b.usuario} ${b.modulo} ${b.accion} ${b.descripcion}`
            .toLowerCase()
            .includes(busqueda.toLowerCase());

        const coincideModulo =
            filtroModulo === "" || b.modulo === filtroModulo;

        const coincideAccion =
            filtroAccion === "" || b.accion === filtroAccion;

        const fecha = new Date(b.created_at);

        const coincideDesde =
            fechaDesde === "" || fecha >= new Date(fechaDesde);

        const coincideHasta =
            fechaHasta === "" || fecha <= new Date(fechaHasta + "T23:59:59");

        return coincideBusqueda && coincideModulo && coincideAccion && coincideDesde && coincideHasta;

    });

    // ── Paginación ───────────────────────────────────
    const totalPaginas = Math.ceil(filtrados.length / porPagina);
    const datosPagina  = filtrados.slice(
        (paginaActual - 1) * porPagina,
        paginaActual * porPagina
    );
    // ────────────────────────────────────────────────

    return (
        <AdminLayout>

            <div className="admin-header">
                <h2>Bitácora del sistema</h2>
            </div>

            <div className="admin-toolbar">

                {/* Buscador */}
                <div className="search-box">
                    <FaSearch />
                    <input
                        placeholder="Buscar..."
                        value={busqueda}
                        onChange={(e) => setBusqueda(e.target.value)}
                    />
                </div>

                {/* Filtro Módulo */}
                <select
                    className="form-select"
                    value={filtroModulo}
                    onChange={(e) => setFiltroModulo(e.target.value)}
                >
                    <option value="">Todos los módulos</option>
                    {modulos.map(m => (
                        <option key={m} value={m}>{m}</option>
                    ))}
                </select>

                {/* Filtro Acción */}
                <select
                    className="form-select"
                    value={filtroAccion}
                    onChange={(e) => setFiltroAccion(e.target.value)}
                >
                    <option value="">Todas las acciones</option>
                    {acciones.map(a => (
                        <option key={a} value={a}>{a}</option>
                    ))}
                </select>

                {/* Rango de fechas */}
                <input
                    type="date"
                    className="form-control"
                    value={fechaDesde}
                    onChange={(e) => setFechaDesde(e.target.value)}
                    title="Desde"
                />

                <input
                    type="date"
                    className="form-control"
                    value={fechaHasta}
                    onChange={(e) => setFechaHasta(e.target.value)}
                    title="Hasta"
                />

                {/* Por página */}
                <select
                    className="form-select"
                    value={porPagina}
                    onChange={(e) => setPorPagina(parseInt(e.target.value))}
                >
                    <option value={10}>10 por página</option>
                    <option value={25}>25 por página</option>
                    <option value={50}>50 por página</option>
                    <option value={100}>100 por página</option>
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
                                    <th>Módulo</th>
                                    <th>Acción</th>
                                    <th>Descripción</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                {datosPagina.map(b => (
                                    <tr key={b.id}>
                                        <td>{b.id}</td>
                                        <td>{b.usuario || "Sistema"}</td>
                                        <td>{b.modulo}</td>
                                        <td>
                                            <span className="badge bg-dark">
                                                {b.accion}
                                            </span>
                                        </td>
                                        <td>{b.descripcion}</td>
                                        <td>
                                            {new Date(b.created_at).toLocaleString()}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {/* ── Paginación ── */}
                    <div className="admin-pagination">

                        <span className="pagination-info">
                            Mostrando {datosPagina.length} de {filtrados.length} registros
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