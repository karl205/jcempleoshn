<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatDisponibilidadVehicularSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cat_disponibilidad_vehicular')->upsert([
            ['id' => 1, 'nombre' => 'Sí'],
            ['id' => 2, 'nombre' => 'No'],
        ], ['id'], ['nombre']);
    }
}
