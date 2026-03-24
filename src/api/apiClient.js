import axios from "axios";

const apiClient = axios.create({
  baseURL: "http://localhost:8000/api",
  headers: {
    Accept: "application/json",
  },
});

// REQUEST (envía token)
apiClient.interceptors.request.use((config) => {
  const token = localStorage.getItem("token");

  console.log("TOKEN ENVIADO:", token); // debug útil

  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }

  return config;
});

// RESPONSE (manejo global de errores)
apiClient.interceptors.response.use(
  (response) => response,
  (error) => {
    const status = error.response?.status;

    if (status === 401) {
      console.warn("⚠️ Token inválido o expirado");

      // limpiar sesión
      localStorage.removeItem("token");

      // redirigir a login
      navigate("/login");
    }

    return Promise.reject(error);
  },
);

export default apiClient;

// import axios from "axios";

// const apiClient = axios.create({
//   baseURL: "http://localhost:8000/api",
//   headers: {
//     Accept: "application/json",
//   },
// });

// apiClient.interceptors.request.use((config) => {
//   const token = localStorage.getItem("token");

//   if (token) {
//     config.headers.Authorization = `Bearer ${token}`;
//   }

//   return config;
// });

// export default apiClient;

// import axios from "axios";

// const apiClient = axios.create({
//   baseURL: "http://localhost:8000/api",
//   // withCredentials: true
// });

// apiClient.interceptors.request.use((config) => {
//   const token = localStorage.getItem("token");

//   if (token) {
//     config.headers.Authorization = `Bearer ${token}`;
//   }

//   return config;
// });

// export default apiClient;
