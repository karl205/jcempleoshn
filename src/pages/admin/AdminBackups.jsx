import { useEffect, useState } from "react";
import AdminLayout from "../../layouts/AdminLayout";
import {
    getBackups,
    createBackup,
    deleteBackup
} from "../../api/adminBackupService";
import { FaDownload, FaTimes } from "react-icons/fa";
import apiClient from "../../api/apiClient";

export default function AdminBackups() {

    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);
    const [creating, setCreating] = useState(false);
    const [message, setMessage] = useState(null);
    const [error, setError] = useState(null);
    const [deleting, setDeleting] = useState(null);

    // ── Filtros ──────────────────────────────────────
    const [fechaDesde, setFechaDesde] = useState("");
    const [fechaHasta, setFechaHasta] = useState("");
    // ── Paginación ───────────────────────────────────
    const [porPagina, setPorPagina] = useState(10);
    const [paginaActual, setPaginaActual] = useState(1);
    // ────────────────────────────────────────────────

    const cargar = async () => {
        try {
            setLoading(true);
            const res = await getBackups();
            setData(res.data.data || []);
        } catch (err) {
            console.error(err);
            setError("Error al cargar backups");
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
    }, [fechaDesde, fechaHasta, porPagina]);

    // ── Filtrado por rango de fechas ─────────────────
    const filtrados = data.filter(b => {

        const fecha = b.fecha ? new Date(b.fecha) : null;

        const coincideDesde =
            fechaDesde === "" || (fecha && fecha >= new Date(fechaDesde));

        const coincideHasta =
            fechaHasta === "" || (fecha && fecha <= new Date(fechaHasta + "T23:59:59"));

        return coincideDesde && coincideHasta;

    });

    // ── Paginación ───────────────────────────────────
    const totalPaginas = Math.ceil(filtrados.length / porPagina);
    const datosPagina  = filtrados.slice(
        (paginaActual - 1) * porPagina,
        paginaActual * porPagina
    );
    // ────────────────────────────────────────────────

    const handleCreate = async () => {
        try {
            setCreating(true);
            setMessage(null);
            setError(null);
            const res = await createBackup();
            setMessage(res.data.message || "Backup creado correctamente");
            await cargar();
        } catch (err) {
            console.error(err);
            setError("Error al crear backup");
        } finally {
            setCreating(false);
        }
    };

    const handleDownload = async (file) => {
        try {
            const res = await apiClient.get(`/admin/backups/${file}`, {
                responseType: "blob",
            });
            const url = window.URL.createObjectURL(new Blob([res.data]));
            const link = document.createElement("a");
            link.href = url;
            link.setAttribute("download", file);
            document.body.appendChild(link);
            link.click();
            link.remove();
        } catch (error) {
            console.error("Error descargando backup", error);
            alert("Error al descargar el backup");
        }
    };

    const handleDelete = async (file) => {
        if (!confirm("¿Eliminar backup? Esta acción no se puede deshacer.")) return;
        try {
            setDeleting(file);
            setMessage(null);
            setError(null);
            await deleteBackup(file);
            setMessage("Backup eliminado correctamente");
            await cargar();
        } catch (err) {
            console.error(err);
            setError("Error al eliminar backup");
        } finally {
            setDeleting(null);
        }
    };

    return (
        <AdminLayout>

            {/* HEADER */}
            <div className="admin-header d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 className="mb-0">Backups</h2>
                    <small className="text-muted">
                        Gestión de copias de seguridad del sistema
                    </small>
                </div>
                <button
                    className="btn btn-primary"
                    onClick={handleCreate}
                    disabled={creating}
                >
                    {creating ? (
                        <>
                            <span className="spinner-border spinner-border-sm me-2"></span>
                            Generando...
                        </>
                    ) : (
                        "Crear Backup"
                    )}
                </button>
            </div>

            {/* ALERTAS */}
            {message && (
                <div className="alert alert-success shadow-sm">
                    ✔ {message}
                </div>
            )}
            {error && (
                <div className="alert alert-danger shadow-sm">
                    ❌ {error}
                </div>
            )}

            {/* TOOLBAR */}
            <div className="admin-toolbar mb-3">

                {/* Desde */}
                <div className="d-flex align-items-center gap-2">
                    <label className="mb-0 text-nowrap">Desde</label>
                    <input
                        type="date"
                        className="form-control"
                        value={fechaDesde}
                        onChange={(e) => setFechaDesde(e.target.value)}
                    />
                </div>

                {/* Hasta */}
                <div className="d-flex align-items-center gap-2">
                    <label className="mb-0 text-nowrap">Hasta</label>
                    <input
                        type="date"
                        className="form-control"
                        value={fechaHasta}
                        onChange={(e) => setFechaHasta(e.target.value)}
                    />
                </div>

                {/* Limpiar fechas */}
                {(fechaDesde || fechaHasta) && (
                    <button
                        className="btn btn-sm btn-light"
                        onClick={() => { setFechaDesde(""); setFechaHasta(""); }}
                    >
                        Limpiar fechas
                    </button>
                )}

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

            {/* CONTENIDO */}
            <div className="admin-card">

                {loading ? (
                    <div className="text-center py-5">
                        <div className="spinner-border"></div>
                        <p className="mt-2">Cargando backups...</p>
                    </div>
                ) : (
                    <>
                        <table className="table table-hover align-middle mb-0">
                            <thead className="table-light">
                                <tr>
                                    <th>Archivo</th>
                                    <th>Tamaño</th>
                                    <th>Fecha</th>
                                    <th className="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                {datosPagina.length === 0 && (
                                    <tr>
                                        <td colSpan="4" className="text-center py-4">
                                            No hay backups en el rango seleccionado
                                        </td>
                                    </tr>
                                )}

                                {datosPagina.map((b) => {
                                    const sizeKB = b.size
                                        ? (b.size / 1024).toFixed(2)
                                        : "0.00";
                                    const fecha = b.fecha
                                        ? new Date(b.fecha).toLocaleString()
                                        : "-";
                                    return (
                                        <tr key={b.nombre}>
                                            <td className="fw-semibold">{b.nombre}</td>
                                            <td>{sizeKB} KB</td>
                                            <td>{fecha}</td>
                                            <td className="actions">
                                                <button
                                                    className="btn-icon edit"
                                                    onClick={() => handleDownload(b.nombre)}
                                                >
                                                    <FaDownload />
                                                </button>
                                                <button
                                                    className="btn-icon delete"
                                                    onClick={() => handleDelete(b.nombre)}
                                                    disabled={deleting === b.nombre}
                                                >
                                                    <FaTimes />
                                                </button>
                                            </td>
                                        </tr>
                                    );
                                })}

                            </tbody>
                        </table>

                        {/* ── Paginación ── */}
                        <div className="admin-pagination mt-3">

                            <span className="pagination-info">
                                Mostrando {datosPagina.length} de {filtrados.length} backups
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

            </div>

        </AdminLayout>
    );
}