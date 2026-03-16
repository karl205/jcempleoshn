<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMenuController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        // Permisos del usuario
        $permisos = DB::table('usuarios_roles as ur')
            ->join('roles_permisos as rp', 'rp.rol_id', '=', 'ur.rol_id')
            ->join('permisos as p', 'p.id', '=', 'rp.permiso_id')
            ->where('ur.usuario_id', $userId)
            ->pluck('p.nombre')
            ->toArray();

        // Definición de módulos del menú
        $menu = [

            [
                'label' => 'Dashboard',
                'path' => '/admin',
                'icon' => 'FaTachometerAlt',
                'permiso' => 'ver_dashboard',
            ],

            [
                'label' => 'Usuarios',
                'path' => '/admin/usuarios',
                'icon' => 'FaUsers',
                'permiso' => 'usuarios.ver',
            ],

            [
                'label' => 'Roles',
                'path' => '/admin/roles',
                'icon' => 'FaUserShield',
                'permiso' => 'roles.ver',
            ],

            [
                'label' => 'Permisos',
                'path' => '/admin/permisos',
                'icon' => 'FaKey',
                'permiso' => 'permisos.ver',
            ],

            [
                'label' => 'Plazas',
                'path' => '/admin/plazas',
                'icon' => 'FaBriefcase',
                'permiso' => 'plazas.ver',
            ],
        ];

        // Filtrar menú por permisos
        $menuFiltrado = array_values(array_filter($menu, function ($item) use ($permisos) {
            return in_array($item['permiso'], $permisos);
        }));

        return response()->json([
            'success' => true,
            'data' => $menuFiltrado,
        ]);
    }
}