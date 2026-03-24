import ProfileSidebar from "../../components/profile/ProfileSidebar";
import ProfileContent from "../../components/profile/ProfileContent";

export default function ProfilePage() {
  return (
    <div className="container py-5" style={{ minHeight: "80vh" }}>
      <h2 className="fw-bold mb-4" style={{ color: "#0a66c2" }}>
        Mi Perfil
      </h2>

      <div className="row g-4">
        <div className="col-lg-3">
          <ProfileSidebar />
        </div>

        <div className="col-lg-9">
          <ProfileContent />
        </div>
      </div>
    </div>
  );
}