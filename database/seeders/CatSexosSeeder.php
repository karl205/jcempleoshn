<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatSexosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cat_sexos')->upsert([
            ['id' => 1, 'nombre' => 'Masculino'],
            ['id' => 2, 'nombre' => 'Femenino'],
            ['id' => 3, 'nombre' => 'Otro'],
            ['id' => 4, 'nombre' => 'Prefiero no decirlo'],
        ], ['id'], ['nombre']);
    }
}
