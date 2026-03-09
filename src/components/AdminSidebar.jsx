import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { getAdminMenu } from "../api/adminMenuService";

import {
    FaUsers,
    FaUserShield,
    FaKey,
    FaTachometerAlt
} from "react-icons/fa";

const icons = {
    FaUsers,
    FaUserShield,
    FaKey,
    FaTachometerAlt
};

export default function AdminSidebar() {

    const [menu, setMenu] = useState([]);

    useEffect(() => {
        cargarMenu();
    }, []);

    const cargarMenu = async () => {
        try {

            const response = await getAdminMenu();

            setMenu(response.data.data);

        } catch (error) {

            console.error("Error cargando menú", error);

        }
    };

    return (
        <aside className="admin-sidebar">

            <div className="admin-sidebar-header">
                Panel
            </div>

            <nav className="admin-menu">

                {menu.map((item, index) => {

                    const Icon = icons[item.icon];

                    return (
                        <Link
                            key={index}
                            to={item.path}
                            className="admin-menu-item"
                        >
                            <Icon />
                            {item.label}
                        </Link>
                    );

                })}

            </nav>

        </aside>
    );
}