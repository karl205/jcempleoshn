import { useEffect, useState, useRef } from "react";

import AdminLayout from "../../layouts/AdminLayout";

import {
    getAyudaGestion,
    crearAyuda,
    actualizarAyuda,
    desactivarAyuda,
    activarAyuda,
    eliminarAyuda,
    verAyudaGestion,
    descargarAyudaGestion,
} from "../../api/adminAyudaService";

import {
    FaEdit,
    FaTrash,
    FaEye,
    FaDownload,
    FaSearch,
    FaPlus,
    FaToggleOn,
    FaToggleOff,
} from "react-icons/fa";

const initialForm = {
    id: null,
    seccion: "publico",
    titulo: "",
    descripcion: "",
    orden: 0,
    archivo: null,
};

export default function AdminAyuda() {

    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);
    const [busqueda, setBusqueda] = useState("");
    const [procesando, setProcesando] = useState(null);

    // ── Filtros ──────────────────────────────────────
    const [filtroSeccion, setFiltroSeccion] = useState("");
    const [filtroEstado, setFiltroEstado] = useState("");
    // ── Paginación ───────────────────────────────────
    const [porPagina, setPorPagina] = useState(10);
    const [paginaActual, setPaginaActual] = useState(1);
    // ── Modal formulario ─────────────────────────────
    const [modalOpen, setModalOpen] = useState(false);
    const [form, setForm] = useState(initialForm);
    const [guardando, setGuardando] = useState(false);
    const modalRef = useRef(null);
    // ────────────────────────────────────────────────

    const cargar = async () => {
        try {
            const res = await getAyudaGestion();
            setData(res.data.data);
        } catch (err) {
            console.error("Error cargando ayuda", err);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        cargar();
    }, []);

    useEffect(() => {
        setPaginaActual(1);
    }, [busqueda, filtroSeccion, filtroEstado, porPagina]);

    // Cierra el modal al hacer clic afuera. Usa "mousedown" (no "click"),
    // así que seleccionar texto arrastrando el mouse dentro nunca lo cierra.
    useEffect(() => {
        if (!modalOpen) return;

        const handleMouseDown = (e) => {
            if (modalRef.current && !modalRef.current.contains(e.target)) {
                setModalOpen(false);
            }
        };

        document.addEventListener("mousedown", handleMouseDown);
        return () => document.removeEventListener("mousedown", handleMouseDown);
    }, [modalOpen]);

    // ── Filtrado combinado ───────────────────────────
    const filtrados = data.filter(a => {

        const coincideBusqueda = `${a.titulo} ${a.descripcion ?? ""}`
            .toLowerCase()
            .includes(busqueda.toLowerCase());

        const coincideSeccion =
            filtroSeccion === "" || a.seccion === filtroSeccion;

        const coincideEstado =
            filtroEstado === "" ||
            (filtroEstado === "activo" && a.estado) ||
            (filtroEstado === "inactivo" && !a.estado);

        return coincideBusqueda && coincideSeccion && coincideEstado;
    });

    const totalPaginas = Math.ceil(filtrados.length / porPagina);
    const datosPagina = filtrados.slice(
        (paginaActual - 1) * porPagina,
        paginaActual * porPagina
    );

    // ── Acciones ─────────────────────────────────────

    const abrirCrear = () => {
        setForm(initialForm);
        setModalOpen(true);
    };

    const abrirEditar = (item) => {
        setForm({
            id: item.id,
            seccion: item.seccion,
            titulo: item.titulo,
            descripcion: item.descripcion ?? "",
            orden: item.orden ?? 0,
            archivo: null,
        });
        setModalOpen(true);
    };

    const handleGuardar = async (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append("seccion", form.seccion);
        formData.append("titulo", form.titulo);
        formData.append("descripcion", form.descripcion ?? "");
        formData.append("orden", form.orden === "" || form.orden === null ? 0 : parseInt(form.orden, 10));
        if (form.archivo) formData.append("archivo", form.archivo);

        try {
            setGuardando(true);

            if (form.id) {
                await actualizarAyuda(form.id, formData);
            } else {
                await crearAyuda(formData);
            }

            setModalOpen(false);
            cargar();
        } catch (err) {
            console.error("Error guardando documento", err);
            alert(err.response?.data?.message || "Error al guardar el documento");
        } finally {
            setGuardando(false);
        }
    };

    const handleToggleEstado = async (item) => {
        setProcesando(item.id);
        try {
            if (item.estado) {
                await desactivarAyuda(item.id);
            } else {
                await activarAyuda(item.id);
            }
            cargar();
        } finally {
            setProcesando(null);
        }
    };

    const handleEliminar = async (id) => {
        if (!confirm("¿Eliminar este documento de ayuda? Esta acción no se puede deshacer.")) return;
        await eliminarAyuda(id);
        cargar();
    };

    const abrirBlob = (blob, nombre, forzarDescarga) => {
        const blobUrl = URL.createObjectURL(new Blob([blob], { type: "application/pdf" }));

        if (forzarDescarga) {
            const link = document.createElement("a");
            link.href = blobUrl;
            link.download = `${nombre}.pdf`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        } else {
            window.open(blobUrl, "_blank");
        }

        setTimeout(() => URL.revokeObjectURL(blobUrl), 10000);
    };

    const handleVer = async (item) => {
        const res = await verAyudaGestion(item.id);
        abrirBlob(res.data, item.titulo, false);
    };

    const handleDescargar = async (item) => {
        const res = await descargarAyudaGestion(item.id);
        abrirBlob(res.data, item.titulo, true);
    };

    return (

        <AdminLayout>

            <div className="admin-header">
                <h2>Administración de Ayuda</h2>
                <button className="btn btn-primary" onClick={abrirCrear}>
                    <FaPlus className="me-2" />
                    Nuevo documento
                </button>
            </div>

            <div className="admin-toolbar">

                <div className="search-box">
                    <FaSearch />
                    <input
                        placeholder="Buscar documento..."
                        value={busqueda}
                        onChange={(e) => setBusqueda(e.target.value)}
                    />
                </div>

                <select
                    className="form-select"
                    value={filtroSeccion}
                    onChange={(e) => setFiltroSeccion(e.target.value)}
                >
                    <option value="">Todas las secciones</option>
                    <option value="publico">Pública</option>
                    <option value="admin">Administrativa</option>
                </select>

                <select
                    className="form-select"
                    value={filtroEstado}
                    onChange={(e) => setFiltroEstado(e.target.value)}
                >
                    <option value="">Todos los estados</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>

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
                                    <th>Sección</th>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Orden</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {datosPagina.map(a => (
                                    <tr key={a.id}>
                                        <td>{a.id}</td>
                                        <td>
                                            {a.seccion === "publico"
                                                ? <span className="badge bg-info text-dark">Pública</span>
                                                : <span className="badge bg-dark">Administrativa</span>}
                                        </td>
                                        <td>{a.titulo}</td>
                                        <td>{a.descripcion}</td>
                                        <td>{a.orden}</td>
                                        <td>
                                            {a.estado
                                                ? <span className="badge bg-success">Activo</span>
                                                : <span className="badge bg-secondary">Inactivo</span>}
                                        </td>
                                        <td className="actions">
                                            <button
                                                className="btn-icon view"
                                                title="Ver"
                                                onClick={() => handleVer(a)}
                                            >
                                                <FaEye />
                                            </button>
                                            <button
                                                className="btn-icon view"
                                                title="Descargar"
                                                onClick={() => handleDescargar(a)}
                                            >
                                                <FaDownload />
                                            </button>
                                            <button
                                                className="btn-icon edit"
                                                title="Editar"
                                                onClick={() => abrirEditar(a)}
                                            >
                                                <FaEdit />
                                            </button>
                                            <button
                                                className="btn-icon edit"
                                                title={a.estado ? "Desactivar" : "Activar"}
                                                onClick={() => handleToggleEstado(a)}
                                                disabled={procesando === a.id}
                                            >
                                                {a.estado ? <FaToggleOn /> : <FaToggleOff />}
                                            </button>
                                            <button
                                                className="btn-icon delete"
                                                title="Eliminar"
                                                onClick={() => handleEliminar(a.id)}
                                            >
                                                <FaTrash />
                                            </button>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    <div className="admin-pagination">

                        <span className="pagination-info">
                            Mostrando {datosPagina.length} de {filtrados.length} documentos
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

            {/* ── Modal crear/editar ── */}
            {modalOpen && (
                <div className="ayuda-modal-overlay">
                    <div className="ayuda-modal" ref={modalRef}>

                        <div className="ayuda-modal-header">
                            <h3>{form.id ? "Editar documento" : "Nuevo documento"}</h3>
                            <button
                                className="help-close-btn"
                                onClick={() => setModalOpen(false)}
                            >
                                ×
                            </button>
                        </div>

                        <form onSubmit={handleGuardar}>

                            <div className="mb-3">
                                <label className="form-label">Sección</label>
                                <select
                                    className="form-select"
                                    value={form.seccion}
                                    onChange={(e) => setForm({ ...form, seccion: e.target.value })}
                                    required
                                >
                                    <option value="publico">Pública (postulantes)</option>
                                    <option value="admin">Administrativa</option>
                                </select>
                            </div>

                            <div className="mb-3">
                                <label className="form-label">Título</label>
                                <input
                                    type="text"
                                    className="form-control"
                                    value={form.titulo}
                                    onChange={(e) => setForm({ ...form, titulo: e.target.value })}
                                    maxLength={255}
                                    required
                                />
                            </div>

                            <div className="mb-3">
                                <label className="form-label">Descripción</label>
                                <input
                                    type="text"
                                    className="form-control"
                                    value={form.descripcion}
                                    onChange={(e) => setForm({ ...form, descripcion: e.target.value })}
                                    maxLength={255}
                                />
                            </div>

                            <div className="mb-3">
                                <label className="form-label">Orden</label>
                                <input
                                    type="number"
                                    className="form-control"
                                    value={form.orden}
                                    onChange={(e) => setForm({ ...form, orden: e.target.value })}
                                    min={0}
                                />
                            </div>

                            <div className="mb-3">
                                <label className="form-label">
                                    Archivo PDF {form.id && "(déjalo vacío para conservar el actual)"}
                                </label>
                                <input
                                    type="file"
                                    className="form-control"
                                    accept="application/pdf"
                                    onChange={(e) => setForm({ ...form, archivo: e.target.files[0] })}
                                    required={!form.id}
                                />
                            </div>

                            <div className="ayuda-modal-footer">
                                <button
                                    type="button"
                                    className="btn btn-light"
                                    onClick={() => setModalOpen(false)}
                                >
                                    Cancelar
                                </button>
                                <button
                                    type="submit"
                                    className="btn btn-primary"
                                    disabled={guardando}
                                >
                                    {guardando ? "Guardando..." : "Guardar"}
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            )}

        </AdminLayout>

    );
}