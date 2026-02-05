<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatIdiomasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cat_idiomas')->upsert([
            ['id' => 1, 'nombre' => 'Español'],
            ['id' => 2, 'nombre' => 'Inglés'],
            ['id' => 3, 'nombre' => 'Francés'],
            ['id' => 4, 'nombre' => 'Portugués'],
            ['id' => 5, 'nombre' => 'Alemán'],
            ['id' => 6, 'nombre' => 'Italiano'],
            ['id' => 7, 'nombre' => 'Chino mandarín'],
            ['id' => 8, 'nombre' => 'Japonés'],
            ['id' => 9, 'nombre' => 'Coreano'],
            ['id' => 10, 'nombre' => 'Ruso'],
            ['id' => 11, 'nombre' => 'Árabe'],
            ['id' => 12, 'nombre' => 'Hindi'],
            ['id' => 13, 'nombre' => 'Bengalí'],
            ['id' => 14, 'nombre' => 'Urdu'],
            ['id' => 15, 'nombre' => 'Turco'],
            ['id' => 16, 'nombre' => 'Polaco'],
            ['id' => 17, 'nombre' => 'Neerlandés'],
            ['id' => 18, 'nombre' => 'Sueco'],
            ['id' => 19, 'nombre' => 'Noruego'],
            ['id' => 20, 'nombre' => 'Danés'],
            ['id' => 21, 'nombre' => 'Finlandés'],
            ['id' => 22, 'nombre' => 'Checo'],
            ['id' => 23, 'nombre' => 'Eslovaco'],
            ['id' => 24, 'nombre' => 'Húngaro'],
            ['id' => 25, 'nombre' => 'Rumano'],
            ['id' => 26, 'nombre' => 'Búlgaro'],
            ['id' => 27, 'nombre' => 'Griego'],
            ['id' => 28, 'nombre' => 'Hebreo'],
            ['id' => 29, 'nombre' => 'Tailandés'],
            ['id' => 30, 'nombre' => 'Vietnamita'],
            ['id' => 31, 'nombre' => 'Indonesio'],
            ['id' => 32, 'nombre' => 'Malayo'],
            ['id' => 33, 'nombre' => 'Filipino'],
            ['id' => 34, 'nombre' => 'Swahili'],
            ['id' => 35, 'nombre' => 'Zulu'],
            ['id' => 36, 'nombre' => 'Afrikáans'],
            ['id' => 37, 'nombre' => 'Persa'],
            ['id' => 38, 'nombre' => 'Ucraniano'],
            ['id' => 39, 'nombre' => 'Croata'],
            ['id' => 40, 'nombre' => 'Serbio'],
            ['id' => 41, 'nombre' => 'Esloveno'],
            ['id' => 42, 'nombre' => 'Letón'],
            ['id' => 43, 'nombre' => 'Lituano'],
            ['id' => 44, 'nombre' => 'Estonio'],
            ['id' => 45, 'nombre' => 'Islandés'],
            ['id' => 46, 'nombre' => 'Irlandés'],
            ['id' => 47, 'nombre' => 'Galés'],
            ['id' => 48, 'nombre' => 'Catalán'],
            ['id' => 49, 'nombre' => 'Vasco'],
            ['id' => 50, 'nombre' => 'Quechua'],
        ], ['id'], ['nombre']);
    }
}
