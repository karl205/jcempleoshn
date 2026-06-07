<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Postulacion;
use App\Models\Plaza;
use App\Support\ApiResponse;
use Illuminate\Http\Request;

class PostulacionController extends Controller
{
    public function postular($id)
    {
        $user = auth()->user();

        $plaza = Plaza::find($id);

        if (!$plaza) {
            return ApiResponse::error(
                'Plaza no encontrada',
                'PLAZA_NOT_FOUND',
                404
            );
        }

        if ($plaza->estado == 0) {
            return ApiResponse::error(
                'La plaza ya está cerrada',
                'PLAZA_CLOSED',
                400
            );
        }

        $existe = Postulacion::where('usuario_id', $user->id)
            ->where('plaza_id', $id)
            ->exists();

        if ($existe) {
            return ApiResponse::error(
                'Ya estás postulado a esta plaza',
                'ALREADY_APPLIED',
                400
            );
        }

        Postulacion::create([
            'usuario_id' => $user->id,
            'plaza_id' => $id
        ]);

        return ApiResponse::success(
            null,
            'Postulación realizada correctamente',
            'POSTULACION_OK'
        );
    }

    public function adminListado()
{
    return Plaza::select('id', 'titulo', 'estado')
        ->withCount('postulaciones')
        ->get();
}

    public function porPlaza($plaza_id)
    {
        return Postulacion::with([
            'usuario:id,nombre,apellido,email',
            'usuario.perfil:usuario_id,foto'
        ])
            ->where('plaza_id', $plaza_id)
            ->get();
    }

    public function cambiarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:apto,no_apto'
        ]);

        $postulacion = Postulacion::findOrFail($id);

        $postulacion->estado = $request->estado;
        $postulacion->save();

        return ApiResponse::success(
            $postulacion,
            'Estado actualizado',
            'POSTULACION_UPDATED'
        );
    }

    public function misPostulaciones()
    {
        return Postulacion::with('plaza')
            ->where('usuario_id', auth()->id())
            ->latest()
            ->get();
    }

    public function verPerfil($id)
{
    $usuario = \App\Models\Usuario::with([
        'perfil',
        'perfil.pais',
        'perfil.sexo',
        'perfil.nacionalidad',
        'perfil.ciudad',
        'perfil.departamento',
        'perfil.disponibilidadVehicular',
        'perfil.educaciones.nivelEducativo',
        'perfil.educaciones.areaEstudio',
        'perfil.idiomas.idioma',
        'perfil.idiomas.nivel',
        'perfil.experiencias.categoria',
        'perfil.experiencias.actividad',
        'perfil.experiencias.pais',
    ])->findOrFail($id);

    return ApiResponse::success($usuario);
}
}