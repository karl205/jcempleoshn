import { useState } from "react";
import AdminNavbar from "./AdminNavbar";
import AdminSidebar from "./AdminSidebar";

export default function AdminLayout({ children }) {

    const [sidebarOpen, setSidebarOpen] = useState(false);

    return (
        <div className="admin-layout">

            <AdminNavbar onMenuClick={() => setSidebarOpen(!sidebarOpen)} />

            <div className="admin-body">

                {/* Overlay al abrir sidebar en móvil */}
                {sidebarOpen && (
                    <div
                        className="sidebar-overlay"
                        onClick={() => setSidebarOpen(false)}
                    />
                )}

                <AdminSidebar
                    open={sidebarOpen}
                    onClose={() => setSidebarOpen(false)}
                />

                <main className="admin-content">
                    {children}
                </main>

            </div>

        </div>
    );
}