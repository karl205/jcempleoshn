import { useParams } from "react-router-dom";
import AdminCatalogoPage from "./AdminCatalogoPage";

export default function AdminCatalogoPageWrapper() {

    const { catalogo } = useParams();

    const map = {

        "actividades-laborales": {
            name: "actividades_laborales",
            title: "Actividades laborales",
            fields: ["nombre"]
        },

        "categorias-laborales": {
            name: "categorias_laborales",
            title: "Categorías laborales",
            fields: ["nombre"]
        },

        "cargos-laborales": {
            name: "cargos_laborales",
            title: "Cargos laborales",
            fields: [
                "nombre",
                {
                    name: "categoria_laboral_id",
                    label: "Categoría",
                    type: "select",
                    source: "categorias"
                }
            ]
        },

        "ciudades": {
            name: "ciudades",
            title: "Ciudades",
            fields: [
                "nombre",
                {
                    name: "departamento_id",
                    label: "Departamento",
                    type: "select",
                    source: "departamentos"
                }
            ]
        },

        "departamentos": {
            name: "departamentos",
            title: "Departamentos",
            fields: [
                "nombre",
                {
                    name: "pais_id",
                    label: "País",
                    type: "select",
                    source: "paises"
                }
            ]
        },

        "paises": {
            name: "paises",
            title: "Países",
            fields: ["nombre"]
        },

        "sexos": {
            name: "sexos",
            title: "Sexos",
            fields: ["nombre"]
        },

        "idiomas": {
            name: "idiomas",
            title: "Idiomas",
            fields: ["nombre"]
        },

        "niveles-educativos": {
            name: "niveles_educativos",
            title: "Niveles educativos",
            fields: ["nombre"]
        },

        "niveles-idioma": {
            name: "niveles_idioma",
            title: "Niveles idioma",
            fields: ["nombre"]
        },

        "nacionalidades": {
            name: "nacionalidades",
            title: "Nacionalidades",
            fields: ["nombre"]
        },

        "areas-estudio": {
            name: "areas_estudio",
            title: "Áreas de estudio",
            fields: ["nombre"]
        },

        "disponibilidad-vehicular": {
            name: "disponibilidad_vehicular",
            title: "Disponibilidad vehicular",
            fields: ["nombre"]
        }
    };

    const config = map[catalogo];

    // fallback por si no existe
    if (!config) {
        return <div>Catálogo no encontrado</div>;
    }

    return (
        <AdminCatalogoPage
            key={catalogo}
            name={config.name}
            title={config.title}
            fields={config.fields}
        />
    );
}