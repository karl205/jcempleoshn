import axios from "axios";

const apiClient = axios.create({
  baseURL: "http://localhost:8000/api",
  headers: {
    Accept: "application/json",
  },
});

// REQUEST → enviar token SOLO si existe
apiClient.interceptors.request.use((config) => {
  const token = localStorage.getItem("token");

  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }

  return config;
});

// RESPONSE - manejo global
apiClient.interceptors.response.use(
  (response) => response,
  (error) => {
    const status = error.response?.status;
    const url = error.config?.url || "";

    // SOLO manejar 401 si NO es login
    if (status === 401 && !url.includes("/login")) {
      console.warn("⚠️ Token inválido o expirado");

      localStorage.removeItem("token");

      // REDIRECCIÓN SEGURA (sin React hook)
      window.location.href = "/login";
    }

    return Promise.reject(error);
  }
);

export default apiClient;