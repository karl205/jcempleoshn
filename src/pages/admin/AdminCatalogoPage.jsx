import { useEffect, useState } from "react";
import AdminCatalogo from "../../components/admin/AdminCatalogo";
import apiClient from "../../api/apiClient";

import {
    getCatalogo,
    createCatalogo,
    updateCatalogo,
    deleteCatalogo,
    toggleCatalogo
} from "../../api/adminCatalogosService";

export default function AdminCatalogoPage({ title, name, fields }) {

    const [catalogos, setCatalogos] = useState({});

    // Cargar catálogos relacionados (FK)
    useEffect(() => {

        const cargarCatalogos = async () => {

            try {
                const selects = fields?.filter(f => typeof f !== "string") || [];

                for (let s of selects) {

                    const res = await apiClient.get(`/catalogos/${s.source}`);
                    console.log("API RESPONSE:", res.data);
                    setCatalogos(prev => ({
                        ...prev,
                        [s.source]: res.data.data
                    }));
                }

            } catch (error) {
                console.error("Error cargando catálogos relacionados", error);
            }

        };

        cargarCatalogos();

    }, [fields]);

    return (
        <AdminCatalogo
            title={title}
            fields={fields}
            catalogos={catalogos}
            service={{
                getAll: () => getCatalogo(name),
                create: (data) => createCatalogo(name, data),
                update: (id, data) => updateCatalogo(name, id, data),
                remove: (id, data) => deleteCatalogo(name, id, data),
                toggle: (id, data) => toggleCatalogo(name, id, data)
            }}
        />
    );
}