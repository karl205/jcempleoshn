import apiClient from "./apiClient";

export const getUsuarios = () =>
    apiClient.get("/admin/usuarios");

export const crearUsuario = (data) =>
    apiClient.post("/admin/usuarios", data);

export const actualizarUsuario = (id, data) =>
    apiClient.put(`/usuarios/${id}`, data);

export const desactivarUsuario = (id) =>
    apiClient.patch(`/admin/usuarios/${id}/desactivar`);