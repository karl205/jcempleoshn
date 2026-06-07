import { useEffect, useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import apiClient from "../../api/apiClient";
import AdminLayout from "../../layouts/AdminLayout";

export default function PerfilPostulante() {

    const baseURL = import.meta.env.VITE_API_URL.replace("/api", "");
    const navigate = useNavigate();
    const { id } = useParams();
    const [data, setData] = useState(null);

    useEffect(() => {
        cargar();
    }, []);

    const cargar = async () => {
        const res = await apiClient.get(`/admin/postulantes/${id}`);
        setData(res.data.data);
    };

    if (!data) {
        return (
            <AdminLayout>
                <div className="container py-4">
                    <div className="card p-4 text-center">
                        <span className="text-muted">Cargando perfil...</span>
                    </div>
                </div>
            </AdminLayout>
        );
    }

    const usuario = data;
    const perfil  = usuario.perfil || {};

    return (
        <AdminLayout>
            <div className="container py-4">

                {/* BOTÓN VOLVER */}
                <div className="mb-3">
                    <button
                        className="btn btn-outline-secondary rounded-pill"
                        onClick={() => navigate(-1)}
                    >
                        ← Volver a postulaciones
                    </button>
                </div>

                {/* HEADER */}
                <div className="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div className="d-flex align-items-center gap-4">

                        <img
                            src={
                                perfil?.foto
                                    ? `${baseURL}/storage/fotos_perfil/${perfil.foto}`
                                    : `${baseURL}/storage/fotos_perfil/avatar.jpg`
                            }
                            width="100"
                            height="100"
                            className="rounded-circle border"
                            style={{ objectFit: "cover" }}
                        />

                        <div className="flex-grow-1">
                            <h3 className="mb-1 fw-bold">
                                {usuario.nombre} {usuario.apellido}
                            </h3>
                            <p className="text-muted small mb-0">
                                📅 Miembro desde {new Date(usuario.created_at).toLocaleDateString()}
                            </p>
                            <p className="text-muted mb-1">{usuario.email}</p>
                            <div className="d-flex gap-2 flex-wrap mt-2">
                                <span className="badge bg-light text-dark border">
                                    📞 {perfil.telefono || "No especificado"}
                                </span>
                                <span className="badge bg-light text-dark border">
                                    💰 L {perfil.aspiracion_salarial || "0"}
                                </span>
                                <span className="badge bg-success-subtle text-success">
                                    Activo
                                </span>
                            </div>
                        </div>

                    </div>
                </div>

                {/* GRID */}
                <div className="row g-4">

                    {/* COLUMNA IZQUIERDA */}
                    <div className="col-md-4">

                        {/* ACERCA DE */}
                        <div className="card border-0 shadow-sm rounded-4 p-4 mb-4">
                            <h6 className="fw-bold mb-3">Acerca de</h6>
                            <p className="text-muted mb-0">
                                {perfil.acerca_de_mi || "Sin información"}
                            </p>
                        </div>

                        {/* INFORMACIÓN */}
                        <div className="card border-0 shadow-sm rounded-4 p-4 mb-4">
                            <h6 className="fw-bold mb-3">Información</h6>
                            <div className="small text-muted d-flex flex-column gap-2">
                                <p className="mb-0">👤 Sexo: {perfil.sexo?.nombre || "-"}</p>
                                <p className="mb-0">🎂 Nacimiento: {perfil.fecha_nacimiento || "-"}</p>
                                <p className="mb-0">💰 Aspiración: L {perfil.aspiracion_salarial || "0"}</p>
                                <p className="mb-0">🚗 Vehículo: {perfil.disponibilidad_vehicular?.nombre || "-"}</p>
                                <p className="mb-0">📍 Ciudad: {perfil.ciudad?.nombre || "-"}</p>
                                <p className="mb-0">🗺️ Departamento: {perfil.departamento?.nombre || "-"}</p>
                                
                                
                            </div>
                        </div>

                        {/* IDIOMAS */}
                        <div className="card border-0 shadow-sm rounded-4 p-4">
                            <h6 className="fw-bold mb-3">Idiomas</h6>
                            <div className="d-flex flex-wrap gap-2">
                                {perfil.idiomas?.length > 0 ? perfil.idiomas.map(i => (
                                    <span
                                        key={i.id}
                                        className="badge bg-primary-subtle text-primary px-3 py-2"
                                    >
                                        {i.idioma?.nombre || "Idioma"}
                                        {i.nivel?.nombre && ` - ${i.nivel.nombre}`}
                                    </span>
                                )) : (
                                    <span className="text-muted">Sin idiomas registrados</span>
                                )}
                            </div>
                        </div>

                    </div>

                    {/* COLUMNA DERECHA */}
                    <div className="col-md-8">

                        {/* EXPERIENCIA */}
<div className="card border-0 shadow-sm rounded-4 p-4 mb-4">
    <h6 className="fw-bold mb-3">Experiencia</h6>
    {perfil.experiencias?.length > 0 ? perfil.experiencias.map(e => (
        <div key={e.id} className="mb-4">
            <div className="fw-semibold fs-6">{e.cargo}</div>
            <div className="text-muted small mb-2">{e.empresa}</div>

            <div className="d-flex flex-column gap-1 small">
                <span>
                    <span className="text-muted">📅 Período:</span>{" "}
                    {e.fecha_desde || "-"} — {e.fecha_hasta || "Actual"}
                </span>
                {e.categoria && (
                    <span>
                        <span className="text-muted">🏷️ Categoría:</span>{" "}
                        <span className="badge bg-light border text-dark">
                            {e.categoria.nombre}
                        </span>
                    </span>
                )}
                {e.actividad && (
                    <span>
                        <span className="text-muted">💼 Actividad:</span>{" "}
                        <span className="badge bg-light border text-dark">
                            {e.actividad.nombre}
                        </span>
                    </span>
                )}
            </div>
            <hr />
        </div>
    )) : (
        <span className="text-muted">Sin experiencia registrada</span>
    )}
</div>

                        {/* EDUCACIÓN */}
<div className="card border-0 shadow-sm rounded-4 p-4 mb-4">
    <h6 className="fw-bold mb-3">Educación</h6>
    {perfil.educaciones?.length > 0 ? perfil.educaciones.map(e => (
        <div key={e.id} className="mb-4">
            <div className="fw-semibold fs-6">{e.institucion}</div>

            <div className="d-flex flex-column gap-1 small mt-1">
                <span>
                    <span className="text-muted">🎓 Nivel:</span>{" "}
                    {e.nivel_educativo?.nombre || "-"}
                </span>
                <span>
                    <span className="text-muted">📚 Área:</span>{" "}
                    {e.area_estudio?.nombre || "-"}
                </span>
                <span>
                    <span className="text-muted">📅 Período:</span>{" "}
                    {e.fecha_desde || "-"} — {e.fecha_hasta || "Actual"}
                </span>
            </div>
            <hr />
        </div>
    )) : (
        <span className="text-muted">Sin educación registrada</span>
    )}
</div>

                    </div>

                </div>

            </div>
        </AdminLayout>
    );
}