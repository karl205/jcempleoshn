<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

class PerfilIdiomaController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/perfil/idioma",
     *     summary="Agregar idioma al perfil",
     *     tags={"Perfil - Idiomas"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"idioma_id","nivel_id"},
     *             @OA\Property(property="idioma_id", type="integer", example=1),
     *             @OA\Property(property="nivel_id", type="integer", example=2)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Idioma agregado correctamente"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error al agregar idioma"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autenticado"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'idioma_id' => 'required|integer',
            'nivel_id' => 'required|integer'
        ]);

        $userId = auth()->id();

        $result = DB::select('CALL usp_perfil_idioma_agregar(?, ?, ?)', [
            $userId,
            $request->idioma_id,
            $request->nivel_id
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al agregar idioma.',
                'IDIOMA_CREATE_ERROR',
                422
            );
        }

        return ApiResponse::success(
            json_decode($result[0]->data),
            'Idioma agregado correctamente.',
            'IDIOMA_CREATED'
        );
    }

    /**
     * @OA\Get(
     *     path="/api/perfil/idioma",
     *     summary="Listar idiomas del usuario autenticado",
     *     tags={"Perfil - Idiomas"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Idiomas obtenidos correctamente"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autenticado"
     *     )
     * )
     */
    public function index()
    {
        $userId = auth()->id();

        $result = DB::select('CALL usp_perfil_idioma_listar(?)', [$userId]);

        return ApiResponse::success(
            $result,
            'Idiomas obtenidos correctamente.',
            'IDIOMA_LISTED'
        );
    }

    /**
     * @OA\Put(
     *     path="/api/perfil/idioma/{id}",
     *     summary="Actualizar nivel de idioma",
     *     tags={"Perfil - Idiomas"},
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
     *             required={"nivel_id"},
     *             @OA\Property(property="nivel_id", type="integer", example=3)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Idioma actualizado correctamente"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error al actualizar idioma"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autenticado"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nivel_id' => 'required|integer'
        ]);

        $userId = auth()->id();

        $result = DB::select('CALL usp_perfil_idioma_actualizar(?, ?, ?)', [
            $userId,
            $id,
            $request->nivel_id
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al actualizar idioma.',
                'IDIOMA_UPDATE_ERROR',
                422
            );
        }

        return ApiResponse::success(
            null,
            'Idioma actualizado correctamente.',
            'IDIOMA_UPDATED'
        );
    }

    /**
     * @OA\Delete(
     *     path="/api/perfil/idioma/{id}",
     *     summary="Eliminar idioma del perfil",
     *     tags={"Perfil - Idiomas"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Idioma eliminado correctamente"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error al eliminar idioma"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autenticado"
     *     )
     * )
     */
    public function destroy($id)
    {
        $userId = auth()->id();

        $result = DB::select('CALL usp_perfil_idioma_eliminar(?, ?)', [
            $userId,
            $id
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al eliminar idioma.',
                'IDIOMA_DELETE_ERROR',
                422
            );
        }

        return ApiResponse::success(
            null,
            'Idioma eliminado correctamente.',
            'IDIOMA_DELETED'
        );
    }
}