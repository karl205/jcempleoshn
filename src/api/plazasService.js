import apiClient from "./apiClient";

export const getUltimasPlazas = () => {
  return apiClient.get("/public/plazas/ultimas");
};

export const getPlazas = () => {
  return apiClient.get("/public/plazas"); // ✅ AQUÍ
};

export const getPlaza = (id) => {
  return apiClient.get(`/public/plazas/${id}`); // ✅ AQUÍ
};
