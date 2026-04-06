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

export const deleteEducacion = (id) =>
  apiClient.delete(`/perfil/educacion/${id}`);

export const deleteIdioma = (id) => apiClient.delete(`/perfil/idioma/${id}`);

export const deleteExperiencia = (id) =>
  apiClient.delete(`/perfil/experiencia/${id}`);

export const updatePassword = (data) =>
  apiClient.put("/profile/password", data);

export const updateBasic = (data) => apiClient.put("/profile/basic", data);

export const getTestimonios = () => apiClient.get("/testimonios");

export const createTestimonio = (data) => apiClient.post("/testimonios", data);
