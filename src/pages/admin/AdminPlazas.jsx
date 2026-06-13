import { useEffect, useState } from "react";
import AdminLayout from "../../layouts/AdminLayout";
import PlazaModal from "../../components/admin/PlazaModal";
import PlazaVerModal from "../../components/admin/PlazaVerModal";

import {
    getPlazas,
    getPlaza,
    crearPlaza,
    actualizarPlaza,
    cerrarPlaza
} from "../../api/adminPlazasService";

import {
    FaPlus,
    FaEdit,
    FaTimes,
    FaSearch,
    FaEye
} from "react-icons/fa";

export default function AdminPlazas() {

    const [plazas, setPlazas] = useState([]);
    const [loading, setLoading] = useState(true);
    const [busqueda, setBusqueda] = useState("");

    // ── Filtros ──────────────────────────────────────
    const [filtroEstado, setFiltroEstado] = useState("activa");
    const [filtroCiudad, setFiltroCiudad] = useState("");
    const [filtroCargo, setFiltroCargo] = useState("");
    // ── Paginación ───────────────────────────────────
    const [porPagina, setPorPagina] = useState(10);
    const [paginaActual, setPaginaActual] = useState(1);
    // ────────────────────────────────────────────────

    const [showModal, setShowModal] = useState(false);
    const [plazaEditar, setPlazaEditar] = useState(null);

    const [showModalVer, setShowModalVer] = useState(false);
    const [plazaVer, setPlazaVer] = useState(null);

    const cargarPlazas = async () => {
        try {
            const response = await getPlazas();
            setPlazas(response.data.data);
        } catch (error) {
            console.error("Error cargando plazas", error);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        cargarPlazas();
    }, []);

    // ── Resetear página al cambiar filtros ───────────
    useEffect(() => {
        setPaginaActual(1);
    }, [busqueda, filtroEstado, filtroCiudad, filtroCargo, porPagina]);

    // ── Opciones dinámicas desde los datos ───────────
    const ciudades = [...new Set(plazas.map(p => p.ciudad).filter(Boolean))].sort();
    const cargos   = [...new Set(plazas.map(p => p.cargo).filter(Boolean))].sort();

    // ── Filtrado combinado ───────────────────────────
    const plazasFiltradas = plazas.filter(p => {

        const coincideBusqueda = `${p.titulo} ${p.cargo} ${p.ciudad}`
            .toLowerCase()
            .includes(busqueda.toLowerCase());

        const coincideEstado =
            filtroEstado === "" ||
            (filtroEstado === "activa"  && p.estado === 1) ||
            (filtroEstado === "cerrada" && p.estado === 0);

        const coincideCiudad =
            filtroCiudad === "" || p.ciudad === filtroCiudad;

        const coincideCargo =
            filtroCargo === "" || p.cargo === filtroCargo;

        return coincideBusqueda && coincideEstado && coincideCiudad && coincideCargo;
    });

    // ── Paginación ───────────────────────────────────
    const totalPaginas = Math.ceil(plazasFiltradas.length / porPagina);
    const plazasPagina = plazasFiltradas.slice(
        (paginaActual - 1) * porPagina,
        paginaActual * porPagina
    );
    // ────────────────────────────────────────────────

    const handleCrear = () => {
        setPlazaEditar(null);
        setShowModal(true);
    };

    const handleEditar = async (p) => {
        try {
            const response = await getPlaza(p.id);
            setPlazaEditar(response.data.data);
            setShowModal(true);
        } catch (error) {
            console.error("Error obteniendo plaza", error);
        }
    };

    const handleVer = async (p) => {
        try {
            const response = await getPlaza(p.id);
            setPlazaVer(response.data.data);
            setShowModalVer(true);
        } catch (error) {
            console.error("Error obteniendo plaza", error);
        }
    };

    const handleGuardar = async (form) => {
        try {
            if (plazaEditar) {
                await actualizarPlaza(plazaEditar.id, form);
            } else {
                const limpiarDatos = (data) => ({
                    ...data,
                    experiencia_minima: data.experiencia_minima || null,
                    edad_minima:        data.edad_minima        || null,
                    edad_maxima:        data.edad_maxima        || null,
                    salario_min:        data.salario_min        || null,
                    salario_max:        data.salario_max        || null
                });
                await crearPlaza(limpiarDatos(form));
            }
            setShowModal(false);
            cargarPlazas();
        } catch (error) {
            console.error("Error guardando plaza", error);
            if (error.response) console.log(error.response.data);
        }
    };

    const handleCerrar = async (id) => {
        if (!window.confirm("¿Desea cerrar esta plaza?")) return;
        try {
            await cerrarPlaza(id);
            cargarPlazas();
        } catch (error) {
            console.error("Error cerrando plaza", error);
        }
    };

    return (

        <AdminLayout>

            <div className="admin-header">
                <h2>Administración de Plazas</h2>
                <button
                    className="btn btn-primary rounded-pill"
                    onClick={handleCrear}
                >
                    <FaPlus className="me-2" />
                    Nueva Plaza
                </button>
            </div>

            <div className="admin-toolbar">

                {/* Buscador */}
                <div className="search-box">
                    <FaSearch />
                    <input
                        placeholder="Buscar plaza..."
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
                    <option value="activa">Activa</option>
                    <option value="cerrada">Cerrada</option>
                </select>

                {/* Filtro Ciudad */}
                <select
                    className="form-select"
                    value={filtroCiudad}
                    onChange={(e) => setFiltroCiudad(e.target.value)}
                >
                    <option value="">Todas las ciudades</option>
                    {ciudades.map(c => (
                        <option key={c} value={c}>{c}</option>
                    ))}
                </select>

                {/* Filtro Cargo */}
                <select
                    className="form-select"
                    value={filtroCargo}
                    onChange={(e) => setFiltroCargo(e.target.value)}
                >
                    <option value="">Todos los cargos</option>
                    {cargos.map(c => (
                        <option key={c} value={c}>{c}</option>
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
                                    <th>Título</th>
                                    <th>Cargo</th>
                                    <th>Ciudad</th>
                                    <th>Salario</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {plazasPagina.map(p => (
                                    <tr key={p.id}>
                                        <td>{p.id}</td>
                                        <td>{p.titulo}</td>
                                        <td>{p.cargo}</td>
                                        <td>{p.ciudad}</td>
                                        <td>{p.salario_min} - {p.salario_max}</td>
                                        <td>
                                            {p.estado === 1
                                                ? <span className="badge bg-success">Activa</span>
                                                : <span className="badge bg-danger">Cerrada</span>}
                                        </td>
                                        <td className="actions">
                                            <button
                                                className="btn-icon view"
                                                title="Ver plaza"
                                                onClick={() => handleVer(p)}
                                            >
                                                <FaEye />
                                            </button>
                                            <button
                                                className="btn-icon edit"
                                                title="Editar"
                                                onClick={() => handleEditar(p)}
                                            >
                                                <FaEdit />
                                            </button>
                                            <button
                                                className="btn-icon delete"
                                                title="Cerrar plaza"
                                                onClick={() => handleCerrar(p.id)}
                                            >
                                                <FaTimes />
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
                            Mostrando {plazasPagina.length} de {plazasFiltradas.length} plazas
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

            <PlazaModal
                show={showModal}
                onClose={() => setShowModal(false)}
                onSave={handleGuardar}
                plaza={plazaEditar}
            />

            <PlazaVerModal
                show={showModalVer}
                onClose={() => setShowModalVer(false)}
                plaza={plazaVer}
            />

        </AdminLayout>

    );
}