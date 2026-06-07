import { useState } from "react";
import AdminNavbar from "../components/AdminNavbar";
import AdminSidebar from "../components/AdminSidebar";

export default function AdminLayout({ children }) {

    const [sidebarOpen, setSidebarOpen] = useState(false);

    return (
        <div className="admin-layout">

            <AdminNavbar onMenuClick={() => setSidebarOpen(!sidebarOpen)} />

            <div className="admin-body">

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