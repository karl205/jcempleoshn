<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BitacoraController extends Controller
{
    public function index()
    {
        try {

            $data = DB::table('bitacora as b')
                ->leftJoin('usuarios as u', 'u.id', '=', 'b.usuario_id')
                ->select(
                    'b.id',
                    DB::raw("CONCAT(u.nombre, ' ', u.apellido) as usuario"),
                    'b.modulo',
                    'b.accion',
                    'b.descripcion',
                    'b.created_at'
                )
                ->orderByDesc('b.created_at')
                ->limit(200) // evita cargar miles
                ->get();

            return response()->json([
                'success' => true,
                'data' => $data
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'error_real' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);
        }
    }
}