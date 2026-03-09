export const can = (permiso) => {

    const permisos = JSON.parse(localStorage.getItem("permisos") || "[]");

    return permisos.includes(permiso);

};

// alias para compatibilidad
export const hasPermission = can;