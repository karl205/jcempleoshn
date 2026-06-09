import { useEffect, useState } from "react";

import {
    getCiudades,
    getCargos,
    getCategorias,
    getActividades,
    getNivelesEducativos,
    getSexos,
    getDepartamentos
} from "../../api/catalogosService";

const camposRequeridos = [
    { key: "titulo", label: "Título" },
    { key: "descripcion", label: "Descripción" },
    { key: "requisitos", label: "Requisitos" },
    { key: "beneficios", label: "Beneficios" },
    { key: "departamento_id", label: "Departamento" },
    { key: "ciudad_id", label: "Ciudad" },
    { key: "cargo_id", label: "Cargo" },
    { key: "categoria_id", label: "Categoría laboral" },
    { key: "actividad_id", label: "Actividad laboral" },
    { key: "tipo_contratacion", label: "Tipo de contratación" },
    { key: "nivel_educativo_id", label: "Nivel educativo" },
    { key: "sexo_id", label: "Sexo" },
    { key: "experiencia_minima", label: "Experiencia mínima" },
];

const hoy = new Date().toISOString().split("T")[0];

const toastStyle = {
    position: "fixed",
    bottom: "2rem",
    right: "2rem",
    zIndex: 9999,
    backgroundColor: "#198754",
    color: "#fff",
    padding: "0.85rem 1.5rem",
    borderRadius: "8px",
    fontWeight: "500",
    fontSize: "0.9rem",
    boxShadow: "0 4px 12px rgba(0,0,0,0.2)",
    display: "flex",
    alignItems: "center",
    gap: "0.5rem",
    animation: "fadeInUp 0.3s ease"
};

const toastKeyframes = `
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}`;

