import { useState } from "react";
import { updatePassword } from "../../api/profileService";
import Swal from "sweetalert2";

export default function PasswordForm() {
    const [form, setForm] = useState({
        current_password: "",
        password: "",
        password_confirmation: "",
    });

    const handleChange = (e) => {
        setForm({
            ...form,
            [e.target.name]: e.target.value,
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            await updatePassword(form);

            Swal.fire("Éxito", "Contraseña actualizada", "success");
        } catch (error) {
            console.error(error);
        }
    };

    return (
        <form onSubmit={handleSubmit} className="row g-3">
            <input type="password" name="current_password" placeholder="Actual" className="form-control" onChange={handleChange} />
            <input type="password" name="password" placeholder="Nueva" className="form-control" onChange={handleChange} />
            <input type="password" name="password_confirmation" placeholder="Confirmar" className="form-control" onChange={handleChange} />

            <div className="text-end">
                <button className="btn btn-primary rounded-pill">
                    Cambiar contraseña
                </button>
            </div>
        </form>
    );
}