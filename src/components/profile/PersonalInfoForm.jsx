import { useState } from "react";
import { updateProfile } from "../../api/profileService";
import Swal from "sweetalert2";

export default function PersonalInfoForm() {
  const [form, setForm] = useState({
    nombre: "",
    apellido: "",
  });

  const [loading, setLoading] = useState(false);

  const handleChange = (e) => {
    setForm({
      ...form,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      setLoading(true);
      await updateProfile(form);

      Swal.fire({
        toast: true,
        position: "top-end",
        icon: "success",
        title: "Perfil actualizado",
        showConfirmButton: false,
        timer: 2000,
      });
    } catch (error) {
      console.error(error);
    } finally {
      setLoading(false);
    }
  };

  return (
    <form onSubmit={handleSubmit} className="row g-3">
      <div className="col-md-6">
        <label className="form-label">Nombres</label>
        <input
          type="text"
          name="nombre"
          className="form-control bg-light"
          value={form.nombre || ""}
          readOnly
        />
      </div>

      <div className="col-md-6">
        <label className="form-label">Apellidos</label>
        <input
          type="text"
          name="apellido"
          className="form-control bg-light"
          value={form.apellido || ""}
          readOnly
        />
      </div>

      <div className="col-12 text-end">
        <button
          type="submit"
          className="btn btn-success px-4 rounded-pill"
          disabled={loading}
        >
          {loading ? "Guardando..." : "Guardar cambios"}
        </button>
      </div>
    </form>
  );
}