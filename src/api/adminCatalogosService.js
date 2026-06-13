import apiClient from "./apiClient";

export const getCatalogo = (name) => apiClient.get(`/admin/catalogos/${name}`);

export const createCatalogo = (name, data) =>
  apiClient.post(`/admin/catalogos/${name}`, data);

export const updateCatalogo = (name, id, data) =>
  apiClient.put(`/admin/catalogos/${name}/${id}`, data);

export const toggleCatalogo = (name, id, data) =>
  apiClient.put(`/admin/catalogos/${name}/${id}/toggle`, data, {
    headers: { 'Content-Type': 'application/json' }
  });

export const deleteCatalogo = (name, id, data) =>
  apiClient.delete(`/admin/catalogos/${name}/${id}`, { data });