<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

class AdminUsuarioController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/admin/usuarios",
     *     summary="Listado de usuarios",
     *     description="Obtiene el listado completo de usuarios del sistema",
     *     tags={"Admin Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Listado obtenido correctamente"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autenticado"
     *     )
     * )
     */
    public function index()
    {
        $usuarios = DB::table('usuarios as u')
            ->leftJoin('usuarios_roles as ur', 'u.id', '=', 'ur.usuario_id')
            ->leftJoin('roles as r', 'r.id', '=', 'ur.rol_id')
            ->select(
                'u.id',
                'u.nombre',
                'u.apellido',
                'u.email',
                'u.estado',
                'r.nombre as rol'
            )
            ->get();

        return ApiResponse::success(
            $usuarios,
            'Listado de usuarios',
            'ADMIN_USERS_LIST'
        );
    }


    /**
     * @OA\Post(
     *     path="/api/admin/usuarios",
     *     summary="Crear usuario",
     *     description="Permite al administrador crear un nuevo usuario",
     *     tags={"Admin Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre","apellido","email","rol"},
     *             @OA\Property(property="nombre", type="string", example="Juan"),
     *             @OA\Property(property="apellido", type="string", example="Pérez"),
     *             @OA\Property(property="email", type="string", example="juan@email.com"),
     *             @OA\Property(property="rol", type="string", example="postulante")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuario creado correctamente"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error al crear usuario"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email',
            'rol' => 'required|string'
        ]);
    
        $password = '12345678';
    
        $rolId = $request->rol === 'admin' ? 1 : 2;
    
        $ejecutorId = auth()->user()->id;
    
        $result = DB::select('CALL usp_usuario_crear(?, ?, ?, ?, ?, ?)', [
            $request->nombre,
            $request->apellido,
            $request->email,
            $password,
            $rolId,
            $ejecutorId
        ]);
    
        if (empty($result) || !isset($result[0]) || $result[0]->success != 1) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al crear usuario',
                'USER_CREATE_ERROR',
                422
            );
        }
    
        return ApiResponse::success(
            $result[0]->data,
            'Usuario creado correctamente',
            'USER_CREATED'
        );
    }

    /**
     * @OA\Put(
     *     path="/api/admin/usuarios/{id}",
     *     summary="Actualizar usuario",
     *     description="Permite al administrador actualizar un usuario",
     *     tags={"Admin Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=5)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre","apellido","email","estado"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="apellido", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="estado", type="boolean")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Usuario actualizado"),
     *     @OA\Response(response=422, description="Error al actualizar")
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
                $result[0]->message ?? 'Error al actualizar usuario',
                'USER_UPDATE_ERROR',
                422
            );
        }

        return ApiResponse::success(
            null,
            'Usuario actualizado correctamente',
            'USER_UPDATED'
        );
    }


    /**
     * @OA\Patch(
     *     path="/api/admin/usuarios/{id}/desactivar",
     *     summary="Desactivar usuario",
     *     description="Permite al administrador desactivar un usuario (soft delete)",
     *     tags={"Admin Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=5)
     *     ),
     *     @OA\Response(response=200, description="Usuario desactivado"),
     *     @OA\Response(response=422, description="Error al desactivar")
     * )
     */
    public function deactivate($id)
    {

        $usuarioAutenticado = auth()->user();

        if ($usuarioAutenticado->id == $id) {
            return ApiResponse::error(
                'No puede desactivar su propio usuario.',
                'USER_SELF_DEACTIVATE_FORBIDDEN',
                422
            );
        }

        $ejecutorId = $usuarioAutenticado->id;

        $result = DB::select('CALL usp_usuario_desactivar(?, ?)', [
            $id,
            $ejecutorId
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al desactivar usuario',
                'USER_DEACTIVATE_ERROR',
                422
            );
        }

        return ApiResponse::success(
            null,
            'Usuario desactivado correctamente',
            'USER_DEACTIVATED'
        );
    }
}