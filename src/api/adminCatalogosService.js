import apiClient from "./apiClient";

export const getCatalogo = (name) => apiClient.get(`/admin/catalogos/${name}`);

export const createCatalogo = (name, data) =>
  apiClient.post(`/admin/catalogos/${name}`, data);

export const updateCatalogo = (name, id, data) =>
  apiClient.put(`/admin/catalogos/${name}/${id}`, data);

export const toggleCatalogo = (name, id) =>
  apiClient.put(`/admin/catalogos/${name}/${id}/toggle`);

export const deleteCatalogo = (name, id) =>
  apiClient.delete(`/admin/catalogos/${name}/${id}`);
