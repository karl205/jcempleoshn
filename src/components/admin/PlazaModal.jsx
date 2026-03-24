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

export default function PlazaModal({
    show,
    onClose,
    onSave,
    plaza = null
}) {

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

        fecha_cierre: ""
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
    const loadingCatalogos = cargos.length === 0 || ciudades.length === 0;

    useEffect(() => {

        cargarCatalogos();

    }, []);

    useEffect(() => {

        console.log("FORM categoria_id:", form.categoria_id);
        console.log("CARGOS RAW:", cargos);

        const filtrados = cargos.filter(c => {

            const categoriaCargo =
                c.categoria_laboral_id ?? c.categoria_id;

            console.log("Comparando:", categoriaCargo, "vs", form.categoria_id);

            return Number(categoriaCargo) === Number(form.categoria_id);

        });

        console.log("CARGOS FILTRADOS:", filtrados);

        setCargosFiltrados(filtrados);

    }, [form.categoria_id, cargos]);

    useEffect(() => {

        if (!form.departamento_id || ciudades.length === 0) {
            setCiudadesFiltradas([]);
            return;
        }

        const filtradas = ciudades.filter(c => {

            const depCiudad =
                c.departamento_id ?? c.departamentoId;

            return Number(depCiudad) === Number(form.departamento_id);

        });

        setCiudadesFiltradas(filtradas);

    }, [form.departamento_id, ciudades]);

    useEffect(() => {

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

                fecha_cierre: plaza.fecha_cierre ?? ""
            });

        } else {
            setForm(initialForm);
        }

    }, [plaza]);

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

        } catch (error) {

            console.error("Error cargando catálogos", error);

        }

    };

    if (!show) return null;

    const handleChange = (e) => {

        const { name, value } = e.target;

        setForm({
            ...form,
            [name]: value
        });

    };

    const handleSubmit = (e) => {

        e.preventDefault();

        onSave(form);

    };

    return (

        <div className="modal-overlay">

            <div className="modal-card modal-xl">

                <div className="modal-header">

                    <h5>
                        {plaza ? "Editar Plaza" : "Nueva Plaza"}
                    </h5>

                    <button
                        className="modal-close"
                        onClick={onClose}
                    >
                        ✕
                    </button>

                </div>

                <form
                    className="modal-body"
                    onSubmit={handleSubmit}
                >

                    {/* INFORMACION GENERAL */}

                    <h6 className="section-title">
                        Información General
                    </h6>

                    <div className="row g-3">

                        <div className="col-md-12">

                            <label>Título</label>

                            <input
                                className="form-control"
                                name="titulo"
                                value={form.titulo}
                                onChange={handleChange}
                                required
                            />

                        </div>

                        <div className="col-md-12">

                            <label>Descripción</label>

                            <textarea
                                className="form-control"
                                name="descripcion"
                                value={form.descripcion}
                                onChange={handleChange}
                                required
                            />

                        </div>

                        <div className="col-md-6">

                            <label>Requisitos</label>

                            <textarea
                                className="form-control"
                                name="requisitos"
                                value={form.requisitos}
                                onChange={handleChange}
                            />

                        </div>

                        <div className="col-md-6">

                            <label>Beneficios</label>

                            <textarea
                                className="form-control"
                                name="beneficios"
                                value={form.beneficios}
                                onChange={handleChange}
                            />

                        </div>

                    </div>

                    {/* INFORMACION LABORAL */}

                    <h6 className="section-title mt-4">
                        Información Laboral
                    </h6>

                    <div className="row g-3">

                        <div className="col-md-4">

                            <label>Categoría laboral</label>

                            <select
                                className="form-select"
                                name="categoria_id"
                                value={form.categoria_id}
                                onChange={handleChange}
                            >

                                <option value="">Seleccione</option>

                                {categorias.map(c => (
                                    <option key={c.id} value={c.id}>
                                        {c.nombre}
                                    </option>
                                ))}

                            </select>

                        </div>

                        <div className="col-md-4">

                            <label>Cargo</label>

                            <select
                                className="form-select"
                                name="cargo_id"
                                value={form.cargo_id}
                                onChange={handleChange}
                                disabled={loadingCatalogos || !form.categoria_id}
                                required
                            >

                                <option value="">
                                    {form.categoria_id ? "Seleccione" : "Seleccione categoría primero"}
                                </option>

                                {cargosFiltrados.map(c => (
                                    <option key={c.id} value={c.id}>
                                        {c.nombre}
                                    </option>
                                ))}

                            </select>

                        </div>

                        <div className="col-md-4">

                            <label>Actividad laboral</label>

                            <select
                                className="form-select"
                                name="actividad_id"
                                value={form.actividad_id}
                                onChange={handleChange}
                            >

                                <option value="">Seleccione</option>

                                {actividades.map(a => (
                                    <option key={a.id} value={a.id}>
                                        {a.nombre}
                                    </option>
                                ))}

                            </select>

                        </div>

                        <div className="col-md-4">

                            <label>Departamento</label>

                            <select
                                className="form-select"
                                name="departamento_id"
                                value={form.departamento_id}
                                onChange={handleChange}
                            >

                                <option value="">Seleccione</option>

                                {departamentos.map(d => (
                                    <option key={d.id} value={d.id}>
                                        {d.nombre}
                                    </option>
                                ))}

                            </select>

                        </div>

                        <div className="col-md-4">

                            <label>Ciudad</label>

                            <select
                                className="form-select"
                                name="ciudad_id"
                                value={form.ciudad_id}
                                onChange={handleChange}
                                disabled={loadingCatalogos || !form.departamento_id}
                            >

                                <option value="">
                                    {form.departamento_id
                                        ? "Seleccione"
                                        : "Seleccione departamento primero"}
                                </option>

                                {ciudadesFiltradas.map(c => (
                                    <option key={c.id} value={c.id}>
                                        {c.nombre}
                                    </option>
                                ))}

                            </select>

                        </div>

                        <div className="col-md-4">

                            <label>Tipo de contratación</label>

                            <select
                                className="form-select"
                                name="tipo_contratacion"
                                value={form.tipo_contratacion}
                                onChange={handleChange}
                            >

                                <option value="">Seleccione</option>
                                <option value="Tiempo completo">
                                    Tiempo completo
                                </option>
                                <option value="Medio tiempo">
                                    Medio tiempo
                                </option>
                                <option value="Por contrato">
                                    Por contrato
                                </option>

                            </select>

                        </div>

                    </div>

                    {/* REQUISITOS DEL CANDIDATO */}

                    <h6 className="section-title mt-4">
                        Requisitos del candidato
                    </h6>

                    <div className="row g-3">

                        <div className="col-md-4">

                            <label>Nivel educativo</label>

                            <select
                                className="form-select"
                                name="nivel_educativo_id"
                                value={form.nivel_educativo_id}
                                onChange={handleChange}
                            >

                                <option value="">Seleccione</option>

                                {niveles.map(n => (
                                    <option key={n.id} value={n.id}>
                                        {n.nombre}
                                    </option>
                                ))}

                            </select>

                        </div>

                        <div className="col-md-4">

                            <label>Sexo</label>

                            <select
                                className="form-select"
                                name="sexo_id"
                                value={form.sexo_id}
                                onChange={handleChange}
                            >

                                <option value="">Seleccione</option>

                                {sexos.map(s => (
                                    <option key={s.id} value={s.id}>
                                        {s.nombre}
                                    </option>
                                ))}

                            </select>

                        </div>

                        <div className="col-md-4">

                            <label>Experiencia mínima (años)</label>

                            <input
                                type="number"
                                className="form-control"
                                name="experiencia_minima"
                                value={form.experiencia_minima}
                                onChange={handleChange}
                            />

                        </div>

                        <div className="col-md-6">

                            <label>Edad mínima</label>

                            <input
                                type="number"
                                className="form-control"
                                name="edad_minima"
                                value={form.edad_minima}
                                onChange={handleChange}
                            />

                        </div>

                        <div className="col-md-6">

                            <label>Edad máxima</label>

                            <input
                                type="number"
                                className="form-control"
                                name="edad_maxima"
                                value={form.edad_maxima}
                                onChange={handleChange}
                            />

                        </div>

                    </div>

                    {/* SALARIO */}

                    <h6 className="section-title mt-4">
                        Información salarial
                    </h6>

                    <div className="row g-3">

                        <div className="col-md-6">

                            <label>Salario mínimo</label>

                            <input
                                type="number"
                                className="form-control"
                                name="salario_min"
                                value={form.salario_min}
                                onChange={handleChange}
                            />

                        </div>

                        <div className="col-md-6">

                            <label>Salario máximo</label>

                            <input
                                type="number"
                                className="form-control"
                                name="salario_max"
                                value={form.salario_max}
                                onChange={handleChange}
                            />

                        </div>

                        <div className="col-md-6">

                            <label>Fecha cierre</label>

                            <input
                                type="date"
                                className="form-control"
                                name="fecha_cierre"
                                value={form.fecha_cierre}
                                onChange={handleChange}
                            />

                        </div>

                    </div>

                    <div className="modal-footer mt-4">

                        <button
                            type="button"
                            className="btn btn-light"
                            onClick={onClose}
                        >
                            Cancelar
                        </button>

                        <button
                            type="submit"
                            className="btn btn-primary"
                        >
                            Guardar
                        </button>

                    </div>

                </form>

            </div>

        </div>

    );

}