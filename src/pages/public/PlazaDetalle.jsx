import { useEffect, useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import { getPlaza } from "../../api/plazasService";
import Navbar from "../../components/Navbar";
import Footer from "../../components/Footer";
import {
    FaMapMarkerAlt,
    FaBriefcase,
    FaClock,
    FaMoneyBillWave
} from "react-icons/fa";
import { motion } from "framer-motion";
import Swal from "sweetalert2";
import apiClient from "../../api/apiClient";

export default function PlazaDetalle() {

    const { id } = useParams();
    const navigate = useNavigate();

    const token = localStorage.getItem("token");
    const isAuth = !!token;

    const [plaza, setPlaza] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(false);

    useEffect(() => {
        cargarPlaza();
    }, [id]);

    const cargarPlaza = async () => {
        try {
            const res = await getPlaza(id);
            setPlaza(res.data.data);
        } catch (error) {

            if (error.response?.status === 404) {
                setError(true);
            } else {
                console.error("Error cargando plaza", error);
            }

        } finally {
            setLoading(false);
        }
    };

    const formatearFecha = (fecha) => {
        if (!fecha) return "No definida";
        return new Date(fecha).toLocaleDateString();
    };

    const postular = async () => {

        // NO LOGUEADO
        if (!isAuth) {
            Swal.fire({
                icon: "warning",
                title: "Acceso requerido 🔐",
                text: "Para postularte a esta plaza necesitas iniciar sesión.",
                confirmButtonText: "Iniciar sesión",
                confirmButtonColor: "#0d6efd",
            }).then(() => {
                navigate("/login");
            });
            return;
        }

        try {

            await apiClient.post(`/plazas/${id}/postular`);

            Swal.fire({
                icon: "success",
                title: "¡Postulación enviada!",
                text: "Te has postulado correctamente"
            });

        } catch (error) {

            if (error.response?.status === 401) {
                Swal.fire("Sesión expirada", "Vuelve a iniciar sesión", "warning");
                navigate("/login");
                return;
            }

            Swal.fire({
                icon: "error",
                title: "No se pudo completar la acción",
                text: error.response?.data?.message || "Inténtalo nuevamente en unos momentos.",
                confirmButtonColor: "#dc3545"
            });

        }
    };

    if (loading) {
        return (
            <>
                <Navbar />
                <div className="container py-5 text-center">
                    <p>Cargando plaza...</p>
                </div>
                <Footer />
            </>
        );
    }

    if (error) {
        return (
            <>
                <Navbar />
                <div className="container py-5 text-center">

                    <h4 className="fw-bold text-danger">
                        ⚠️ Esta plaza ya no está disponible
                    </h4>
                    <p className="text-muted">
                        Esta plaza ya no está activa o no existe.
                    </p>

                    <button
                        className="btn btn-primary rounded-pill mt-3"
                        onClick={() => navigate("/plazas")}
                    >
                        Ver otras plazas
                    </button>

                </div>
                <Footer />
            </>
        );
    }

    return (
        <>
            <Navbar />

            <div className="container py-4" style={{ maxWidth: "1100px", minHeight: "80vh" }}>

                {/* HERO */}
                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    className="mb-3 p-3 px-4 rounded-4 shadow-sm bg-white"
                >
                    <span className="badge bg-primary mb-2 small">
                        {plaza.categoria}
                    </span>

                    <h3 className="fw-bold mb-1">{plaza.titulo}</h3>

                    <div className="text-muted small d-flex flex-wrap gap-3">
                        <span><FaMapMarkerAlt /> {plaza.ciudad}, {plaza.departamento}</span>
                        <span><FaBriefcase /> {plaza.cargo}</span>
                        <span><FaClock /> {formatearFecha(plaza.created_at)}</span>
                    </div>
                </motion.div>

                <div className="row g-3">

                    {/* IZQUIERDA */}
                    <div className="col-lg-7">

                        {[
                            { titulo: "Descripción", contenido: plaza.descripcion },
                            { titulo: "Requisitos", contenido: plaza.requisitos },
                            { titulo: "Beneficios", contenido: plaza.beneficios }
                        ].map((bloque, i) => (
                            <motion.div
                                key={i}
                                initial={{ opacity: 0, y: 30 }}
                                animate={{ opacity: 1, y: 0 }}
                                transition={{ delay: i * 0.1 }}
                                className="card border-0 shadow-sm p-3 rounded-4 mb-3"
                            >
                                <h6 className="fw-bold mb-2">{bloque.titulo}</h6>

                                <div
                                    className="text-muted small"
                                    style={{ whiteSpace: "pre-line", lineHeight: "1.6" }}
                                >
                                    {bloque.contenido || "No especificado"}
                                </div>
                            </motion.div>
                        ))}

                    </div>

                    {/* DERECHA */}
                    <div className="col-lg-5">

                        <motion.div
                            initial={{ opacity: 0, x: 40 }}
                            animate={{ opacity: 1, x: 0 }}
                            className="card border-0 shadow-sm p-3 rounded-4 position-sticky"
                            style={{ top: "90px" }}
                        >

                            <h6 className="fw-bold mb-3">Detalles del puesto</h6>

                            <div className="small text-muted">

                                <div className="mb-2"><strong>💼 Tipo:</strong> {plaza.tipo_contratacion}</div>
                                <div className="mb-2"><strong>🏢 Categoría:</strong> {plaza.categoria}</div>
                                <div className="mb-2"><strong>📊 Actividad:</strong> {plaza.actividad}</div>
                                <div className="mb-2"><strong>🎓 Nivel educativo:</strong> {plaza.nivel_educativo || "—"}</div>
                                <div className="mb-2"><strong>🚻 Sexo:</strong> {plaza.sexo || "Indiferente"}</div>

                                <div className="mb-2">
                                    <strong>💰 Salario:</strong>{" "}
                                    <span className="text-success fw-semibold">
                                        L. {plaza.salario_min ?? "—"} - L. {plaza.salario_max ?? "—"}
                                    </span>
                                </div>

                                <div className="mb-2"><strong>📈 Experiencia:</strong> {plaza.experiencia_minima || 0} años</div>
                                <div className="mb-2"><strong>🎂 Edad:</strong> {plaza.edad_minima || "—"} - {plaza.edad_maxima || "—"}</div>
                                <div className="mb-3"><strong>⏳ Fecha límite:</strong> {formatearFecha(plaza.fecha_cierre)}</div>

                            </div>

                            <motion.button
                                onClick={postular}
                                whileHover={{ scale: 1.03 }}
                                whileTap={{ scale: 0.97 }}
                                className="btn btn-primary w-100 rounded-pill mt-2 fw-semibold"
                            >
                                🚀 Postularme ahora
                            </motion.button>

                            <p className="text-center small text-muted mt-2">
                                Proceso rápido • Sin complicaciones
                            </p>

                        </motion.div>

                    </div>

                    {/* VOLVER */}
                    <div className="mt-4 pt-3 border-top d-flex justify-content-start">

                        <button
                            onClick={() => navigate(-1)}
                            className="btn btn-outline-secondary btn-sm px-3 rounded-pill"
                        >
                            ← Volver
                        </button>

                    </div>

                </div>



            </div>

            <Footer />
        </>
    );
}