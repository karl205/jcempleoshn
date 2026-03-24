<?php

namespace App\Http\Controllers\API;

use App\Models\CatDisponibilidadVehicular;
use App\Models\CatIdioma;
use App\Models\CatNacionalidad;
use App\Models\CatNivelEducativo;
use App\Models\CatNivelIdioma;
use App\Models\CatPais;
use App\Models\CatSexo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Controller;

class ProfileApiController extends Controller
{

    public function show(Request $request)
    {
        $userId = $request->user()->id;

        $result = DB::select('CALL usp_perfil_obtener(?)', [$userId]);

        if (empty($result) || !$result[0]->success) {
            return response()->json([
                'perfil' => null,
                'catalogos' => $this->getCatalogos()
            ]);
        }

        return response()->json([
            'perfil' => json_decode($result[0]->data),
            'catalogos' => $this->getCatalogos()
        ]);
    }


    public function update(Request $request)
    {
        $userId = $request->user()->id;

        $fotoNombre = $request->input('foto'); // mantener si no cambia

        if ($request->hasFile('foto')) {

            try {
                $extension = $request->file('foto')->getClientOriginalExtension();

                $fotoNombre = 'perfil_' . $userId . '_' . time() . '.' . $extension;

                $ruta = storage_path('app/public/fotos_perfil/' . $fotoNombre);

                if (!file_exists(dirname($ruta))) {
                    mkdir(dirname($ruta), 0777, true);
                }

                $request->file('foto')->move(dirname($ruta), $fotoNombre);

            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Error al procesar imagen',
                    'detalle' => $e->getMessage()
                ], 500);
            }
        }

        $result = DB::select('CALL usp_perfil_actualizar(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $userId,
            $request->pais_id,
            $request->departamento_id,
            $request->ciudad_id,
            $request->sexo_id,
            $request->nacionalidad_id,
            $request->disponibilidad_vehicular_id,
            $request->fecha_nacimiento,
            $request->telefono,
            $fotoNombre,
            $request->acerca_de_mi
        ]);

        if (empty($result) || !$result[0]->success) {
            return response()->json([
                'message' => $result[0]->message ?? 'Error al actualizar'
            ], 422);
        }

        return response()->json([
            'message' => 'Perfil actualizado correctamente'
        ]);
    }


    private function getCatalogos()
    {
        return [
            'sexos' => CatSexo::all(),
            'niveles' => CatNivelEducativo::all(),
            'idiomas' => CatIdioma::all(),
            'niveles_idioma' => CatNivelIdioma::all(),
            'paises' => CatPais::all(),
            'nacionalidades' => CatNacionalidad::all(),
            'vehiculos' => CatDisponibilidadVehicular::all(),
        ];
    }
}