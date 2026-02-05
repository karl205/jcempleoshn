<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionsSeeder extends Seeder
{
    public function run()
    {
        // Obtener roles y permisos usando columnas en español
        $roles = DB::table('roles')->pluck('id', 'nombre');
        $permisos = DB::table('permisos')->pluck('id', 'nombre');

        // Admin → todos los permisos
        foreach ($permisos as $permisoId) {
            DB::table('roles_permisos')->updateOrInsert(
                [
                    'rol_id' => $roles['admin'],
                    'permiso_id' => $permisoId,
                ],
                []
            );
        }

        // Postulante → permisos limitados
        $permisosPostulante = [
            'ver_dashboard',
            'editar_perfil',
            'postular_empleo',
        ];

        foreach ($permisosPostulante as $permiso) {
            DB::table('roles_permisos')->updateOrInsert(
                [
                    'rol_id' => $roles['postulante'],
                    'permiso_id' => $permisos[$permiso],
                ],
                []
            );
        }
    }
}
