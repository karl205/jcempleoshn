<?php

namespace App\Http\Controllers\API;

// use App\Models\CatActividadLaboral;
use App\Models\CatActividadLaboral;
use App\Models\catAreasEstudio;
use App\Models\catCategorias;
use App\Models\CatDisponibilidadVehicular;
use App\Models\CatIdioma;
use App\Models\CatNacionalidad;
use App\Models\CatNivelEducativo;
use App\Models\CatNivelIdioma;
use App\Models\CatPais;
use App\Models\CatSexo;
use App\Models\catCiudades;
use App\Models\catDepartamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class ProfileApiController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'No autenticado'
            ], 401);
        }

        $userId = $user->id;

        $perfil = DB::select('CALL usp_perfil_obtener(?)', [$userId]);
        $educaciones = DB::select('CALL usp_perfil_educacion_listar(?)', [$userId]);
        $idiomas = DB::select('CALL usp_perfil_idioma_listar(?)', [$userId]);
        $experiencias = DB::select('CALL usp_perfil_experiencia_listar(?)', [$userId]);

        $data = json_decode($perfil[0]->data, true);

        $data['educaciones'] = $educaciones;
        $data['idiomas'] = $idiomas;
        $data['experiencias'] = $experiencias;

        return response()->json([
            'perfil' => $data,
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

        $result = DB::select('CALL usp_perfil_actualizar(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
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
            $request->acerca_de_mi,
            $request->aspiracion_salarial
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

    public function updateBasic(Request $request)
    {
        try {

            $request->validate([
                'nombre' => 'required|string|max:100',
                'apellido' => 'required|string|max:100',
            ]);

            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'message' => 'No autenticado'
                ], 401);
            }

            $user->update([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
            ]);

            return response()->json([
                'message' => 'Datos actualizados correctamente'
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'message' => 'Error real backend',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);

        }
    }


    public function destroy(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = $request->user();

        // validar contraseña
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Contraseña incorrecta.'
            ], 422);
        }

        try {
            // eliminar perfil relacionado
            $user->perfil()->delete();

            // eliminar usuario
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Cuenta eliminada correctamente.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar cuenta.'
            ], 500);
        }
    }

    private function getCatalogos()
    {
        return [
            'sexos' => CatSexo::all(),
            'niveles' => CatNivelEducativo::all(),
            'idiomas' => CatIdioma::all(),
            'niveles_idioma' => CatNivelIdioma::all(),
            'paises' => CatPais::all(),
            'departamentos' => catDepartamentos::all(),
            'ciudades' => catCiudades::all(),
            'nacionalidades' => CatNacionalidad::all(),
            'vehiculos' => CatDisponibilidadVehicular::all(),
            'areas_estudio' => catAreasEstudio::all(),
            'actividades' => CatActividadLaboral::all(),
            'categorias' => catCategorias::all(),
        ];
    }
}