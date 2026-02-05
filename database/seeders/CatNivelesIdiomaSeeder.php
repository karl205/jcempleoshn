<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CatNivelesIdiomaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cat_niveles_idioma')->upsert([
            ['id' => 1, 'nombre' => 'Básico'],
            ['id' => 2, 'nombre' => 'Intermedio'],
            ['id' => 3, 'nombre' => 'Avanzado'],
            ['id' => 4, 'nombre' => 'Nativo'],
        ], ['id'], ['nombre']);
    }
}
