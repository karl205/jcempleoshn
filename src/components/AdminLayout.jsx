import AdminNavbar from "../components/AdminNavbar";
import AdminSidebar from "../components/AdminSidebar";

export default function AdminLayout({ children }) {
    return (
        <div className="admin-layout">
            <AdminNavbar />
            <div className="admin-body">
                <AdminSidebar />
                <main className="admin-content">
                    {children}
                </main>
            </div>
        </div>
    );
}