import apiClient from "./apiClient";

// Listado de PDFs activos de la sección pública
export const getAyudaPublica = () => apiClient.get("/ayuda-items");

// URLs directas (no requieren token, se pueden usar en <a href>)
const API_BASE = import.meta.env.VITE_API_URL;

export const getAyudaPublicaVerUrl = (id) => `${API_BASE}/ayuda-items/${id}/ver`;
export const getAyudaPublicaDescargarUrl = (id) => `${API_BASE}/ayuda-items/${id}/descargar`;