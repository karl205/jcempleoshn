import apiClient from "./apiClient";

export const login = async (email, password) => {
  const response = await apiClient.post("/login", {
    email,
    password,
  });

  return response.data;
};

export const logoutRequest = async () => {
  return await apiClient.post("/logout");
};
