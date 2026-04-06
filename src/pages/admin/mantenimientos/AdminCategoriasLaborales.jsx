import AdminCatalogo from "../../../components/admin/AdminCatalogo";
import * as service from "../../../api/adminCategoriasLaboralesService";

export default function AdminCategoriasLaborales() {
    return (
        <AdminCatalogo
            title="Categorías Laborales"
            service={{
                getAll: service.getCategorias,
                create: service.createCategoria,
                update: service.updateCategoria,
                remove: service.deleteCategoria,
                toggle: service.toggleCategoria
            }}
        />
    );
}