<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class PlazaService
{
    public function listar()
    {
        return DB::table('plazas as p')

            ->leftJoin('cat_ciudades as c', 'c.id', '=', 'p.ciudad_id')
            ->leftJoin('cat_departamentos as d', 'd.id', '=', 'c.departamento_id')
            ->leftJoin('cat_cargos_laborales as cl', 'cl.id', '=', 'p.cargo_id')
            ->leftJoin('cat_categorias_laborales as ca', 'ca.id', '=', 'p.categoria_laboral_id')

            ->select(
                'p.id',
                'p.titulo',
                'p.salario_min',
                'p.salario_max',
                'p.estado',
                'p.created_at',

                'p.cargo_id',
                'p.ciudad_id',
                'p.categoria_laboral_id as categoria_id',

                'd.id as departamento_id',

                'c.nombre as ciudad',
                'd.nombre as departamento',
                'cl.nombre as cargo',
                'ca.nombre as categoria'
            )

            ->where('p.estado', 1) 

            ->orderBy('p.created_at', 'desc')

            ->get();
    }

    public function obtener($id)
    {
        return DB::table('plazas as p')
            ->select(
                'p.id',
                'p.titulo',
                'p.descripcion',
                'p.requisitos',
                'p.beneficios',

                'p.ciudad_id',
                'p.cargo_id',

                'p.categoria_laboral_id as categoria_id',
                'p.actividad_laboral_id as actividad_id',

                'p.tipo_contratacion',

                'p.nivel_educativo_id',
                'p.sexo_id',

                'p.experiencia_minima',
                'p.edad_minima',
                'p.edad_maxima',

                'p.salario_min',
                'p.salario_max',

                'p.fecha_cierre'
            )
            ->where('p.id', $id)
            ->first();
    }

    public function crear($data, $usuarioId)
    {
        DB::select('CALL usp_plazas_crear(
        ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
        )', [
            $data['titulo'],
            $data['descripcion'],
            $data['requisitos'] ?? null,
            $data['beneficios'] ?? null,

            $data['ciudad_id'],
            $data['cargo_id'],
            $data['categoria_id'],
            $data['actividad_id'],

            $data['tipo_contratacion'],

            $data['nivel_educativo_id'],
            $data['sexo_id'],

            $data['experiencia_minima'] ?? 0,
            $data['edad_minima'] ?? null,
            $data['edad_maxima'] ?? null,

            $data['salario_min'] ?? null,
            $data['salario_max'] ?? null,

            $data['fecha_cierre'],

            $usuarioId,
        ]);

    }

    public function actualizar($id, $data)
    {
        DB::table('plazas')
            ->where('id', $id)
            ->update([

                'titulo' => $data['titulo'],
                'descripcion' => $data['descripcion'],
                'requisitos' => $data['requisitos'],
                'beneficios' => $data['beneficios'],

                'ciudad_id' => $data['ciudad_id'],
                'cargo_id' => $data['cargo_id'],
                'categoria_laboral_id' => $data['categoria_id'],
                'actividad_laboral_id' => $data['actividad_id'],

                'tipo_contratacion' => $data['tipo_contratacion'],

                'nivel_educativo_id' => $data['nivel_educativo_id'],
                'sexo_id' => $data['sexo_id'],

                'experiencia_minima' => $data['experiencia_minima'],
                'edad_minima' => $data['edad_minima'],
                'edad_maxima' => $data['edad_maxima'],

                'salario_min' => $data['salario_min'],
                'salario_max' => $data['salario_max'],

                'fecha_cierre' => $data['fecha_cierre'],
                'updated_at' => now()
            ]);
    }

    public function cerrar($id)
    {
        DB::table('plazas')
            ->where('id', $id)
            ->update([
                'estado' => 0,
                'updated_at' => now()
            ]);
    }

    public function ultimasPublicadas($limite = 3)
    {
        return DB::table('plazas as p')
            ->leftJoin('cat_ciudades as c', 'c.id', '=', 'p.ciudad_id')
            ->leftJoin('cat_categorias_laborales as cat', 'cat.id', '=', 'p.categoria_laboral_id')
            ->leftJoin('cat_actividades_laborales as act', 'act.id', '=', 'p.actividad_laboral_id')
            ->select(
                'p.id',
                'p.titulo',
                'p.created_at',
                'c.nombre as ciudad',
                'cat.nombre as categoria',
                'act.nombre as actividad'
            )
            ->where('p.estado', 1)
            ->orderBy('p.created_at', 'desc')
            ->limit($limite)
            ->get();
    }
}
