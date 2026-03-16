import apiClient from "./apiClient";

export const getPlazas = () => {
    return apiClient.get("/admin/plazas");
};

export const getPlaza = (id) => {
    return apiClient.get(`/admin/plazas/${id}`);
};

export const crearPlaza = (data) => {
    return apiClient.post("/admin/plazas", data);
};

export const actualizarPlaza = (id, data) => {
    return apiClient.put(`/admin/plazas/${id}`, data);
};

export const cerrarPlaza = (id) => {
    return apiClient.patch(`/admin/plazas/${id}/cerrar`);
};