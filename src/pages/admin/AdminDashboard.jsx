import { useEffect, useState } from "react";
import AdminLayout from "../../layouts/AdminLayout";
import { useAuth } from "../../context/AuthContext";
import apiClient from "../../api/apiClient";
import {
    FaUsers, FaBriefcase, FaFileAlt,
    FaStar, FaUserShield, FaCheckCircle
} from "react-icons/fa";
import {
    BarChart, Bar, XAxis, YAxis, Tooltip,
    ResponsiveContainer, PieChart, Pie, Cell, Legend
} from "recharts";

const COLORS = ["#4f46e5", "#10b981", "#f59e0b", "#ef4444", "#6366f1"];

export default function AdminDashboard() {

    const { user, roles } = useAuth();
    const rolPrincipal = roles?.length ? roles[0] : "usuario";

    const [stats, setStats] = useState({
        usuarios: 0,
        roles: 0,
        plazas: 0,
        plazasActivas: 0,
        postulaciones: 0,
        testimonios: 0,
        testimoniosPendientes: 0,
    });

    const [plazasPorEstado, setPlazasPorEstado] = useState([]);
    const [testimoniosPorCalificacion, setTestimoniosPorCalificacion] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        cargarStats();
    }, []);

    const cargarStats = async () => {
        try {
            const res = await apiClient.get("/admin/stats");
            const s   = res.data.data;

            setStats({
                usuarios:              s.usuarios,
                roles:                 s.roles,
                plazas:                s.plazas,
                plazasActivas:         s.plazas_activas,
                postulaciones:         s.postulaciones,
                testimonios:           s.testimonios,
                testimoniosPendientes: s.testimonios_pendientes,
            });

            setPlazasPorEstado([
                { name: "Activas",  value: s.plazas_activas },
                { name: "Cerradas", value: s.plazas_cerradas },
            ]);

            // Gráfica calificaciones desde el backend
            const porCalif = [1, 2, 3, 4, 5].map(n => ({
                name: `${n} ★`,
                cantidad: s.testimonios_por_calificacion?.[n] || 0
            }));
            setTestimoniosPorCalificacion(porCalif);

        } catch (err) {
            console.error("Error cargando stats", err);
        } finally {
            setLoading(false);
        }
    };

    const cards = [
        {
            label: "Usuarios",
            value: stats.usuarios,
            icon: <FaUsers />,
            color: "#4f46e5",
            bg: "#eef2ff"
        },
        {
            label: "Roles",
            value: stats.roles,
            icon: <FaUserShield />,
            color: "#6366f1",
            bg: "#f5f3ff"
        },
        {
            label: "Plazas activas",
            value: `${stats.plazasActivas} / ${stats.plazas}`,
            icon: <FaBriefcase />,
            color: "#10b981",
            bg: "#ecfdf5"
        },
        {
            label: "Postulaciones",
            value: stats.postulaciones,
            icon: <FaFileAlt />,
            color: "#f59e0b",
            bg: "#fffbeb"
        },
        {
            label: "Testimonios",
            value: stats.testimonios,
            icon: <FaStar />,
            color: "#f97316",
            bg: "#fff7ed"
        },
        {
            label: "Pendientes aprobación",
            value: stats.testimoniosPendientes,
            icon: <FaCheckCircle />,
            color: "#ef4444",
            bg: "#fef2f2"
        },
    ];

    return (
        <AdminLayout>

            {/* BIENVENIDA */}
            <div className="mb-4">
                <h2 className="fw-bold mb-1">
                    Bienvenido, {user?.nombre} 👋
                </h2>
                <span className="badge bg-primary px-3 py-2 rounded-pill">
                    {rolPrincipal}
                </span>
            </div>

            {loading ? (
                <div className="text-center py-5">
                    <div className="spinner-border text-primary"></div>
                    <p className="mt-2 text-muted">Cargando estadísticas...</p>
                </div>
            ) : (
                <>
                    {/* TARJETAS */}
                    <div className="row g-3 mb-4">
                        {cards.map((card, i) => (
                            <div key={i} className="col-6 col-md-4 col-lg-2">
                                <div
                                    className="card border-0 shadow-sm rounded-4 p-3 h-100"
                                    style={{ background: card.bg }}
                                >
                                    <div className="mb-2 fs-4" style={{ color: card.color }}>
                                        {card.icon}
                                    </div>
                                    <div className="fw-bold fs-4" style={{ color: card.color }}>
                                        {card.value}
                                    </div>
                                    <div className="text-muted small">
                                        {card.label}
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>

                    {/* GRÁFICAS */}
                    <div className="row g-4">

                        {/* Plazas por estado */}
                        <div className="col-md-5">
                            <div className="card border-0 shadow-sm rounded-4 p-4 h-100">
                                <h6 className="fw-bold mb-3">Plazas por estado</h6>
                                <ResponsiveContainer width="100%" height={220}>
                                    <PieChart>
                                        <Pie
                                            data={plazasPorEstado}
                                            cx="50%"
                                            cy="50%"
                                            outerRadius={80}
                                            dataKey="value"
                                            label={({ name, value }) => `${name}: ${value}`}
                                        >
                                            {plazasPorEstado.map((_, i) => (
                                                <Cell key={i} fill={COLORS[i]} />
                                            ))}
                                        </Pie>
                                        <Legend />
                                        <Tooltip />
                                    </PieChart>
                                </ResponsiveContainer>
                            </div>
                        </div>

                        {/* Testimonios por calificación */}
                        <div className="col-md-7">
                            <div className="card border-0 shadow-sm rounded-4 p-4 h-100">
                                <h6 className="fw-bold mb-3">Testimonios por calificación</h6>
                                <ResponsiveContainer width="100%" height={220}>
                                    <BarChart data={testimoniosPorCalificacion}>
                                        <XAxis dataKey="name" />
                                        <YAxis allowDecimals={false} />
                                        <Tooltip />
                                        <Bar
                                            dataKey="cantidad"
                                            fill="#4f46e5"
                                            radius={[6, 6, 0, 0]}
                                        />
                                    </BarChart>
                                </ResponsiveContainer>
                            </div>
                        </div>

                    </div>
                </>
            )}

        </AdminLayout>
    );
}