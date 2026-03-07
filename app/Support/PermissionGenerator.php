<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;

class PermissionGenerator
{
    public static function generate(string $modulo)
    {
        $acciones = ['ver','crear','editar','eliminar'];

        foreach($acciones as $accion){

            $nombre = "{$modulo}.{$accion}";

            DB::table('permisos')->updateOrInsert(
                ['nombre'=>$nombre],
                ['descripcion'=>ucfirst($accion)." {$modulo}"]
            );
        }
    }
}