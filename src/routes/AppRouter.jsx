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
import AdminPlazas from "../pages/admin/AdminPlazas";
import AdminTestimonios from "../pages/admin/AdminTestimonios";
import AdminBitacora from "../pages/admin/AdminBitacora";
import AdminCategoriasLaborales from "../pages/admin/mantenimientos/AdminCategoriasLaborales";
import AdminCatalogoPage from "../pages/admin/AdminCatalogoPage";

import Plazas from "../pages/public/Plazas";
import PlazaDetalle from "../pages/public/PlazaDetalle";

import PublicLayout from "../layouts/PublicLayout";
import ProfilePage from "../pages/profile/ProfilePage";
import AdminBackups from "../pages/admin/AdminBackups";
import Postulaciones from "../pages/admin/Postulaciones";
import MisPostulaciones from "../pages/profile/MisPostulaciones";
import PerfilPostulante from "../pages/admin/PerfilPostulante";

import AdminCatalogoPageWrapper from "../pages/admin/AdminCatalogoPageWrapper";

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

      <Route path="/plazas" element={<Plazas />} />
      <Route path="/plazas/:id" element={<PlazaDetalle />} />

      <Route path="/admin" element={<AdminRoute><AdminDashboard /></AdminRoute>} />
      <Route path="/admin/usuarios" element={<AdminRoute><AdminUsuarios /></AdminRoute>} />
      <Route path="/admin/roles" element={<AdminRoute><AdminRoles /></AdminRoute>} />
      <Route path="/admin/permisos" element={<AdminRoute><AdminPermisos /></AdminRoute>} />
      <Route path="/admin/plazas" element={<AdminRoute><AdminPlazas /></AdminRoute>} />
      <Route path="/admin/testimonios" element={<AdminRoute><AdminTestimonios /></AdminRoute>} />
      <Route path="/admin/bitacora" element={<AdminRoute><AdminBitacora /></AdminRoute>} />
      <Route path="/admin/backups" element={<AdminRoute><AdminBackups /></AdminRoute>} />
      <Route path="/admin/postulaciones" element={<AdminRoute><Postulaciones /></AdminRoute>} />
      <Route path="/mis-postulaciones" element={<PublicLayout><MisPostulaciones /></PublicLayout>} />
      <Route path="/admin/postulantes/:id" element={<PerfilPostulante />} />
      
      {/* <Route path="/admin/mantenimientos/categorias-laborales" element={<AdminRoute><AdminCategoriasLaborales /></AdminRoute>} /> */}

      // MANTENIMIENTOS

      <Route path="/admin/mantenimientos/:catalogo" element={<AdminRoute><AdminCatalogoPageWrapper /></AdminRoute>} />


      {/* <Route path="/admin/mantenimientos/actividades-laborales" element={<AdminRoute><AdminCatalogoPage title="Actividades laborales" name="actividades_laborales" /></AdminRoute>} />
      <Route path="/admin/mantenimientos/paises" element={<AdminCatalogoPage title="Países" name="paises" />} />
      <Route path="/admin/mantenimientos/areas-estudio" element={<AdminRoute><AdminCatalogoPage title="Áreas de estudio" name="areas_estudio" /></AdminRoute>} />
      <Route path="/admin/mantenimientos/cargos-laborales" element={<AdminRoute><AdminCatalogoPage title="Cargos laborales" name="cargos_laborales" /></AdminRoute>} />
      <Route path="/admin/mantenimientos/categorias-laborales" element={<AdminRoute><AdminCatalogoPage title="Categorías laborales" name="categorias_laborales" /></AdminRoute>}/>
      <Route path="/admin/mantenimientos/ciudades" element={<AdminRoute><AdminCatalogoPage title="Ciudades" name="ciudades" /></AdminRoute>} />
      <Route path="/admin/mantenimientos/departamentos" element={<AdminRoute><AdminCatalogoPage title="Departamentos" name="departamentos" /></AdminRoute>} />
      <Route path="/admin/mantenimientos/disponibilidad-vehicular" element={<AdminRoute><AdminCatalogoPage title="Disponibilidad vehicular" name="disponibilidad_vehicular" /></AdminRoute>} />
      <Route path="/admin/mantenimientos/idiomas" element={<AdminRoute><AdminCatalogoPage title="Idiomas" name="idiomas" /></AdminRoute>} />
      <Route path="/admin/mantenimientos/nacionalidades" element={<AdminRoute><AdminCatalogoPage title="Nacionalidades" name="nacionalidades" /></AdminRoute>} />
      <Route path="/admin/mantenimientos/niveles-educativos" element={<AdminRoute><AdminCatalogoPage title="Niveles educativos" name="niveles_educativos" /></AdminRoute>} />
      <Route path="/admin/mantenimientos/niveles-idioma" element={<AdminRoute><AdminCatalogoPage title="Niveles de idioma" name="niveles_idioma" /></AdminRoute>} />
      <Route path="/admin/mantenimientos/paises" element={<AdminRoute><AdminCatalogoPage title="Países" name="paises" /></AdminRoute>} />
      <Route path="/admin/mantenimientos/sexos" element={<AdminRoute><AdminCatalogoPage title="Sexos" name="sexos" /></AdminRoute>} /> */}

      <Route path="/perfil" element={<PublicLayout><ProfilePage /></PublicLayout>} /></Routes>
  );
}