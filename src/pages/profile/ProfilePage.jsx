import { useEffect, useState } from "react";
import ProfileSidebar from "../../components/profile/ProfileSidebar";
import ProfileContent from "../../components/profile/ProfileContent";
import SecurityTab from "../../components/profile/tabs/SecurityTab";
import AccountTab from "../../components/profile/tabs/AccountTab";
import { getProfile } from "../../api/profileService";

export default function ProfilePage() {

  const [activeSection, setActiveSection] = useState(
    localStorage.getItem("profile_tab") || "perfil"
  );

  const [form, setForm] = useState({});
  const [catalogos, setCatalogos] = useState({});

  useEffect(() => {
    localStorage.setItem("profile_tab", activeSection);
  }, [activeSection]);

  // cargar perfil UNA sola vez
  useEffect(() => {
    const loadProfile = async () => {
      try {
        const res = await getProfile();

        const perfil = res.data.perfil;

        setForm({
          ...perfil,
          nombre: perfil.nombre || "",
          apellido: perfil.apellido || "",
        });

        setCatalogos(res.data.catalogos);

      } catch (error) {
        console.error("Error cargando perfil", error);
      }
    };

    loadProfile();
  }, []);

  return (
    <div className="container py-5" style={{ minHeight: "80vh" }}>

      <h2 className="fw-bold mb-4" style={{ color: "#0a66c2" }}>
        Mi Perfil
      </h2>

      <div className="row g-4">

        {/* SIDEBAR */}
        <div className="col-lg-3">
          <ProfileSidebar
            active={activeSection}
            onChange={setActiveSection}
          />
        </div>

        {/* CONTENIDO */}
        <div className="col-lg-9">

          {activeSection === "perfil" && (
            <ProfileContent
              form={form}
              setForm={setForm}
              catalogos={catalogos}
            />
          )}

          {activeSection === "seguridad" && <SecurityTab />}

          {activeSection === "cuenta" && (
            <AccountTab form={form} setForm={setForm} />
          )}

        </div>

      </div>

    </div>
  );
}
