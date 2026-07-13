import { useEffect, useState } from "react";
import ProfileTabs from "./ProfileTabs";
import Swal from "sweetalert2";
import { deleteIdioma } from "../../api/profileService";
import { deleteExperiencia } from "../../api/profileService";
import {
    getProfile,
    updateProfile,
    createEducacion,
    updateEducacion,
    deleteEducacion,
    createIdioma,
    updateIdioma,
    createExperiencia,
    updateExperiencia
} from "../../api/profileService";

export default function ProfileContent() {

    const [form, setForm] = useState({});
    const [catalogos, setCatalogos] = useState({});
    const [loading, setLoading] = useState(true);

    const [saving, setSaving] = useState(false);
    const [saved, setSaved] = useState(false);

    useEffect(() => {
        const loadData = async () => {
            try {
                const res = await getProfile();

                const perfil = res.data.perfil || {};

                setForm({
                    nombre: perfil.nombre || "",
                    apellido: perfil.apellido || "",
                    email: perfil.email || "",
                    telefono: perfil.telefono || "",
                    acerca_de_mi: perfil.acerca_de_mi || "",

                    sexo_id: perfil.sexo?.id || "",
                    pais_id: perfil.pais?.id || "",
                    departamento_id: perfil.departamento?.id || "",
                    ciudad_id: perfil.ciudad?.id || "",
                    disponibilidad_vehicular_id: perfil.disponibilidad_vehicular?.id || "",

                    fecha_nacimiento: perfil.fecha_nacimiento || "",
                    aspiracion_salarial: perfil.aspiracion_salarial || "",

                    foto: perfil.foto || null,

                    educations: perfil.educaciones || [],
                    languages: perfil.idiomas || [],
                    experiences: perfil.experiencias || [],
                });

                setCatalogos(res.data.catalogos || {});
            } catch (error) {
                console.error(error);
            } finally {
                setLoading(false);
            }
        };

        loadData();
    }, []);

    const handleSave = async () => {

        // VALIDACIÓN DATOS PERSONALES
        const errores = [];

        if (!form.telefono) errores.push("El teléfono es obligatorio");
        if (!form.sexo_id) errores.push("Seleccione el sexo");
        if (!form.departamento_id) errores.push("Seleccione el departamento");
        if (!form.ciudad_id) errores.push("Seleccione la ciudad");
        if (!form.fecha_nacimiento) errores.push("La fecha de nacimiento es obligatoria");
        if (!form.aspiracion_salarial) errores.push("La aspiración salarial es obligatoria");
        if (!form.disponibilidad_vehicular_id) errores.push("Seleccione la disponibilidad vehicular");
        if (!form.acerca_de_mi || !form.acerca_de_mi.trim()) errores.push("El campo 'Acerca de mí' es obligatorio");

        if (form.telefono && !/^[0-9]{8,15}$/.test(form.telefono)) {
            errores.push("El teléfono es inválido");
        }

        if (form.fecha_nacimiento) {
            const hoy = new Date().toISOString().split("T")[0];
            if (form.fecha_nacimiento >= hoy) {
                errores.push("La fecha de nacimiento no puede ser futura");
            }
        }

        // VALIDACIÓN EDUCACIONES
        (form.educations || []).forEach((edu, i) => {
            if (!edu.institucion || !edu.institucion.trim()) errores.push(`Estudio #${i + 1}: el nombre de la institución es obligatorio`);
            if (!edu.nivel_educativo_id) errores.push(`Estudio #${i + 1}: seleccione el nivel de estudio`);
            if (!edu.area_estudio_id) errores.push(`Estudio #${i + 1}: seleccione el área de estudio`);
            if (!edu.pais_id) errores.push(`Estudio #${i + 1}: seleccione el país`);
            if (!edu.fecha_desde) errores.push(`Estudio #${i + 1}: la fecha de inicio es obligatoria`);
            if (!edu.fecha_hasta) errores.push(`Estudio #${i + 1}: la fecha de finalización es obligatoria`);
        });

        // VALIDACIÓN IDIOMAS
        (form.languages || []).forEach((lang, i) => {
            if (!lang.idioma_id) errores.push(`Idioma #${i + 1}: seleccione el idioma`);
            if (!lang.nivel_id) errores.push(`Idioma #${i + 1}: seleccione el nivel`);
        });

        // VALIDACIÓN EXPERIENCIAS
        (form.experiences || []).forEach((exp, i) => {
            if (!exp.empresa || !exp.empresa.trim()) errores.push(`Experiencia #${i + 1}: el nombre del patrono es obligatorio`);
            if (!exp.cargo || !exp.cargo.trim()) errores.push(`Experiencia #${i + 1}: el cargo es obligatorio`);
            if (!exp.pais_id) errores.push(`Experiencia #${i + 1}: seleccione el país`);
            if (!exp.actividad_id) errores.push(`Experiencia #${i + 1}: seleccione la actividad laboral`);
            if (!exp.categoria_id) errores.push(`Experiencia #${i + 1}: seleccione la categoría laboral`);
            if (!exp.fecha_desde) errores.push(`Experiencia #${i + 1}: la fecha de inicio es obligatoria`);
            if (!exp.fecha_hasta) errores.push(`Experiencia #${i + 1}: la fecha de finalización es obligatoria`);
        });

        if (errores.length > 0) {
            Swal.fire({
                icon: "warning",
                title: "Datos incompletos",
                html: errores.map(e => `<p class="mb-1 text-start">• ${e}</p>`).join(""),
                confirmButtonText: "Entendido"
            });
            return;
        }

        try {
            setSaving(true);
            setSaved(false);

            // 1. PERFIL
            const formData = new FormData();

            Object.keys(form).forEach(key => {
                if (
                    form[key] !== null &&
                    form[key] !== undefined &&
                    key !== "educations" &&
                    key !== "languages" &&
                    key !== "experiences"
                ) {
                    formData.append(key, form[key]);
                }
            });

            if (form.foto instanceof File) {
                formData.append("foto", form.foto);
            }

            await updateProfile(formData);

            // 2. EDUCACIONES — solo crear o actualizar (eliminar ya se hace al instante en la pestaña)
            const nuevasEducaciones = [];

            for (const edu of form.educations || []) {
                const cleanEdu = {
                    institucion: edu.institucion,
                    nivel_educativo_id: edu.nivel_educativo_id || null,
                    area_estudio_id: edu.area_estudio_id || null,
                    pais_id: edu.pais_id || null,
                    fecha_desde: edu.fecha_desde || null,
                    fecha_hasta: edu.fecha_hasta || null
                };

                if (edu.id) {
                    await updateEducacion(edu.id, cleanEdu);
                    nuevasEducaciones.push(edu);
                } else {
                    const res = await createEducacion(cleanEdu);
nuevasEducaciones.push({ ...edu, id: res.data?.data?.registro_id });
                }
            }

            // 3. IDIOMAS
            const nuevosIdiomas = [];

            for (const lang of form.languages || []) {
                const cleanLang = {
                    idioma_id: lang.idioma_id || null,
                    nivel_id: lang.nivel_id || null
                };

                if (lang.id) {
                    await updateIdioma(lang.id, cleanLang);
                    nuevosIdiomas.push(lang);
                } else {
                    const res = await createIdioma(cleanLang);
nuevosIdiomas.push({ ...lang, id: res.data?.data?.registro_id });
                }
            }

            // 4. EXPERIENCIAS
            const nuevasExperiencias = [];

            for (const exp of form.experiences || []) {
                const cleanExp = {
                    empresa: exp.empresa,
                    cargo: exp.cargo,
                    pais_id: exp.pais_id || null,
                    actividad_id: exp.actividad_id || null,
                    categoria_id: exp.categoria_id || null,
                    fecha_desde: exp.fecha_desde || null,
                    fecha_hasta: exp.fecha_hasta || null
                };

                if (exp.id) {
                    await updateExperiencia(exp.id, cleanExp);
                    nuevasExperiencias.push(exp);
                } else {
                    const res = await createExperiencia(cleanExp);
nuevasExperiencias.push({ ...exp, id: res.data?.data?.registro_id });
                }
            }

            // Actualiza el form con los IDs reales que asignó el backend,
            // así si vuelves a guardar sin refrescar la página, ya no se
            // intenta crear de nuevo lo que ya se creó.
            setForm(prev => ({
                ...prev,
                educations: nuevasEducaciones,
                languages: nuevosIdiomas,
                experiences: nuevasExperiencias,
            }));

            setSaved(true);
            setTimeout(() => setSaved(false), 2500);

        } catch (error) {
            console.error("Error guardando", error);
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Ocurrió un error al guardar. Intenta de nuevo.",
                confirmButtonText: "Cerrar"
            });
        } finally {
            setSaving(false);
        }
    };

    // ── Eliminación inmediata (no espera al botón Guardar) ──
    const handleDeleteEducacion = (id) => deleteEducacion(id);
    const handleDeleteIdioma = (id) => deleteIdioma(id);
    const handleDeleteExperiencia = (id) => deleteExperiencia(id);

    if (loading) {
        return <div className="p-5 text-center">Cargando...</div>;
    }

    return (
        <div className="card border-0 shadow-sm rounded-4 d-flex flex-column">

            <div className="flex-grow-1">
                <ProfileTabs
                    form={form}
                    setForm={setForm}
                    catalogos={catalogos}
                    onDeleteEducacion={handleDeleteEducacion}
                    onDeleteIdioma={handleDeleteIdioma}
                    onDeleteExperiencia={handleDeleteExperiencia}
                />
            </div>

            <div className="border-top p-3 text-end">
                <button
                    onClick={handleSave}
                    disabled={saving}
                    className="btn px-4 py-2"
                    style={{
                        backgroundColor: "#0a66c2",
                        color: "#fff",
                        borderRadius: "999px",
                        fontWeight: "600",
                        minWidth: "160px",
                        transition: "all 0.3s ease",
                        opacity: saving ? 0.8 : 1,
                    }}
                >
                    {saving ? (
                        <>
                            <span className="spinner-border spinner-border-sm me-2"></span>
                            Guardando...
                        </>
                    ) : saved ? (
                        <>✔ Guardado</>
                    ) : (
                        <>💾 Guardar</>
                    )}
                </button>
            </div>

        </div>
    );
}