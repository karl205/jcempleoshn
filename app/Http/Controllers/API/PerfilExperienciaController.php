<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

class PerfilExperienciaController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/perfil/experiencia",
     *     summary="Agregar experiencia laboral",
     *     tags={"Perfil - Experiencia"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"empresa","cargo"},
     *             @OA\Property(property="empresa", type="string", example="Empresa XYZ"),
     *             @OA\Property(property="pais_id", type="integer", example=1),
     *             @OA\Property(property="cargo", type="string", example="Desarrollador Backend"),
     *             @OA\Property(property="fecha_desde", type="string", format="date", example="2020-01-01"),
     *             @OA\Property(property="fecha_hasta", type="string", format="date", example="2023-01-01"),
     *             @OA\Property(property="descripcion", type="string", example="Desarrollo de APIs en Laravel.")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Experiencia agregada correctamente"),
     *     @OA\Response(response=422, description="Error al agregar experiencia"),
     *     @OA\Response(response=401, description="No autenticado")
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'empresa' => 'required|string|max:150',
            'pais_id' => 'nullable|integer',
            'actividad_id' => 'nullable|integer', 
            'categoria_id' => 'nullable|integer', 
            'cargo' => 'required|string|max:150',
            'fecha_desde' => 'nullable|date',
            'fecha_hasta' => 'nullable|date',
            'descripcion' => 'nullable|string'
        ]);

        $userId = auth()->id();

        $result = DB::select('CALL usp_perfil_experiencia_agregar(?, ?, ?, ?, ?, ?, ?, ?)', [
            $userId,
            $request->empresa,
            $request->pais_id,
            $request->actividad_id,
            $request->categoria_id,
            $request->cargo,
            $request->fecha_desde,
            $request->fecha_hasta
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al agregar experiencia.',
                'EXPERIENCE_CREATE_ERROR',
                422
            );
        }

        return ApiResponse::success(
            json_decode($result[0]->data),
            'Experiencia agregada correctamente.',
            'EXPERIENCE_CREATED'
        );
    }

    /**
     * @OA\Get(
     *     path="/api/perfil/experiencia",
     *     summary="Listar experiencias laborales del usuario",
     *     tags={"Perfil - Experiencia"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Listado obtenido correctamente"),
     *     @OA\Response(response=401, description="No autenticado")
     * )
     */
    public function index()
    {
        $userId = auth()->id();

        $result = DB::select('CALL usp_perfil_experiencia_listar(?)', [
            $userId
        ]);

        if (empty($result)) {
            return ApiResponse::error(
                'Error al obtener experiencias.',
                'EXPERIENCE_LIST_ERROR',
                422
            );
        }

        return ApiResponse::success(
            $result,
            'Experiencias obtenidas correctamente.',
            'EXPERIENCE_LISTED'
        );
    }

    /**
     * @OA\Put(
     *     path="/api/perfil/experiencia/{id}",
     *     summary="Actualizar experiencia laboral",
     *     tags={"Perfil - Experiencia"},
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
     *             @OA\Property(property="empresa", type="string"),
     *             @OA\Property(property="pais_id", type="integer"),
     *             @OA\Property(property="cargo", type="string"),
     *             @OA\Property(property="fecha_desde", type="string", format="date"),
     *             @OA\Property(property="fecha_hasta", type="string", format="date"),
     *             @OA\Property(property="descripcion", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Experiencia actualizada correctamente"),
     *     @OA\Response(response=422, description="Error al actualizar experiencia")
     * )
     */
    public function update(Request $request, $id)
    {
        $userId = auth()->id();

        $result = DB::select('CALL usp_perfil_experiencia_actualizar(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $userId,
            $id,
            $request->empresa,
            $request->pais_id,
            $request->actividad_id,
            $request->categoria_id,
            $request->cargo,
            $request->fecha_desde,
            $request->fecha_hasta
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al actualizar experiencia.',
                'EXPERIENCE_UPDATE_ERROR',
                422
            );
        }

        return ApiResponse::success(
            null,
            'Experiencia actualizada correctamente.',
            'EXPERIENCE_UPDATED'
        );
    }

    /**
     * @OA\Delete(
     *     path="/api/perfil/experiencia/{id}",
     *     summary="Eliminar experiencia laboral",
     *     tags={"Perfil - Experiencia"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Experiencia eliminada correctamente"),
     *     @OA\Response(response=422, description="Error al eliminar experiencia")
     * )
     */
    public function destroy($id)
    {
        $userId = auth()->id();

        $result = DB::select('CALL usp_perfil_experiencia_eliminar(?, ?)', [
            $userId,
            $id
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al eliminar experiencia.',
                'EXPERIENCE_DELETE_ERROR',
                422
            );
        }

        return ApiResponse::success(
            null,
            'Experiencia eliminada correctamente.',
            'EXPERIENCE_DELETED'
        );
    }
}