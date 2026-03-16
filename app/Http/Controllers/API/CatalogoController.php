<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CatalogoController extends Controller
{
    private function ejecutar($sp)
    {
        return DB::select("CALL $sp()");
    }

    public function ciudades()
    {
        return response()->json([
            'success' => true,
            'data' => $this->ejecutar('usp_catalogos_ciudades'),
        ]);
    }

    public function cargos()
    {
        return response()->json([
            'success' => true,
            'data' => $this->ejecutar('usp_catalogos_cargos'),
        ]);
    }

    public function categorias()
    {
        return response()->json([
            'success' => true,
            'data' => $this->ejecutar('usp_catalogos_categorias'),
        ]);
    }

    public function actividades()
    {
        return response()->json([
            'success' => true,
            'data' => $this->ejecutar('usp_catalogos_actividades'),
        ]);
    }

    public function nivelesEducativos()
    {
        return response()->json([
            'success' => true,
            'data' => $this->ejecutar('usp_catalogos_niveles_educativos'),
        ]);
    }

    public function sexos()
    {
        return response()->json([
            'success' => true,
            'data' => $this->ejecutar('usp_catalogos_sexos'),
        ]);
    }

    public function departamentos()
    {
        return response()->json([
            'success' => true,
            'data' => $this->ejecutar('usp_catalogos_departamentos'),
        ]);
    }
}
