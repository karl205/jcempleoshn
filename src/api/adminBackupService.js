import apiClient from "./apiClient";

export const getBackups = () => apiClient.get("/admin/backups");

export const createBackup = () => apiClient.post("/admin/backups");

export const deleteBackup = (file) =>
  apiClient.delete(`/admin/backups/${file}`);
