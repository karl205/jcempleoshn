<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

class PerfilEducacionController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/perfil/educacion",
     *     summary="Agregar formación académica",
     *     tags={"Perfil - Educación"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"institucion"},
     *             @OA\Property(property="institucion", type="string", example="Universidad Nacional"),
     *             @OA\Property(property="nivel_educativo_id", type="integer", example=3),
     *             @OA\Property(property="area_estudio_id", type="integer", example=5),
     *             @OA\Property(property="fecha_desde", type="string", format="date", example="2015-01-01"),
     *             @OA\Property(property="fecha_hasta", type="string", format="date", example="2020-12-01")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Educación agregada correctamente"),
     *     @OA\Response(response=422, description="Error al agregar educación"),
     *     @OA\Response(response=401, description="No autenticado")
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'institucion' => 'required|string|max:150',
            'nivel_educativo_id' => 'nullable|integer',
            'area_estudio_id' => 'nullable|integer',
            'fecha_desde' => 'nullable|date',
            'fecha_hasta' => 'nullable|date',
        ]);

        $userId = auth()->id();

        $result = DB::select('CALL usp_perfil_educacion_agregar(?, ?, ?, ?, ?, ?, ?)', [
            $userId,
            $request->institucion,
            $request->nivel_educativo_id,
            $request->area_estudio_id,
            $request->pais_id,
            $request->fecha_desde,
            $request->fecha_hasta,
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al agregar educación.',
                'EDUCATION_CREATE_ERROR',
                422
            );
        }

        return ApiResponse::success(
            null,
            'Educación agregada correctamente.',
            'EDUCATION_CREATED'
        );
    }

    /**
     * @OA\Get(
     *     path="/api/perfil/educacion",
     *     summary="Listar formación académica del usuario",
     *     tags={"Perfil - Educación"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Listado obtenido correctamente"),
     *     @OA\Response(response=401, description="No autenticado")
     * )
     */
    public function index()
    {
        $userId = auth()->id();

        $result = DB::select('CALL usp_perfil_educacion_listar(?)', [
            $userId
        ]);

        if (empty($result)) {
            return ApiResponse::error(
                'Error al obtener educación.',
                'EDUCATION_LIST_ERROR',
                422
            );
        }

        return ApiResponse::success(
            $result,
            'Educación obtenida correctamente.',
            'EDUCATION_LISTED'
        );
    }

    /**
     * @OA\Put(
     *     path="/api/perfil/educacion/{id}",
     *     summary="Actualizar formación académica",
     *     tags={"Perfil - Educación"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="institucion", type="string"),
     *             @OA\Property(property="nivel_educativo_id", type="integer"),
     *             @OA\Property(property="area_estudio_id", type="integer"),
     *             @OA\Property(property="fecha_desde", type="string", format="date"),
     *             @OA\Property(property="fecha_hasta", type="string", format="date")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Educación actualizada correctamente"),
     *     @OA\Response(response=422, description="Error al actualizar educación")
     * )
     */
    public function update(Request $request, $id)
    {
        $userId = auth()->id();

        $result = DB::select('CALL usp_perfil_educacion_actualizar(?, ?, ?, ?, ?, ?, ?, ?)', [
            $userId,
            $id,
            $request->institucion,
            $request->nivel_educativo_id,
            $request->area_estudio_id,
            $request->pais_id,
            $request->fecha_desde,
            $request->fecha_hasta,
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al actualizar educación.',
                'EDUCATION_UPDATE_ERROR',
                422
            );
        }

        return ApiResponse::success(
            null,
            'Educación actualizada correctamente.',
            'EDUCATION_UPDATED'
        );
    }

    /**
     * @OA\Delete(
     *     path="/api/perfil/educacion/{id}",
     *     summary="Eliminar formación académica",
     *     tags={"Perfil - Educación"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Educación eliminada correctamente"),
     *     @OA\Response(response=422, description="Error al eliminar educación")
     * )
     */
    public function destroy($id)
    {
        $userId = auth()->id();

        $result = DB::select('CALL usp_perfil_educacion_eliminar(?, ?)', [
            $userId,
            $id
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al eliminar educación.',
                'EDUCATION_DELETE_ERROR',
                422
            );
        }

        return ApiResponse::success(
            null,
            'Educación eliminada correctamente.',
            'EDUCATION_DELETED'
        );
    }
}