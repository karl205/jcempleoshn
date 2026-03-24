import apiClient from "./apiClient";
import api from "./apiClient";

/* CRUD PERMISOS */

export const getPermisos = () =>
    apiClient.get("/admin/permisos");

export const crearPermiso = (data) =>
    apiClient.post("/admin/permisos", data);

export const actualizarPermiso = (id, data) =>
    apiClient.put(`/admin/permisos/${id}`, data);

export const desactivarPermiso = (id) =>
    apiClient.patch(`/admin/permisos/${id}/desactivar`);


/* PERMISOS POR ROL */

export const getPermisosRoles = () =>
    api.get("/admin/permisos-roles");

export const actualizarPermisoRol = (data) =>
    api.post("/admin/permisos-roles", data);