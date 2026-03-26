import apiClient from "../api/apiClient";

export const getProfile = () => {
  return apiClient.get("/profile");
};

export const updateProfile = (data) => {
  return apiClient.post("/profile", data, {
    headers: {
      "Content-Type": "multipart/form-data",
    },
  });
};

export const createEducacion = (data) =>
  apiClient.post("/perfil/educacion", data);

export const updateEducacion = (id, data) =>
  apiClient.put(`/perfil/educacion/${id}`, data);

export const createIdioma = (data) => apiClient.post("/perfil/idioma", data);

export const updateIdioma = (id, data) =>
  apiClient.put(`/perfil/idioma/${id}`, data);

export const createExperiencia = (data) =>
  apiClient.post("/perfil/experiencia", data);

export const updateExperiencia = (id, data) =>
  apiClient.put(`/perfil/experiencia/${id}`, data);