<?php

namespace App\Http\Controllers\API\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Support\ApiResponse;
use App\Support\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

class AdminUsuarioController extends Controller
{
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

    public function store(Request $request)
{
    $request->validate([
        'nombre'   => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email'    => 'required|email',
        'rol'      => 'required|integer',
        'password' => 'required|string|min:6',
    ]);

    $password   = Hash::make($request->password); // ← hashear lo que manda el admin
    $rolId      = $request->rol;
    $ejecutorId = auth()->user()->id;

    $result = DB::select('CALL usp_usuario_crear(?, ?, ?, ?, ?, ?)', [
        $request->nombre,
        $request->apellido,
        $request->email,
        $password,
        $rolId,
        $ejecutorId,
    ]);

    if (empty($result) || !isset($result[0]) || $result[0]->success != 1) {
        return ApiResponse::error(
            $result[0]->message ?? 'Error al crear usuario',
            'USER_CREATE_ERROR',
            422
        );
    }

    // Marcar que debe cambiar contraseña al primer login
    $usuarioId = json_decode($result[0]->data)->usuario_id;
DB::table('usuarios')
    ->where('id', $usuarioId)
    ->update([
        'must_change_password' => 1,
        'email_verified_at'    => now(),
    ]);

    $rol = DB::table('roles')->where('id', $rolId)->first();

    Bitacora::registrar(
        'usuarios',
        'crear',
        'Creó el usuario "' . $request->nombre . ' ' . $request->apellido . '" (' . $request->email . ') con rol "' . ($rol->nombre ?? 'ID ' . $rolId) . '"'
    );

    return ApiResponse::success(
        $result[0]->data,
        'Usuario creado correctamente',
        'USER_CREATED'
    );
}
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email'    => 'required|email',
            'rol'      => 'required|integer',
            'estado'   => 'required|boolean'
        ]);

        $usuario = DB::table('usuarios as u')
            ->leftJoin('usuarios_roles as ur', 'u.id', '=', 'ur.usuario_id')
            ->leftJoin('roles as r', 'r.id', '=', 'ur.rol_id')
            ->where('u.id', $id)
            ->select('u.id', 'u.nombre', 'u.apellido', 'r.id as rol_id', 'r.nombre as rol')
            ->first();

        if (!$usuario) {
            return ApiResponse::error(
                'Usuario no encontrado',
                'USER_NOT_FOUND',
                404
            );
        }

        if ($usuario->rol_id == 1 && $request->rol != 1) {
            $admins = DB::table('usuarios_roles')->where('rol_id', 1)->count();
            if ($admins <= 1) {
                return ApiResponse::error(
                    'No puede cambiar el rol del único administrador del sistema.',
                    'LAST_ADMIN_BLOCKED',
                    422
                );
            }
        }

        DB::table('usuarios')
            ->where('id', $id)
            ->update([
                'nombre'   => $request->nombre,
                'apellido' => $request->apellido,
                'email'    => $request->email,
                'estado'   => $request->estado
            ]);

        DB::table('usuarios_roles')->updateOrInsert(
            ['usuario_id' => $id],
            ['rol_id'     => $request->rol]
        );

        $rolNuevo = DB::table('roles')->where('id', $request->rol)->first();

        Bitacora::registrar(
            'usuarios',
            'actualizar',
            'Actualizó el usuario "' . $request->nombre . ' ' . $request->apellido . '" ID ' . $id . ' con rol "' . ($rolNuevo->nombre ?? 'ID ' . $request->rol) . '"'
        );

        return ApiResponse::success(
            null,
            'Usuario actualizado correctamente',
            'USER_UPDATED'
        );
    }

    public function deactivate(Request $request, $id)
    {
        $request->validate([
            'comentario' => 'required|string|max:255'
        ]);

        $usuarioAutenticado = auth()->user();

        if ($usuarioAutenticado->id == $id) {
            return ApiResponse::error(
                'No puede desactivar su propio usuario.',
                'USER_SELF_DEACTIVATE_FORBIDDEN',
                422
            );
        }

        $ejecutorId = $usuarioAutenticado->id;

        $usuario = DB::table('usuarios')->where('id', $id)->first();

        $result = DB::select('CALL usp_usuario_desactivar(?, ?)', [
            $id,
            $ejecutorId,
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al desactivar usuario',
                'USER_DEACTIVATE_ERROR',
                422
            );
        }

        Bitacora::registrar(
            'usuarios',
            'desactivar',
            'Desactivó al usuario "' . ($usuario->nombre ?? '') . ' ' . ($usuario->apellido ?? '') . '" ID ' . $id . ' — Motivo: ' . $request->comentario
        );

        return ApiResponse::success(
            null,
            'Usuario desactivado correctamente',
            'USER_DEACTIVATED'
        );
    }
}