<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $permisos = [
            ['nombre' => 'ver_dashboard',        'descripcion' => 'Ver dashboard'],
            ['nombre' => 'editar_perfil',         'descripcion' => 'Editar perfil propio'],
            ['nombre' => 'postular_empleo',       'descripcion' => 'Postular a ofertas'],
            ['nombre' => 'administrar_usuarios',  'descripcion' => 'Administrar usuarios'],
            ['nombre' => 'ver_postulantes',       'descripcion' => 'Ver perfiles de postulantes'],
            ['nombre' => 'gestionar_ofertas',     'descripcion' => 'Gestionar ofertas laborales'],
        ];

        foreach ($permisos as $permiso) {
            DB::table('permisos')->updateOrInsert(
                ['nombre' => $permiso['nombre']],
                [
                    'descripcion' => $permiso['descripcion'],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]
            );
        }
    }
}
