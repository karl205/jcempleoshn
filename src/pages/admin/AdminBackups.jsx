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

            {/* CONTENIDO */}
            <div className="admin-card">

                {loading ? (
                    <div className="text-center py-5">
                        <div className="spinner-border"></div>
                        <p className="mt-2">Cargando backups...</p>
                    </div>
                ) : (

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

                            {data.length === 0 && (
                                <tr>
                                    <td colSpan="4" className="text-center py-4">
                                        No hay backups disponibles
                                    </td>
                                </tr>
                            )}

                            {data.map((b) => {

                                const sizeKB = b.size
                                    ? (b.size / 1024).toFixed(2)
                                    : "0.00";

                                const fecha = b.fecha
                                    ? new Date(b.fecha).toLocaleString()
                                    : "-";

                                return (
                                    <tr key={b.nombre}>

                                        <td className="fw-semibold">
                                            {b.nombre}
                                        </td>

                                        <td>
                                            {sizeKB} KB
                                        </td>

                                        <td>
                                            {fecha}
                                        </td>

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
                                            >
                                                <FaTimes />
                                            </button>

                                        </td>

                                    </tr>
                                );
                            })}

                        </tbody>

                    </table>

                )}

            </div>

        </AdminLayout>
    );
}