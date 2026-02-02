<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'admin', 'description' => 'Administrador del sistema'],
            ['name' => 'postulante', 'description' => 'Usuario postulante a empleos'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['name' => $role['name']],
                [
                    'description' => $role['description'],
                    'updated_at' => now(),
                    'created_at' => now()
                ]
            );
        }
    }
}
