import { useEffect, useState } from "react";
import { Link, useLocation } from "react-router-dom";
import { getAdminMenu } from "../api/adminMenuService";
import { FaChevronDown, FaTimes } from "react-icons/fa";

import {
    FaUsers, FaUserShield, FaKey, FaTachometerAlt,
    FaBriefcase, FaComments, FaClipboardList, FaDatabase,
    FaTools, FaTasks, FaBook, FaUserTie, FaLayerGroup,
    FaCity, FaMap, FaCar, FaLanguage, FaFlag,
    FaGraduationCap, FaGlobe, FaVenusMars, FaUserCheck
} from "react-icons/fa";

const icons = {
    FaUsers, FaUserShield, FaKey, FaTachometerAlt,
    FaBriefcase, FaComments, FaClipboardList, FaDatabase,
    FaTools, FaTasks, FaBook, FaUserTie, FaLayerGroup,
    FaCity, FaMap, FaCar, FaLanguage, FaFlag,
    FaGraduationCap, FaGlobe, FaVenusMars, FaUserCheck
};

export default function AdminSidebar({ open, onClose }) {

    const [menu, setMenu] = useState([]);
    const [openGroups, setOpenGroups] = useState({});
    const location = useLocation();

    useEffect(() => {
        cargarMenu();
    }, []);

    // Cerrar sidebar al navegar en móvil
    useEffect(() => {
        onClose?.();
    }, [location.pathname]);

    const cargarMenu = async () => {
        try {
            const response = await getAdminMenu();
            const data = response.data.data || [];
            setMenu(data);

            const initial = {};
            data.forEach((item, i) => {
                if (item.children?.some(c => location.pathname.startsWith(c.path))) {
                    initial[i] = true;
                }
            });
            setOpenGroups(initial);

        } catch (error) {
            console.error("Error cargando menú", error);
        }
    };

    const toggleGroup = (index) => {
        setOpenGroups(prev => ({ ...prev, [index]: !prev[index] }));
    };

    const isActive = (path) => location.pathname === path;
    const isChildActive = (children) =>
        children?.some(c => location.pathname.startsWith(c.path));

    return (
        <aside className={`admin-sidebar ${open ? "sidebar-open" : ""}`}>

            <div className="admin-sidebar-header">
                <div className="sidebar-logo">
                    <span className="sidebar-logo-icon">⚡</span>
                    Panel
                </div>
                <button className="sidebar-close-btn" onClick={onClose}>
                    <FaTimes />
                </button>
            </div>

            <nav className="admin-menu">
                {menu.map((item, index) => {
                    const Icon = icons[item.icon];

                    if (item.children) {
                        const isOpen = openGroups[index]; // ← corregido
                        const active = isChildActive(item.children);

                        return (
                            <div key={index} className="menu-group">

                                <button
                                    className={`menu-group-title ${active ? "active" : ""}`}
                                    onClick={() => toggleGroup(index)}
                                >
                                    <span className="menu-group-left">
                                        {Icon && <Icon className="menu-icon" />}
                                        {item.label}
                                    </span>
                                    <FaChevronDown
                                        className={`menu-chevron ${isOpen ? "open" : ""}`}
                                    />
                                </button>

                                <div className={`menu-group-items ${isOpen ? "expanded" : ""}`}>
                                    {item.children.map((child, i) => {
                                        const ChildIcon = icons[child.icon];
                                        return (
                                            <Link
                                                key={i}
                                                to={child.path}
                                                className={`menu-item-child ${isActive(child.path) ? "active" : ""}`}
                                            >
                                                {ChildIcon && <ChildIcon className="menu-icon-sm" />}
                                                {child.label}
                                            </Link>
                                        );
                                    })}
                                </div>

                            </div>
                        );
                    }

                    return (
                        <Link
                            key={index}
                            to={item.path}
                            className={`admin-menu-item ${isActive(item.path) ? "active" : ""}`}
                        >
                            {Icon && <Icon className="menu-icon" />}
                            {item.label}
                        </Link>
                    );
                })}
            </nav>

        </aside>
    );
}