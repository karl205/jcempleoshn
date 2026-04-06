<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Testimonio;
use Illuminate\Http\Request;

class TestimonioController extends Controller
{
    public function index()
    {
        try {

            $testimonios = Testimonio::with('usuario')
                ->where('aprobado', 1)
                ->whereHas('usuario')
                ->orderByDesc('destacado')
                ->orderByDesc('created_at')
                ->take(10)
                ->get()
                ->map(function ($t) {
                    return [
                        'comentario' => $t->comentario,
                        'calificacion' => $t->calificacion,
                        'nombre' => optional($t->usuario)->nombre . ' ' . optional($t->usuario)->apellido,
                    ];
                });

            return response()->json($testimonios);

        } catch (\Throwable $e) {

            return response()->json([
                'error_real' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'comentario' => 'required|string|max:250',
            'calificacion' => 'required|integer|min:1|max:5',
        ]);

        $user = $request->user();

        Testimonio::create([
            'usuario_id' => $user->id,
            'comentario' => $request->comentario,
            'calificacion' => $request->calificacion,
            'aprobado' => 0, 
            'destacado' => 0,
        ]);

        return response()->json([
            'message' => 'Comentario enviado correctamente'
        ]);
    }
}