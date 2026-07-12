<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class AyudaService
{
    // Gestión: todos los items, cualquier sección/estado
    public function listarTodos()
    {
        return DB::table('ayuda_items')
            ->select('id', 'seccion', 'titulo', 'descripcion', 'archivo', 'orden', 'estado', 'created_at')
            ->orderBy('seccion')
            ->orderBy('orden')
            ->orderBy('titulo')
            ->get();
    }

    // Consumo: solo activos de una sección puntual (publico | admin)
    public function listarActivosPorSeccion(string $seccion)
    {
        return DB::table('ayuda_items')
            ->select('id', 'titulo', 'descripcion')
            ->where('seccion', $seccion)
            ->where('estado', 1)
            ->orderBy('orden')
            ->orderBy('titulo')
            ->get();
    }

    public function obtener($id)
    {
        return DB::table('ayuda_items')->where('id', $id)->first();
    }

    // Busca un item activo dentro de una sección específica (para endpoints públicos de ver/descargar)
    public function obtenerActivoPorSeccion($id, string $seccion)
    {
        return DB::table('ayuda_items')
            ->where('id', $id)
            ->where('seccion', $seccion)
            ->where('estado', 1)
            ->first();
    }

    public function crear(array $data)
    {
        return DB::table('ayuda_items')->insertGetId([
            'seccion'     => $data['seccion'],
            'titulo'      => $data['titulo'],
            'descripcion' => $data['descripcion'] ?? null,
            'archivo'     => $data['archivo'],
            'orden'       => $data['orden'] ?? 0,
            'estado'      => 1,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }

    public function actualizar($id, array $data)
    {
        $update = [
            'seccion'     => $data['seccion'],
            'titulo'      => $data['titulo'],
            'descripcion' => $data['descripcion'] ?? null,
            'orden'       => $data['orden'] ?? 0,
            'updated_at'  => now(),
        ];

        // Solo se pisa el archivo si se subió uno nuevo
        if (!empty($data['archivo'])) {
            $update['archivo'] = $data['archivo'];
        }

        DB::table('ayuda_items')->where('id', $id)->update($update);
    }

    public function desactivar($id)
    {
        DB::table('ayuda_items')->where('id', $id)->update([
            'estado' => 0,
            'updated_at' => now(),
        ]);
    }

    public function activar($id)
    {
        DB::table('ayuda_items')->where('id', $id)->update([
            'estado' => 1,
            'updated_at' => now(),
        ]);
    }

    public function eliminar($id)
    {
        DB::table('ayuda_items')->where('id', $id)->delete();
    }
}