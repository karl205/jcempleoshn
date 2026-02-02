<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['name' => 'ver_dashboard', 'description' => 'Ver dashboard'],
            ['name' => 'editar_perfil', 'description' => 'Editar perfil propio'],
            ['name' => 'postular_empleo', 'description' => 'Postular a ofertas'],
            ['name' => 'administrar_usuarios', 'description' => 'Administrar usuarios'],
            ['name' => 'ver_postulantes', 'description' => 'Ver perfiles de postulantes'],
            ['name' => 'gestionar_ofertas', 'description' => 'Gestionar ofertas laborales'],
        ];

        foreach ($permissions as $perm) {
            DB::table('permissions')->updateOrInsert(
                ['name' => $perm['name']],
                [
                    'description' => $perm['description'],
                    'updated_at' => now(),
                    'created_at' => now()
                ]
            );
        }
    }
}
