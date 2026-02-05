<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    public function run()
    {
        // Obtener ID del rol postulante
        $rolPostulanteId = DB::table('roles')
            ->where('nombre', 'postulante')
            ->value('id');

        // Obtener todos los usuarios
        $usuarios = DB::table('usuarios')->pluck('id');

        foreach ($usuarios as $usuarioId) {
            DB::table('usuarios_roles')->updateOrInsert(
                [
                    'usuario_id' => $usuarioId,
                    'rol_id'    => $rolPostulanteId,
                ],
                []
            );
        }
    }
}
