<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

class UsuarioController extends Controller
{
    /**
     * @OA\Put(
     *     path="/api/usuarios/{id}",
     *     summary="Actualizar usuario",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del usuario",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre","apellido","email","estado"},
     *             @OA\Property(property="nombre", type="string", example="Juan"),
     *             @OA\Property(property="apellido", type="string", example="Pérez"),
     *             @OA\Property(property="email", type="string", example="juan@email.com"),
     *             @OA\Property(property="estado", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Usuario actualizado correctamente"),
     *     @OA\Response(response=422, description="Error al actualizar usuario"),
     *     @OA\Response(response=401, description="No autenticado")
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email',
            'estado' => 'required|boolean'
        ]);

        $ejecutorId = auth()->id();

        $result = DB::select('CALL usp_usuario_actualizar(?, ?, ?, ?, ?, ?)', [
            $id,
            $request->nombre,
            $request->apellido,
            $request->email,
            $request->estado,
            $ejecutorId
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al actualizar usuario.',
                'USER_UPDATE_ERROR',
                422
            );
        }

        return ApiResponse::success(
            null,
            'Usuario actualizado correctamente.',
            'USER_UPDATED'
        );
    }

    /**
     * @OA\Patch(
     *     path="/api/usuarios/{id}/desactivar",
     *     summary="Desactivar usuario (soft delete)",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del usuario a desactivar",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Usuario desactivado correctamente"),
     *     @OA\Response(response=422, description="Error al desactivar usuario"),
     *     @OA\Response(response=401, description="No autenticado")
     * )
     */
    public function deactivate($id)
    {
        $ejecutorId = auth()->id();

        $result = DB::select('CALL usp_usuario_desactivar(?, ?)', [
            $id,
            $ejecutorId
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al desactivar usuario.',
                'USER_DEACTIVATE_ERROR',
                422
            );
        }

        return ApiResponse::success(
            null,
            'Usuario desactivado correctamente.',
            'USER_DEACTIVATED'
        );
    }
}