import { useEffect, useState } from "react";
import AdminLayout from "../../layouts/AdminLayout";
import PlazaModal from "../../components/admin/PlazaModal";

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
    FaSearch
} from "react-icons/fa";

export default function AdminPlazas() {

    const [plazas, setPlazas] = useState([]);
    const [loading, setLoading] = useState(true);
    const [busqueda, setBusqueda] = useState("");

    const [showModal, setShowModal] = useState(false);
    const [plazaEditar, setPlazaEditar] = useState(null);

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

    const plazasFiltradas = plazas.filter(p =>
        `${p.titulo} ${p.cargo} ${p.ciudad}`
            .toLowerCase()
            .includes(busqueda.toLowerCase())
    );

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

    const handleGuardar = async (form) => {

        try {

            if (plazaEditar) {

                await actualizarPlaza(plazaEditar.id, form);

            } else {

                const limpiarDatos = (data) => ({
                    ...data,
                    experiencia_minima: data.experiencia_minima || null,
                    edad_minima: data.edad_minima || null,
                    edad_maxima: data.edad_maxima || null,
                    salario_min: data.salario_min || null,
                    salario_max: data.salario_max || null
                });

                await crearPlaza(limpiarDatos(form));

                // await crearPlaza(form);

            }

            setShowModal(false);

            cargarPlazas();

        } catch (error) {

            console.error("Error guardando plaza", error);

            if (error.response) {
                console.log(error.response.data);
            }

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

                <p>Cargando...</p>

            ) : (

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

                            {plazasFiltradas.map(p => (

                                <tr key={p.id}>

                                    <td>{p.id}</td>

                                    <td>{p.titulo}</td>

                                    <td>{p.cargo}</td>

                                    <td>{p.ciudad}</td>

                                    <td>
                                        {p.salario_min} - {p.salario_max}
                                    </td>

                                    <td>

                                        {p.estado === 1
                                            ? <span className="badge bg-success">Activa</span>
                                            : <span className="badge bg-danger">Cerrada</span>}

                                    </td>

                                    <td className="actions">

                                        <button
                                            className="btn-icon edit"
                                            onClick={() => handleEditar(p)}
                                        >
                                            <FaEdit />
                                        </button>

                                        <button
                                            className="btn-icon delete"
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

            )}

            <PlazaModal
                show={showModal}
                onClose={() => setShowModal(false)}
                onSave={handleGuardar}
                plaza={plazaEditar}
            />

        </AdminLayout>

    );

}