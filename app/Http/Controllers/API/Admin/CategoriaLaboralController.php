<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaLaboral;
use Illuminate\Http\Request;

class CategoriaLaboralController extends Controller
{
    public function index()
    {
        try {

            $data = CategoriaLaboral::orderByDesc('id')->get();

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

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100|unique:cat_categorias_laborales,nombre'
        ]);

        CategoriaLaboral::create([
            'nombre' => $request->nombre,
            'estado' => 1
        ]);

        return response()->json(['message' => 'Creado correctamente']);
    }

    public function update(Request $request, $id)
    {
        $cat = CategoriaLaboral::findOrFail($id);

        $request->validate([
            'nombre' => "required|max:100|unique:cat_categorias_laborales,nombre,$id"
        ]);

        $cat->update([
            'nombre' => $request->nombre,
        ]);

        return response()->json(['message' => 'Actualizado']);
    }

    public function toggle($id)
    {
        $cat = CategoriaLaboral::findOrFail($id);

        $cat->estado = !$cat->estado;
        $cat->save();

        return response()->json(['message' => 'Estado actualizado']);
    }

    public function destroy($id)
    {
        CategoriaLaboral::destroy($id);

        return response()->json(['message' => 'Eliminado']);
    }
}