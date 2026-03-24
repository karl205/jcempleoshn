import { useEffect, useState } from "react";
import ProfileTabs from "./ProfileTabs";
import { getProfile, updateProfile } from "../../api/profileService";

export default function ProfileContent() {

    const [form, setForm] = useState({});
    const [catalogos, setCatalogos] = useState({});
    const [loading, setLoading] = useState(true);

    const [saving, setSaving] = useState(false);
    const [saved, setSaved] = useState(false);

    // 🔥 LOAD DATA GLOBAL
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
                    foto: perfil.foto || null,
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

    // 🔥 SAVE GLOBAL
    const handleSave = async () => {
        try {
            setSaving(true);
            setSaved(false);

            const formData = new FormData();

            Object.keys(form).forEach(key => {
                if (form[key] !== null && form[key] !== undefined) {
                    formData.append(key, form[key]);
                }
            });

            if (form.foto instanceof File) {
                formData.append("foto", form.foto);
            }

            await updateProfile(formData);

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