import apiClient from "./apiClient";

export const getCiudades = () =>
    apiClient.get("/catalogos/ciudades");

export const getDepartamentos = () =>
    apiClient.get("/catalogos/departamentos");

export const getCargos = () =>
    apiClient.get("/catalogos/cargos");

export const getCategorias = () =>
    apiClient.get("/catalogos/categorias");

export const getActividades = () =>
    apiClient.get("/catalogos/actividades");

export const getNivelesEducativos = () =>
    apiClient.get("/catalogos/niveles-educativos");

export const getSexos = () =>
    apiClient.get("/catalogos/sexos");