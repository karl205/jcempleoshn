import Swal from "sweetalert2";
import { deleteAccount } from "../../api/profileService";

export default function DangerZone() {
    const handleDelete = async () => {
        const result = await Swal.fire({
            title: "¿Eliminar cuenta?",
            text: "Esta acción no se puede deshacer",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
        });

        if (result.isConfirmed) {
            await deleteAccount();
            window.location.href = "/";
        }
    };

    return (
        <div className="border rounded-4 p-4 bg-light">
            <h5 className="text-danger fw-bold">Zona peligrosa</h5>
            <p className="text-muted">
                Eliminar tu cuenta eliminará toda tu información.
            </p>

            <button className="btn btn-danger" onClick={handleDelete}>
                Eliminar cuenta
            </button>
        </div>
    );
}