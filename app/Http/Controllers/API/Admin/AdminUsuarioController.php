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
     *
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
                'r.id as rol_id',
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
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"nombre","apellido","email","rol"},
     *
     *             @OA\Property(property="nombre", type="string", example="Juan"),
     *             @OA\Property(property="apellido", type="string", example="Pérez"),
     *             @OA\Property(property="email", type="string", example="juan@email.com"),
     *             @OA\Property(property="rol", type="string", example="postulante")
     *         )
     *     ),
     *
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
            'rol' => 'required|integer'
        ]);

        $password = '12345678';

        $rolId = $request->rol;

        $ejecutorId = auth()->user()->id;

        $result = DB::select('CALL usp_usuario_crear(?, ?, ?, ?, ?, ?)', [
            $request->nombre,
            $request->apellido,
            $request->email,
            $password,
            $rolId,
            $ejecutorId,
        ]);

        if (empty($result) || ! isset($result[0]) || $result[0]->success != 1) {
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
     *     description="Permite al administrador actualizar los datos de un usuario y su rol",
     *     tags={"Admin Usuarios"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del usuario",
     *         @OA\Schema(type="integer", example=5)
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre","apellido","email","rol","estado"},
     *
     *             @OA\Property(property="nombre", type="string", example="Juan"),
     *             @OA\Property(property="apellido", type="string", example="Perez"),
     *             @OA\Property(property="email", type="string", example="juan@email.com"),
     *             @OA\Property(property="rol", type="integer", example=2),
     *             @OA\Property(property="estado", type="boolean", example=true)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Usuario actualizado correctamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuario no encontrado"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
    
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email',
            'rol' => 'required|integer',
            'estado' => 'required|boolean'
        ]);
    
        /*
        OBTENER USUARIO ACTUAL
        */
    
        $usuario = DB::table('usuarios as u')
            ->leftJoin('usuarios_roles as ur', 'u.id', '=', 'ur.usuario_id')
            ->leftJoin('roles as r', 'r.id', '=', 'ur.rol_id')
            ->where('u.id', $id)
            ->select(
                'u.id',
                'r.id as rol_id',
                'r.nombre as rol'
            )
            ->first();
    
        if (!$usuario) {
    
            return ApiResponse::error(
                'Usuario no encontrado',
                'USER_NOT_FOUND',
                404
            );
    
        }
    
        /*
        VALIDAR ÚLTIMO ADMIN
        */
    
        if ($usuario->rol_id == 1 && $request->rol != 1) {
    
            $admins = DB::table('usuarios_roles')
                ->where('rol_id', 1)
                ->count();
    
            if ($admins <= 1) {
    
                return ApiResponse::error(
                    'No puede cambiar el rol del único administrador del sistema.',
                    'LAST_ADMIN_BLOCKED',
                    422
                );
    
            }
    
        }
    
        /*
        ACTUALIZAR DATOS DEL USUARIO
        */
    
        DB::table('usuarios')
            ->where('id', $id)
            ->update([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'estado' => $request->estado
            ]);
    
        /*
        ACTUALIZAR ROL
        */
    
        DB::table('usuarios_roles')->updateOrInsert(
            ['usuario_id' => $id],
            ['rol_id' => $request->rol]
        );
    
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
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(type="integer", example=5)
     *     ),
     *
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
            $ejecutorId,
        ]);

        if (empty($result) || ! $result[0]->success) {
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
