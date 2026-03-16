import apiClient from "./apiClient";

export const getUltimasPlazas = () => {
  return apiClient.get("/plazas/ultimas");
};

export const getPlazas = () => {
  return apiClient.get("/plazas");
};