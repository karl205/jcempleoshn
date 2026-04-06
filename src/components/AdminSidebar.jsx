import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { getAdminMenu } from "../api/adminMenuService";

import {
    FaUsers,
    FaUserShield,
    FaKey,
    FaTachometerAlt,
    FaBriefcase,
    FaComments,
    FaClipboardList,
    FaDatabase,
    FaTools,
    FaTasks,
    FaBook,
    FaUserTie,
    FaLayerGroup,
    FaCity,
    FaMap,
    FaCar,
    FaLanguage,
    FaFlag,
    FaGraduationCap,
    FaGlobe,
    FaVenusMars
} from "react-icons/fa";

const icons = {
    FaUsers,
    FaUserShield,
    FaKey,
    FaTachometerAlt,
    FaBriefcase,
    FaComments,
    FaClipboardList,
    FaDatabase,
    FaTools,
    FaTasks,
    FaBook,
    FaUserTie,
    FaLayerGroup,
    FaCity,
    FaMap,
    FaCar,
    FaLanguage,
    FaFlag,
    FaGraduationCap,
    FaGlobe,
    FaVenusMars
};

export default function AdminSidebar() {

    const [menu, setMenu] = useState([]);

    useEffect(() => {
        cargarMenu();
    }, []);

    const cargarMenu = async () => {
        try {
            const response = await getAdminMenu();
            setMenu(response.data.data || []);
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

                    return item.children ? (

                        <div key={index} className="menu-group">

                            <div className="menu-group-title">
                                {Icon && <Icon />}
                                {item.label}
                            </div>

                            <div className="menu-group-items">

                                {item.children.map((child, i) => {
                                    const ChildIcon = icons[child.icon];

                                    return (
                                        <Link key={i} to={child.path} className="menu-item-child">
                                            {ChildIcon && <ChildIcon />}
                                            {child.label}
                                        </Link>
                                    );
                                })}

                            </div>

                        </div>

                    ) : (

                        <Link key={index} to={item.path} className="admin-menu-item">
                            {Icon && <Icon />}
                            {item.label}
                        </Link>

                    );

                })}

            </nav>

        </aside>
    );
}