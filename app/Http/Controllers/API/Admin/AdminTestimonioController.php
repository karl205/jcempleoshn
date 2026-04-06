<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonio;

class AdminTestimonioController extends Controller
{
    public function index()
    {
        $data = Testimonio::with('usuario')
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($t) {
                return [
                    'id' => $t->id,
                    'comentario' => $t->comentario,
                    'calificacion' => $t->calificacion,
                    'aprobado' => $t->aprobado,
                    'destacado' => $t->destacado,
                    'nombre' => $t->usuario->nombre . ' ' . $t->usuario->apellido,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function aprobar($id)
    {
        $t = Testimonio::findOrFail($id);

        $t->aprobado = !$t->aprobado;
        $t->save();

        return response()->json(['message' => 'Estado actualizado']);
    }

    public function destacar($id)
    {
        $t = Testimonio::findOrFail($id);

        $t->destacado = !$t->destacado;
        $t->save();

        return response()->json(['message' => 'Destacado actualizado']);
    }

    public function destroy($id)
    {
        try {

            $t = Testimonio::findOrFail($id);

            $t->delete();

            return response()->json([
                'message' => 'Comentario eliminado correctamente'
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'error_real' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);

        }
    }
}