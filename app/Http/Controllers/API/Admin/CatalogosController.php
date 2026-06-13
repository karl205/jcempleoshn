<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Support\Bitacora;
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

        Bitacora::registrar(
            'catalogos',
            'crear',
            'Creó "' . $request->nombre . '" en catálogo ' . $catalogo
        );

        return response()->json(['message' => 'Creado']);
    }

    public function update(Request $request, $catalogo, $id)
    {
        $item = DB::table($this->tabla($catalogo))->where('id', $id)->first();

        $data = $request->except(['id']);

        DB::table($this->tabla($catalogo))
            ->where('id', $id)
            ->update($data);

        Bitacora::registrar(
            'catalogos',
            'actualizar',
            'Actualizó "' . ($item->nombre ?? 'ID ' . $id) . '" a "' . $request->nombre . '" en catálogo ' . $catalogo
        );

        return response()->json(['message' => 'Actualizado']);
    }

    public function toggle(Request $request, $catalogo, $id)
    {
        $request->validate([
            'comentario' => 'required|string|max:255'
        ]);

        $item = DB::table($this->tabla($catalogo))->where('id', $id)->first();

        $nuevoEstado = !$item->estado;

        DB::table($this->tabla($catalogo))
            ->where('id', $id)
            ->update(['estado' => $nuevoEstado]);

        Bitacora::registrar(
            'catalogos',
            'cambiar_estado',
            'Cambió estado a ' . ($nuevoEstado ? 'activo' : 'inactivo') . ' el registro "' . ($item->nombre ?? 'ID ' . $id) . '" en catálogo ' . $catalogo . ' — Motivo: ' . $request->comentario
        );

        return response()->json(['message' => 'Estado actualizado']);
    }

    public function destroy(Request $request, $catalogo, $id)
    {
        $request->validate([
            'comentario' => 'required|string|max:255'
        ]);

        $item = DB::table($this->tabla($catalogo))->where('id', $id)->first();

        DB::table($this->tabla($catalogo))
            ->where('id', $id)
            ->delete();

        Bitacora::registrar(
            'catalogos',
            'eliminar',
            'Eliminó "' . ($item->nombre ?? 'ID ' . $id) . '" del catálogo ' . $catalogo . ' — Motivo: ' . $request->comentario
        );

        return response()->json(['message' => 'Eliminado']);
    }
}