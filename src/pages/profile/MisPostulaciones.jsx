import { useEffect, useState } from "react";
import apiClient from "../../api/apiClient";
import { Link } from "react-router-dom";

export default function MisPostulaciones() {

    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        cargar();
    }, []);

    const cargar = async () => {
        try {
            const res = await apiClient.get("/mis-postulaciones");
            setData(res.data);
        } catch (error) {
            console.error("Error cargando postulaciones", error);
        } finally {
            setLoading(false);
        }
    };

    return (

        <div className="container py-4">

            <h3 className="mb-4">Mis postulaciones</h3>

            {loading ? (
                <p>Cargando...</p>
            ) : data.length === 0 ? (
                <p className="text-muted">Aún no te has postulado a ninguna plaza</p>
            ) : (

                <div className="admin-table-wrapper">

                    <div className="table-responsive">

                        <table className="admin-table">

                            <thead>
                                <tr>
                                    <th>Plaza</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody>

                                {data.map(p => (

                                    <tr key={p.id}>

                                        <td>{p.plaza?.titulo}</td>

                                        <td>
                                            {new Date(p.created_at).toLocaleDateString()}
                                        </td>

                                        <td>
                                            {p.estado === "apto"
                                                ? <span className="badge bg-success">Apto</span>
                                                : p.estado === "no_apto"
                                                    ? <span className="badge bg-danger">No apto</span>
                                                    : <span className="badge bg-warning text-dark">En revisión</span>
                                            }
                                        </td>

                                        <td>
                                            <Link
                                                to={`/plazas/${p.plaza_id}`}
                                                className="btn btn-sm btn-outline-primary rounded-pill"
                                            >
                                                Ver plaza
                                            </Link>
                                        </td>

                                    </tr>

                                ))}

                            </tbody>

                        </table>

                    </div>

                </div>

            )}

        </div>
    );
}