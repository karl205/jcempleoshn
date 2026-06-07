<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Support\ApiResponse;
use Illuminate\Support\Facades\DB;

class AdminStatsController extends Controller
{
    public function index()
    {
        // Calificaciones agrupadas
        $calificaciones = DB::table('testimonios')
            ->select('calificacion', DB::raw('count(*) as total'))
            ->groupBy('calificacion')
            ->pluck('total', 'calificacion')
            ->toArray();

        $stats = [
            'usuarios'                    => DB::table('usuarios')->count(),
            'roles'                       => DB::table('roles')->count(),
            'plazas'                      => DB::table('plazas')->count(),
            'plazas_activas'              => DB::table('plazas')->where('estado', 1)->count(),
            'plazas_cerradas'             => DB::table('plazas')->where('estado', 0)->count(),
            'postulaciones'               => DB::table('postulaciones')->count(),
            'testimonios'                 => DB::table('testimonios')->count(),
            'testimonios_pendientes'      => DB::table('testimonios')->where('aprobado', 0)->count(),
            'testimonios_por_calificacion' => $calificaciones,
        ];

        return ApiResponse::success($stats, 'Estadísticas del sistema', 'STATS_OK');
    }
}