export default function PlazaModal({ show, onClose, onSave, plaza = null }) {

    const initialForm = {
        titulo: "",
        descripcion: "",
        requisitos: "",
        beneficios: "",
        departamento_id: "",
        ciudad_id: "",
        cargo_id: "",
        categoria_id: "",
        actividad_id: "",
        tipo_contratacion: "",
        nivel_educativo_id: "",
        sexo_id: "",
        experiencia_minima: "",
        edad_minima: "",
        edad_maxima: "",
        salario_min: "",
        salario_max: "",
        fecha_cierre: hoy
    };

    const [form, setForm] = useState(initialForm);
    const [ciudades, setCiudades] = useState([]);
    const [cargos, setCargos] = useState([]);
    const [categorias, setCategorias] = useState([]);
    const [actividades, setActividades] = useState([]);
    const [niveles, setNiveles] = useState([]);
    const [sexos, setSexos] = useState([]);
    const [departamentos, setDepartamentos] = useState([]);
    const [cargosFiltrados, setCargosFiltrados] = useState([]);
    const [ciudadesFiltradas, setCiudadesFiltradas] = useState([]);
    const [errores, setErrores] = useState([]);
    const [toast, setToast] = useState(null); // { mensaje, tipo }

    const loadingCatalogos = cargos.length === 0 || ciudades.length === 0;

    useEffect(() => {
        cargarCatalogos();
    }, []);

    useEffect(() => {
        const filtrados = cargos.filter(c => {
            const categoriaCargo = c.categoria_laboral_id ?? c.categoria_id;
            return Number(categoriaCargo) === Number(form.categoria_id);
        });
        setCargosFiltrados(filtrados);
    }, [form.categoria_id, cargos]);

    useEffect(() => {
        if (!form.departamento_id || ciudades.length === 0) {
            setCiudadesFiltradas([]);
            return;
        }
        const filtradas = ciudades.filter(c => {
            const depCiudad = c.departamento_id ?? c.departamentoId;
            return Number(depCiudad) === Number(form.departamento_id);
        });
        setCiudadesFiltradas(filtradas);
    }, [form.departamento_id, ciudades]);

    useEffect(() => {
        setErrores([]);

        if (plaza) {
            setForm({
                titulo: plaza.titulo ?? "",
                descripcion: plaza.descripcion ?? "",
                requisitos: plaza.requisitos ?? "",
                beneficios: plaza.beneficios ?? "",
                departamento_id: plaza.departamento_id ?? "",
                ciudad_id: plaza.ciudad_id ?? "",
                cargo_id: plaza.cargo_id ?? "",
                categoria_id: plaza.categoria_id ?? "",
                actividad_id: plaza.actividad_id ?? "",
                tipo_contratacion: plaza.tipo_contratacion ?? "",
                nivel_educativo_id: plaza.nivel_educativo_id ?? "",
                sexo_id: plaza.sexo_id ?? "",
                experiencia_minima: plaza.experiencia_minima ?? "",
                edad_minima: plaza.edad_minima ?? "",
                edad_maxima: plaza.edad_maxima ?? "",
                salario_min: plaza.salario_min ?? "",
                salario_max: plaza.salario_max ?? "",
                fecha_cierre: plaza.fecha_cierre ?? hoy
            });
        } else {
            setForm({ ...initialForm, fecha_cierre: hoy });
        }
    }, [plaza, show]);

    useEffect(() => {
        if (!form.categoria_id) {
            setForm(prev => ({ ...prev, cargo_id: "" }));
        }
    }, [form.categoria_id]);

    useEffect(() => {
        if (!form.departamento_id) {
            setForm(prev => ({ ...prev, ciudad_id: "" }));
        }
    }, [form.departamento_id]);

    const mostrarToast = (mensaje) => {
        setToast(mensaje);
        setTimeout(() => setToast(null), 3000);
    };

    const cargarCatalogos = async () => {
        try {
            const [
                ciudadesRes,
                cargosRes,
                categoriasRes,
                actividadesRes,
                nivelesRes,
                sexosRes,
                departamentosRes
            ] = await Promise.all([
                getCiudades(),
                getCargos(),
                getCategorias(),
                getActividades(),
                getNivelesEducativos(),
                getSexos(),
                getDepartamentos()
            ]);

            setCiudades(ciudadesRes.data.data);
            setCargos(cargosRes.data.data);
            setCategorias(categoriasRes.data.data);
            setActividades(actividadesRes.data.data);
            setNiveles(nivelesRes.data.data);
            setSexos(sexosRes.data.data);
            setDepartamentos(departamentosRes.data.data);
        } catch (error) {
            console.error("Error cargando catálogos", error);
        }
    };

    if (!show && !toast) return null;

    const handleChange = (e) => {
        const { name, value } = e.target;
        setForm({ ...form, [name]: value });
        if (errores.length > 0) setErrores([]);
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        const faltantes = camposRequeridos
            .filter(({ key }) => !form[key])
            .map(({ label }) => label);

        if (faltantes.length > 0) {
            setErrores(faltantes);
            return;
        }

        setErrores([]);
        onSave(form);

        onClose();
        mostrarToast(plaza ? "Plaza actualizada exitosamente" : "Plaza creada exitosamente");
    };

    return (
        <>
            {/* KEYFRAMES */}
            <style>{toastKeyframes}</style>

            {/* MODAL */}
            {show && (
                <div className="modal-overlay">
                    <div className="modal-card modal-xl">

                        <div className="modal-header">
                            <h5>{plaza ? "Editar Plaza" : "Nueva Plaza"}</h5>
                            <button className="modal-close" onClick={onClose}>✕</button>
                        </div>

                        <form className="modal-body" onSubmit={handleSubmit}>

                            {/* INFORMACIÓN GENERAL */}
                            <h6 className="section-title">Información General</h6>

                            <div className="row g-3">

                                <div className="col-md-12">
                                    <label>Título <span className="text-danger">*</span></label>
                                    <input
                                        className="form-control"
                                        name="titulo"
                                        value={form.titulo}
                                        onChange={handleChange}
                                    />
                                </div>

                                <div className="col-md-12">
                                    <label>Descripción <span className="text-danger">*</span></label>
                                    <textarea
                                        className="form-control"
                                        name="descripcion"
                                        value={form.descripcion}
                                        onChange={handleChange}
                                    />
                                </div>

                                <div className="col-md-6">
                                    <label>Requisitos <span className="text-danger">*</span></label>
                                    <textarea
                                        className="form-control"
                                        name="requisitos"
                                        value={form.requisitos}
                                        onChange={handleChange}
                                    />
                                </div>

                                <div className="col-md-6">
                                    <label>Beneficios <span className="text-danger">*</span></label>
                                    <textarea
                                        className="form-control"
                                        name="beneficios"
                                        value={form.beneficios}
                                        onChange={handleChange}
                                    />
                                </div>

                            </div>

                            {/* INFORMACIÓN LABORAL */}
                            <h6 className="section-title mt-4">Información Laboral</h6>

                            <div className="row g-3">

                                <div className="col-md-4">
                                    <label>Categoría laboral <span className="text-danger">*</span></label>
                                    <select
                                        className="form-select"
                                        name="categoria_id"
                                        value={form.categoria_id}
                                        onChange={handleChange}
                                    >
                                        <option value="">Seleccione</option>
                                        {categorias.map(c => (
                                            <option key={c.id} value={c.id}>{c.nombre}</option>
                                        ))}
                                    </select>
                                </div>

                                <div className="col-md-4">
                                    <label>Cargo <span className="text-danger">*</span></label>
                                    <select
                                        className="form-select"
                                        name="cargo_id"
                                        value={form.cargo_id}
                                        onChange={handleChange}
                                        disabled={loadingCatalogos || !form.categoria_id}
                                    >
                                        <option value="">
                                            {form.categoria_id ? "Seleccione" : "Seleccione categoría primero"}
                                        </option>
                                        {cargosFiltrados.map(c => (
                                            <option key={c.id} value={c.id}>{c.nombre}</option>
                                        ))}
                                    </select>
                                </div>

                                <div className="col-md-4">
                                    <label>Actividad laboral <span className="text-danger">*</span></label>
                                    <select
                                        className="form-select"
                                        name="actividad_id"
                                        value={form.actividad_id}
                                        onChange={handleChange}
                                    >
                                        <option value="">Seleccione</option>
                                        {actividades.map(a => (
                                            <option key={a.id} value={a.id}>{a.nombre}</option>
                                        ))}
                                    </select>
                                </div>

                                <div className="col-md-4">
                                    <label>Departamento <span className="text-danger">*</span></label>
                                    <select
                                        className="form-select"
                                        name="departamento_id"
                                        value={form.departamento_id}
                                        onChange={handleChange}
                                    >
                                        <option value="">Seleccione</option>
                                        {departamentos.map(d => (
                                            <option key={d.id} value={d.id}>{d.nombre}</option>
                                        ))}
                                    </select>
                                </div>

                                <div className="col-md-4">
                                    <label>Ciudad <span className="text-danger">*</span></label>
                                    <select
                                        className="form-select"
                                        name="ciudad_id"
                                        value={form.ciudad_id}
                                        onChange={handleChange}
                                        disabled={loadingCatalogos || !form.departamento_id}
                                    >
                                        <option value="">
                                            {form.departamento_id ? "Seleccione" : "Seleccione departamento primero"}
                                        </option>
                                        {ciudadesFiltradas.map(c => (
                                            <option key={c.id} value={c.id}>{c.nombre}</option>
                                        ))}
                                    </select>
                                </div>

                                <div className="col-md-4">
                                    <label>Tipo de contratación <span className="text-danger">*</span></label>
                                    <select
                                        className="form-select"
                                        name="tipo_contratacion"
                                        value={form.tipo_contratacion}
                                        onChange={handleChange}
                                    >
                                        <option value="">Seleccione</option>
                                        <option value="Tiempo completo">Tiempo completo</option>
                                        <option value="Medio tiempo">Medio tiempo</option>
                                        <option value="Por contrato">Por contrato</option>
                                    </select>
                                </div>

                            </div>

                            {/* REQUISITOS DEL CANDIDATO */}
                            <h6 className="section-title mt-4">Requisitos del candidato</h6>

                            <div className="row g-3">

                                <div className="col-md-4">
                                    <label>Nivel educativo <span className="text-danger">*</span></label>
                                    <select
                                        className="form-select"
                                        name="nivel_educativo_id"
                                        value={form.nivel_educativo_id}
                                        onChange={handleChange}
                                    >
                                        <option value="">Seleccione</option>
                                        {niveles.map(n => (
                                            <option key={n.id} value={n.id}>{n.nombre}</option>
                                        ))}
                                    </select>
                                </div>

                                <div className="col-md-4">
                                    <label>Sexo <span className="text-danger">*</span></label>
                                    <select
                                        className="form-select"
                                        name="sexo_id"
                                        value={form.sexo_id}
                                        onChange={handleChange}
                                    >
                                        <option value="">Seleccione</option>
                                        {sexos.map(s => (
                                            <option key={s.id} value={s.id}>{s.nombre}</option>
                                        ))}
                                    </select>
                                </div>

                                <div className="col-md-4">
                                    <label>Experiencia mínima (años) <span className="text-danger">*</span></label>
                                    <input
                                        type="number"
                                        className="form-control"
                                        name="experiencia_minima"
                                        value={form.experiencia_minima}
                                        onChange={handleChange}
                                    />
                                </div>

                                <div className="col-md-6">
                                    <label>Edad mínima <span className="text-secondary fw-normal">(opcional)</span></label>
                                    <input
                                        type="number"
                                        className="form-control"
                                        name="edad_minima"
                                        value={form.edad_minima}
                                        onChange={handleChange}
                                    />
                                </div>

                                <div className="col-md-6">
                                    <label>Edad máxima <span className="text-secondary fw-normal">(opcional)</span></label>
                                    <input
                                        type="number"
                                        className="form-control"
                                        name="edad_maxima"
                                        value={form.edad_maxima}
                                        onChange={handleChange}
                                    />
                                </div>

                            </div>

                            {/* INFORMACIÓN SALARIAL */}
                            <h6 className="section-title mt-4">Información salarial</h6>

                            <div className="row g-3">

                                <div className="col-md-6">
                                    <label>Salario mínimo <span className="text-secondary fw-normal">(opcional)</span></label>
                                    <input
                                        type="number"
                                        className="form-control"
                                        name="salario_min"
                                        value={form.salario_min}
                                        onChange={handleChange}
                                    />
                                </div>

                                <div className="col-md-6">
                                    <label>Salario máximo <span className="text-secondary fw-normal">(opcional)</span></label>
                                    <input
                                        type="number"
                                        className="form-control"
                                        name="salario_max"
                                        value={form.salario_max}
                                        onChange={handleChange}
                                    />
                                </div>

                            </div>

                            {/* ERRORES */}
                            {errores.length > 0 && (
                                <div className="alert alert-danger mt-4 mb-0 py-2 small">
                                    <strong>Completa los siguientes campos antes de guardar:</strong>
                                    <ul className="mb-0 mt-1 ps-3">
                                        {errores.map((e, i) => (
                                            <li key={i}>{e}</li>
                                        ))}
                                    </ul>
                                </div>
                            )}

                            <div className="modal-footer mt-4">
                                <button type="button" className="btn btn-light" onClick={onClose}>
                                    Cancelar
                                </button>
                                <button type="submit" className="btn btn-primary">
                                    Guardar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            )}

            {/* TOAST */}
            {toast && (
                <div style={toastStyle}>
                    ✅ {toast}
                </div>
            )}
        </>
    );
}