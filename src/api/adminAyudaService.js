import apiClient from "./apiClient";

/* ── Consumo (botón flotante dentro del admin) ── */

export const getAyudaAdminConsulta = () => apiClient.get("/admin/ayuda-items/consulta");

export const verAyudaAdmin = (id) =>
  apiClient.get(`/admin/ayuda-items/${id}/consulta/ver`, { responseType: "blob" });

export const descargarAyudaAdmin = (id) =>
  apiClient.get(`/admin/ayuda-items/${id}/consulta/descargar`, { responseType: "blob" });

/* ── Gestión (CRUD, requiere permiso ayuda.gestionar) ── */

export const getAyudaGestion = () => apiClient.get("/admin/ayuda-items");

export const crearAyuda = (formData) =>
  apiClient.post("/admin/ayuda-items", formData);

// PUT con archivo no funciona bien en Laravel, se manda como POST + _method=PUT
export const actualizarAyuda = (id, formData) => {
  formData.append("_method", "PUT");
  return apiClient.post(`/admin/ayuda-items/${id}`, formData);
};

export const desactivarAyuda = (id) =>
  apiClient.patch(`/admin/ayuda-items/${id}/desactivar`);

export const activarAyuda = (id) =>
  apiClient.patch(`/admin/ayuda-items/${id}/activar`);

export const eliminarAyuda = (id) =>
  apiClient.delete(`/admin/ayuda-items/${id}`);

export const verAyudaGestion = (id) =>
  apiClient.get(`/admin/ayuda-items/${id}/ver`, { responseType: "blob" });

export const descargarAyudaGestion = (id) =>
  apiClient.get(`/admin/ayuda-items/${id}/descargar`, { responseType: "blob" });