import apiClient from "./apiClient";

export const getCategorias = () => apiClient.get("/admin/categorias-laborales");

export const createCategoria = (data) =>
  apiClient.post("/admin/categorias-laborales", data);

export const updateCategoria = (id, data) =>
  apiClient.put(`/admin/categorias-laborales/${id}`, data);

export const toggleCategoria = (id) =>
  apiClient.put(`/admin/categorias-laborales/${id}/toggle`);

export const deleteCategoria = (id) =>
  apiClient.delete(`/admin/categorias-laborales/${id}`);
