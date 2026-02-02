<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionsSeeder extends Seeder
{
    public function run()
    {
        $roles = DB::table('roles')->pluck('id', 'name');
        $permissions = DB::table('permissions')->pluck('id', 'name');

        // Admin → todos
        foreach ($permissions as $permissionId) {
            DB::table('role_permissions')->updateOrInsert(
                [
                    'role_id' => $roles['admin'],
                    'permission_id' => $permissionId
                ],
                []
            );
        }

        // Postulante → limitados
        $postulantePerms = [
            'ver_dashboard',
            'editar_perfil',
            'postular_empleo'
        ];

        foreach ($postulantePerms as $perm) {
            DB::table('role_permissions')->updateOrInsert(
                [
                    'role_id' => $roles['postulante'],
                    'permission_id' => $permissions[$perm]
                ],
                []
            );
        }
    }
}


