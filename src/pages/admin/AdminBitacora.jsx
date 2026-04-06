import { useEffect, useState } from "react";
import AdminLayout from "../../layouts/AdminLayout";
import { getBitacora } from "../../api/adminBitacoraService";
import { FaSearch } from "react-icons/fa";

export default function AdminBitacora() {

    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);
    const [busqueda, setBusqueda] = useState("");

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

    const filtrados = data.filter(b =>
        `${b.usuario} ${b.modulo} ${b.accion} ${b.descripcion}`
            .toLowerCase()
            .includes(busqueda.toLowerCase())
    );

    return (
        <AdminLayout>

            <div className="admin-header">
                <h2>Bitácora del sistema</h2>
            </div>

            <div className="admin-toolbar">
                <div className="search-box">
                    <FaSearch />
                    <input
                        placeholder="Buscar..."
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
                                <th>Módulo</th>
                                <th>Acción</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>

                        <tbody>

                            {filtrados.map(b => (

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
                                        {new Date(b.created_at)
                                            .toLocaleString()}
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