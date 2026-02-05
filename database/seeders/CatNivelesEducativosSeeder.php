<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CatNivelesEducativosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cat_niveles_educativos')->upsert([
            ['id' => 1, 'nombre' => 'Primaria'],
            ['id' => 2, 'nombre' => 'Secundaria'],
            ['id' => 3, 'nombre' => 'Técnico'],
            ['id' => 4, 'nombre' => 'Universitario'],
            ['id' => 5, 'nombre' => 'Postgrado'],
        ], ['id'], ['nombre']);
    }
}
