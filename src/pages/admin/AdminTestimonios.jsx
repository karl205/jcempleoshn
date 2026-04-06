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

    const filtrados = data.filter(t =>
        `${t.nombre} ${t.comentario}`
            .toLowerCase()
            .includes(busqueda.toLowerCase())
    );

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
                <div className="search-box">
                    <FaSearch />
                    <input
                        placeholder="Buscar comentario..."
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
                                <th>Usuario</th>
                                <th>Comentario</th>
                                <th>Calificación</th>
                                <th>Estado</th>
                                <th>Destacado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>

                            {filtrados.map(t => (

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

            )}

        </AdminLayout>

    );
}