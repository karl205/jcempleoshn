import apiClient from "./apiClient";

export const getTestimoniosAdmin = () => apiClient.get("/admin/testimonios");

export const aprobarTestimonio = (id) =>
  apiClient.put(`/admin/testimonios/${id}/aprobar`);

export const destacarTestimonio = (id) =>
  apiClient.put(`/admin/testimonios/${id}/destacar`);

export const deleteTestimonio = (id) =>
  apiClient.delete(`/admin/testimonios/${id}`);