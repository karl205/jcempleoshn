import { useState } from "react";

export default function ProfileSidebar() {
    const [active, setActive] = useState("perfil");

    const menu = [
        { key: "perfil", label: "Información personal" },
        { key: "seguridad", label: "Seguridad" },
        { key: "cuenta", label: "Cuenta" },
    ];

    return (
        <div className="card border-0 shadow-sm rounded-4 p-3">

            <h6 className="text-muted fw-bold mb-3">Configuración</h6>

            {menu.map((item) => (
                <div
                    key={item.key}
                    onClick={() => setActive(item.key)}
                    className={`px-3 py-2 rounded-3 mb-2 ${active === item.key
                            ? "bg-primary text-white fw-semibold"
                            : "text-dark"
                        }`}
                    style={{ cursor: "pointer", transition: "0.2s" }}
                >
                    {item.label}
                </div>
            ))}

        </div>
    );
}