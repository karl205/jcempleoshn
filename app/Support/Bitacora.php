<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;

class Bitacora
{
    public static function registrar(string $modulo, string $accion, string $descripcion): void
    {
        try {
            DB::table('bitacora')->insert([
                'usuario_id'  => auth()->id(),
                'modulo'      => $modulo,
                'accion'      => $accion,
                'descripcion' => $descripcion,
                'created_at'  => now(),
            ]);
        } catch (\Throwable $e) {
            // Si falla la bitácora, no debe romper el flujo principal
        }
    }
}