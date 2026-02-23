import api from "./axios";

export const login = async (email, password) => {
  const response = await api.post("/login", {
    email,
    password,
  });

  return response.data;
};

export const logoutRequest = async () => {
  return await api.post("/logout");
};