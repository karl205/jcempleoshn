<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

class PerfilController extends Controller
{
    /**
     * @OA\Put(
     *     path="/api/perfil",
     *     summary="Actualizar perfil del usuario autenticado",
     *     tags={"Perfil"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="pais_id", type="integer"),
     *             @OA\Property(property="departamento_id", type="integer"),
     *             @OA\Property(property="ciudad_id", type="integer"),
     *             @OA\Property(property="sexo_id", type="integer"),
     *             @OA\Property(property="nacionalidad_id", type="integer"),
     *             @OA\Property(property="disponibilidad_vehicular_id", type="integer"),
     *             @OA\Property(property="fecha_nacimiento", type="string", example="1995-05-20"),
     *             @OA\Property(property="telefono", type="string"),
     *             @OA\Property(property="foto", type="string"),
     *             @OA\Property(property="acerca_de_mi", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Perfil actualizado correctamente"),
     *     @OA\Response(response=401, description="No autenticado")
     * )
     */
    public function update(Request $request)
    {
        $userId = auth()->id();

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
            $request->foto,
            $request->acerca_de_mi
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al actualizar perfil.',
                'PROFILE_UPDATE_ERROR',
                422
            );
        }

        return ApiResponse::success(
            null,
            'Perfil actualizado correctamente.',
            'PROFILE_UPDATED'
        );
    }

        /**
     * @OA\Get(
     *     path="/api/perfil",
     *     summary="Obtener perfil del usuario autenticado",
     *     tags={"Perfil"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Perfil obtenido correctamente"),
     *     @OA\Response(response=401, description="No autenticado")
     * )
     */
    public function show()
    {
        $userId = auth()->id();

        $result = DB::select('CALL usp_perfil_obtener(?)', [
            $userId
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al obtener perfil.',
                'PROFILE_GET_ERROR',
                422
            );
        }

        return ApiResponse::success(
            json_decode($result[0]->data),
            'Perfil obtenido correctamente.',
            'PROFILE_OBTAINED'
        );
    }
}