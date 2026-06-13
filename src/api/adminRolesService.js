import apiClient from "./apiClient";

export const getRoles = () =>
    apiClient.get("/admin/roles");

export const crearRol = (data) =>
    apiClient.post("/admin/roles", data);

export const actualizarRol = (id, data) =>
    apiClient.put(`/admin/roles/${id}`, data);

export const desactivarRol = (id, data) =>
    apiClient.patch(`/admin/roles/${id}/desactivar`, data);