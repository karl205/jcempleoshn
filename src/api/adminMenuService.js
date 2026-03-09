import apiClient from "./apiClient";

export const getAdminMenu = () =>
    apiClient.get("/admin/menu");