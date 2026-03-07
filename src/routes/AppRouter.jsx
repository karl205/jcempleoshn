import { Routes, Route } from "react-router-dom";

import Home from "../pages/public/Home";

import Login from "../pages/auth/Login";
import Register from "../pages/auth/Register";
import ForgotPassword from "../pages/auth/ForgotPassword";
import VerifyCode from "../pages/auth/VerifyCode";
import VerifyEmail from "../pages/auth/VerifyEmail";
import ResetPassword from "../pages/auth/ResetPassword";

import AdminRoute from "../components/AdminRoute";

import AdminDashboard from "../pages/admin/AdminDashboard";
import AdminUsuarios from "../pages/admin/AdminUsuarios";
import AdminRoles from "../pages/admin/AdminRoles";
import AdminPermisos from "../pages/admin/AdminPermisos";

export default function AppRouter() {
  return (
    <Routes>
      {/* Rutas pùblicas */}
      <Route path="/" element={<Home />} />
      <Route path="/login" element={<Login />} />
      <Route path="/register" element={<Register />} />
      <Route path="/forgot-password" element={<ForgotPassword />} />
      <Route path="/verify-code" element={<VerifyCode />} />
      <Route path="/verify-email" element={<VerifyEmail />} />
      <Route path="/reset-password" element={<ResetPassword />} />

      {/* Rutas de admin */}
      {/* <Route path="/admin" element={<AdminRoute><AdminDashboard /></AdminRoute>} />
      <Route path="/admin/usuarios" element={<AdminRoute><AdminUsuarios /></AdminRoute>} />
      <Route path="/admin/roles" element={<AdminRoute><AdminRoles /></AdminRoute>} />
      <Route path="/admin/permisos" element={<AdminRoute><AdminPermisos /></AdminRoute>} />
     */}
      <Route path="/admin" element={<AdminRoute><AdminDashboard /></AdminRoute>} />
      <Route path="/admin/usuarios" element={<AdminRoute><AdminUsuarios /></AdminRoute>} />
      <Route path="/admin/roles" element={<AdminRoute><AdminRoles /></AdminRoute>} />
      <Route path="/admin/permisos" element={<AdminRoute><AdminPermisos /></AdminRoute>} />
    </Routes>
  );
}