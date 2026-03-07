<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

class AdminPermisoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/admin/permisos",
     *     summary="Listado de permisos",
     *     tags={"Admin Permisos"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(response=200, description="Listado de permisos")
     * )
     */
    public function index()
    {
        $permisos = DB::table('permisos')
            ->select('id', 'nombre', 'descripcion')
            ->get();

        return ApiResponse::success(
            $permisos,
            'Listado de permisos',
            'PERMISSIONS_LIST'
        );
    }

    /**
     * Obtener permisos de un rol
     */
    public function permisosRol($id)
    {
        $permisos = DB::table('roles_permisos as rp')
            ->join('permisos as p', 'p.id', '=', 'rp.permiso_id')
            ->where('rp.rol_id', $id)
            ->pluck('p.nombre');

        return ApiResponse::success(
            $permisos,
            'Permisos del rol',
            'ROLE_PERMISSIONS'
        );
    }

    /**
     * Asignar permisos a rol
     */
    public function asignarPermisos(Request $request, $id)
    {
        $request->validate([
            'permisos' => 'required|array',
        ]);

        DB::table('roles_permisos')
            ->where('rol_id', $id)
            ->delete();

        foreach ($request->permisos as $permiso) {

            $permisoId = DB::table('permisos')
                ->where('nombre', $permiso)
                ->value('id');

            if ($permisoId) {
                DB::table('roles_permisos')->insert([
                    'rol_id' => $id,
                    'permiso_id' => $permisoId,
                ]);
            }
        }

        return ApiResponse::success(
            null,
            'Permisos actualizados',
            'ROLE_PERMISSIONS_UPDATED'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:permisos,nombre',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $id = DB::table('permisos')->insertGetId([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return ApiResponse::success(
            ['permiso_id' => $id],
            'Permiso creado correctamente',
            'PERMISSION_CREATED'
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);

        DB::table('permisos')
            ->where('id', $id)
            ->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'updated_at' => now(),
            ]);

        return ApiResponse::success(
            null,
            'Permiso actualizado',
            'PERMISSION_UPDATED'
        );
    }

    public function deactivate($id)
    {
        DB::table('permisos')
            ->where('id', $id)
            ->delete();

        return ApiResponse::success(
            null,
            'Permiso eliminado',
            'PERMISSION_DELETED'
        );
    }

    /*
|--------------------------------------------------------------------------
| MATRIZ PERMISOS POR ROL
|--------------------------------------------------------------------------
*/

    public function permisosRoles()
    {

        $roles = DB::table('roles')
            ->select('id', 'nombre')
            ->get();

        $permisos = DB::table('permisos')
            ->select('id', 'nombre')
            ->get();

        $rolesPermisos = DB::table('roles_permisos')->get();

        $data = [];

        foreach ($roles as $rol) {

            foreach ($permisos as $permiso) {

                $activo = $rolesPermisos
                    ->where('rol_id', $rol->id)
                    ->where('permiso_id', $permiso->id)
                    ->count() > 0;

                $data[] = [
                    'rol_id' => $rol->id,
                    'rol' => $rol->nombre,
                    'permiso_id' => $permiso->id,
                    'permiso' => $permiso->nombre,
                    'modulo' => explode('.', $permiso->nombre)[0] ?? '',
                    'activo' => $activo ? 1 : 0,
                ];
            }

        }

        return ApiResponse::success(
            $data,
            'Matriz de permisos',
            'PERMISSIONS_MATRIX'
        );

    }

    public function guardarPermisoRol(Request $request)
    {

        $request->validate([
            'rol_id' => 'required|integer',
            'permiso_id' => 'required|integer',
            'activo' => 'required|boolean',
        ]);

        if ($request->activo) {

            DB::table('roles_permisos')->insertOrIgnore([
                'rol_id' => $request->rol_id,
                'permiso_id' => $request->permiso_id,
            ]);

        } else {

            DB::table('roles_permisos')
                ->where('rol_id', $request->rol_id)
                ->where('permiso_id', $request->permiso_id)
                ->delete();

        }

        return ApiResponse::success(
            null,
            'Permiso actualizado',
            'PERMISSION_ROLE_UPDATED'
        );

    }
}
