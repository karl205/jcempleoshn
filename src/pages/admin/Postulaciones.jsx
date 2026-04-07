import { useEffect, useState } from "react";
import AdminLayout from "../../layouts/AdminLayout";
import apiClient from "../../api/apiClient";
import { FaSearch, FaUsers } from "react-icons/fa";
import { useNavigate } from "react-router-dom";

export default function Postulaciones() {

    const navigate = useNavigate();
    const [plazas, setPlazas] = useState([]);
    const [postulantes, setPostulantes] = useState([]);
    const [plazaSeleccionada, setPlazaSeleccionada] = useState(null);
    const [loading, setLoading] = useState(true);
    const [busqueda, setBusqueda] = useState("");

    useEffect(() => {
        cargarPlazas();
    }, []);

    const cargarPlazas = async () => {
        try {
            const res = await apiClient.get("/admin/postulaciones");
            setPlazas(res.data);
        } catch (error) {
            console.error("Error cargando postulaciones", error);
        } finally {
            setLoading(false);
        }
    };

    const verPostulantes = async (plaza) => {
        try {
            const res = await apiClient.get(`/admin/postulaciones/${plaza.id}`);
            setPostulantes(res.data);
            setPlazaSeleccionada(plaza);
        } catch (error) {
            console.error("Error cargando postulantes", error);
        }
    };

    const cambiarEstado = async (id, estado) => {
        try {

            await apiClient.patch(`/admin/postulaciones/${id}/estado`, {
                estado
            });

            // actualizar lista
            verPostulantes(plazaSeleccionada);

        } catch (error) {
            console.error("Error actualizando estado", error);
        }
    };

    const plazasFiltradas = plazas.filter(p =>
        p.titulo.toLowerCase().includes(busqueda.toLowerCase())
    );

    return (

        <AdminLayout>

            {/* HEADER */}
            <div className="admin-header">
                <h2>Gestión de Postulaciones</h2>
            </div>

            {/* BUSCADOR */}
            <div className="admin-toolbar">
                <div className="search-box">
                    <FaSearch />
                    <input
                        placeholder="Buscar plaza..."
                        value={busqueda}
                        onChange={(e) => setBusqueda(e.target.value)}
                    />
                </div>
            </div>

            {loading ? (
                <p>Cargando postulaciones...</p>
            ) : (

                <>
                    {/* GRID PLAZAS */}
                    <div className="row g-3">

                        {plazasFiltradas.map(p => (

                            <div key={p.id} className="col-md-4">

                                <div className="card shadow-sm border-0 p-3 rounded-4 h-100">

                                    <h6 className="fw-bold">{p.titulo}</h6>

                                    <div className="d-flex align-items-center justify-content-between mt-2">

                                        <span className="text-muted small">
                                            <FaUsers /> {p.postulaciones_count} postulantes
                                        </span>

                                        <button
                                            className="btn btn-sm btn-primary rounded-pill"
                                            onClick={() => verPostulantes(p)}
                                        >
                                            Ver
                                        </button>

                                    </div>

                                </div>

                            </div>

                        ))}

                    </div>

                    {/* DETALLE POSTULANTES */}
                    {plazaSeleccionada && (

                        <div className="mt-4">

                            <h5 className="fw-bold">
                                Postulantes - {plazaSeleccionada.titulo}
                            </h5>

                            <div className="admin-table-wrapper mt-3">

                                <div className="table-responsive">

                                    <table className="admin-table">

                                        <thead className="table-light">
                                            <tr>
                                                <th>Usuario</th>
                                                <th>Email</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            {postulantes.length > 0 ? (

                                                postulantes.map(p => (

                                                    <tr key={p.id}>

                                                        <td>
                                                            <div className="d-flex align-items-center gap-2">
                                                                <img
                                                                    src={
                                                                        p.usuario?.perfil?.foto && p.usuario.perfil.foto.trim() !== ""
                                                                            ? `http://localhost:8000/storage/fotos_perfil/${p.usuario.perfil.foto}`
                                                                            : "http://localhost:8000/storage/fotos_perfil/avatar.jpg"
                                                                    }
                                                                    alt=""
                                                                    width="40"
                                                                    height="40"
                                                                    className="rounded-circle"
                                                                />
                                                                {p.usuario?.nombre}
                                                            </div>
                                                        </td>

                                                        <td>{p.usuario?.email}</td>

                                                        <td>
                                                            {p.estado === "apto"
                                                                ? <span className="badge bg-success">Apto</span>
                                                                : p.estado === "no_apto"
                                                                    ? <span className="badge bg-danger">No apto</span>
                                                                    : <span className="badge bg-warning text-dark">En revisión</span>
                                                            }
                                                        </td>

                                                        <td className="actions">

                                                            <button
                                                                className="btn-icon edit"
                                                                title="Marcar como apto"
                                                                onClick={() => cambiarEstado(p.id, "apto")}
                                                            >
                                                                ✔
                                                            </button>

                                                            <button
                                                                className="btn-icon delete"
                                                                title="Marcar como no apto"
                                                                onClick={() => cambiarEstado(p.id, "no_apto")}
                                                            >
                                                                ✖
                                                            </button>

                                                            <button
                                                                className="btn-icon view"
                                                                title="Ver perfil"
                                                                onClick={() => navigate(`/admin/postulantes/${p.usuario.id}`)}
                                                            >
                                                                👁
                                                            </button>

                                                        </td>

                                                    </tr>

                                                ))

                                            ) : (

                                                <tr>
                                                    <td colSpan="3" className="text-center text-muted py-3">
                                                        No hay postulantes aún
                                                    </td>
                                                </tr>

                                            )}

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    )}

                </>

            )}

        </AdminLayout>
    );
}