import apiClient from "./apiClient";

export const getBitacora = () => apiClient.get("/admin/bitacora");
