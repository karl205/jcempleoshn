import { useEffect, useState } from "react";
import ProfileTabs from "./ProfileTabs";
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

    const [originalEducations, setOriginalEducations] = useState([]);
    const [originalLanguages, setOriginalLanguages] = useState([]);
    const [originalExperiences, setOriginalExperiences] = useState([]);

    // LOAD DATA
    useEffect(() => {
        const loadData = async () => {
            try {
                const res = await getProfile();

                const perfil = res.data.perfil || {};

                // console.log("PERFIL BACKEND:", perfil);

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

                setOriginalEducations(perfil.educaciones || []);
                setOriginalLanguages(perfil.idiomas || []);
                setOriginalExperiences(perfil.experiencias || []);
                setCatalogos(res.data.catalogos || {});
            } catch (error) {
                console.error(error);
            } finally {
                setLoading(false);
            }
        };

        loadData();
    }, []);

    // SAVE
    const handleSave = async () => {
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

            // 2. EDUCACIONES

            // detectar eliminados
            const currentIds = (form.educations || [])
                .filter(e => e.id)
                .map(e => e.id);

            const deleted = originalEducations.filter(
                e => !currentIds.includes(e.id)
            );

            // eliminar en backend
            for (const edu of deleted) {
                await deleteEducacion(edu.id);
            }

            // crear / actualizar
            for (const edu of form.educations || []) {

                const cleanEdu = {
                    institucion: edu.institucion,
                    nivel_educativo_id: edu.nivel_educativo_id || null,
                    area_estudio_id: edu.area_estudio_id || null,
                    pais_id: edu.pais_id || null,
                    fecha_desde: edu.fecha_desde || null,
                    fecha_hasta: edu.fecha_hasta || null
                };

                // console.log("EDU LIMPIO:", cleanEdu);

                if (edu.id) {
                    await updateEducacion(edu.id, cleanEdu);
                } else {
                    await createEducacion(cleanEdu);
                }
            }

            // actualizar referencia
            setOriginalEducations(form.educations);

            // 3. IDIOMAS

            // detectar eliminados
            const currentLangIds = (form.languages || [])
                .filter(l => l.id)
                .map(l => l.id);

            const deletedLangs = originalLanguages.filter(
                l => !currentLangIds.includes(l.id)
            );

            // eliminar en backend
            for (const lang of deletedLangs) {
                await deleteIdioma(lang.id);
            }

            // crear / actualizar
            for (const lang of form.languages || []) {

                const cleanLang = {
                    idioma_id: lang.idioma_id || null,
                    nivel_id: lang.nivel_id || null
                };

                if (lang.id) {
                    await updateIdioma(lang.id, cleanLang);
                } else {
                    await createIdioma(cleanLang);
                }
            }

            // actualizar referencia
            setOriginalLanguages(form.languages);

            // 4. EXPERIENCIAS

            const currentExpIds = (form.experiences || [])
                .filter(e => e.id)
                .map(e => e.id);

            const deletedExp = originalExperiences.filter(
                e => !currentExpIds.includes(e.id)
            );

            // eliminar
            for (const exp of deletedExp) {
                await deleteExperiencia(exp.id);
            }

            // crear / actualizar
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
                } else {
                    await createExperiencia(cleanExp);
                }
            }

            setOriginalExperiences(form.experiences);

            setSaved(true);
            setTimeout(() => setSaved(false), 2500);

        } catch (error) {
            console.error("Error guardando", error);
        } finally {
            setSaving(false);
        }
    };

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