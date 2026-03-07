import { useEffect, useState } from "react";
import AdminLayout from "../../layouts/AdminLayout";

import {
    getPermisosRoles,
    actualizarPermisoRol
} from "../../api/adminPermisosService";

export default function AdminPermisos() {

    const [data, setData] = useState([]);
    const [roles, setRoles] = useState([]);
    const [permisos, setPermisos] = useState([]);
    const [mapPermisos, setMapPermisos] = useState({});

    const cargar = async () => {

        try {

            const res = await getPermisosRoles();

            const registros = res.data.data;

            setData(registros);

            /* ROLES UNICOS */

            const rolesUnicos =
                [...new Map(registros.map(r => [r.rol_id, r])).values()];

            /* PERMISOS UNICOS */

            const permisosUnicos =
                [...new Map(registros.map(p => [p.permiso_id, p])).values()];

            setRoles(rolesUnicos);
            setPermisos(permisosUnicos);

            /* CREAR MAPA ROL-PERMISO */

            const mapa = {};

            registros.forEach(r => {

                mapa[`${r.rol_id}_${r.permiso_id}`] = r.activo === 1;

            });

            setMapPermisos(mapa);

        } catch (error) {

            console.error("Error cargando permisos", error);

        }

    };

    useEffect(() => {

        cargar();

    }, []);

    const tienePermiso = (rol_id, permiso_id) => {

        return mapPermisos[`${rol_id}_${permiso_id}`] || false;

    };

    const togglePermiso = async (rol_id, permiso_id, checked) => {

        try {

            await actualizarPermisoRol({
                rol_id,
                permiso_id,
                activo: checked ? 1 : 0
            });

            /* ACTUALIZAR SOLO EL MAPA LOCAL */

            setMapPermisos(prev => ({
                ...prev,
                [`${rol_id}_${permiso_id}`]: checked
            }));

        } catch (error) {

            console.error("Error actualizando permiso", error);

        }

    };

    return (

        <AdminLayout>

            <div className="admin-header">

                <h2>Administración de Permisos</h2>

            </div>

            <div className="admin-table-wrapper">

                <table className="admin-table">

                    <thead>

                        <tr>

                            <th>Permiso</th>

                            {roles.map(r => (
                                <th key={r.rol_id}>
                                    {r.rol}
                                </th>
                            ))}

                        </tr>

                    </thead>

                    <tbody>

                        {permisos.map(p => (

                            <tr key={p.permiso_id}>

                                <td>
                                    <b>{p.modulo}</b> - {p.permiso}
                                </td>

                                {roles.map(r => (

                                    <td
                                        key={r.rol_id}
                                        style={{ textAlign: "center" }}
                                    >

                                        <input
                                            type="checkbox"
                                            checked={
                                                tienePermiso(
                                                    r.rol_id,
                                                    p.permiso_id
                                                )
                                            }
                                            onChange={(e) =>
                                                togglePermiso(
                                                    r.rol_id,
                                                    p.permiso_id,
                                                    e.target.checked
                                                )
                                            }
                                        />

                                    </td>

                                ))}

                            </tr>

                        ))}

                    </tbody>

                </table>

            </div>

        </AdminLayout>

    );

}