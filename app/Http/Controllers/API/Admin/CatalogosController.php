<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogosController extends Controller
{
    private function tabla($nombre)
    {
        return "cat_" . $nombre;
    }

    public function index($catalogo)
    {
        $data = DB::table($this->tabla($catalogo))
            ->orderByDesc('id')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function store(Request $request, $catalogo)
    {
        $request->validate([
            'nombre' => 'required|max:100'
        ]);

        $data = $request->all();

        $data['estado'] = 1;

        DB::table($this->tabla($catalogo))->insert($data);

        return response()->json(['message' => 'Creado']);
    }

    public function update(Request $request, $catalogo, $id)
    {
        $data = $request->except(['id']);

        DB::table($this->tabla($catalogo))
            ->where('id', $id)
            ->update($data);

        return response()->json(['message' => 'Actualizado']);
    }

    public function toggle($catalogo, $id)
    {
        $item = DB::table($this->tabla($catalogo))->where('id', $id)->first();

        DB::table($this->tabla($catalogo))
            ->where('id', $id)
            ->update([
                'estado' => !$item->estado
            ]);

        return response()->json(['message' => 'Estado actualizado']);
    }

    public function destroy($catalogo, $id)
    {
        DB::table($this->tabla($catalogo))
            ->where('id', $id)
            ->delete();

        return response()->json(['message' => 'Eliminado']);
    }
}