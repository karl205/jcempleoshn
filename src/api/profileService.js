// import apiClient from "../api/apiClient";

// export const getProfile = () => apiClient.get("/profile");

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
