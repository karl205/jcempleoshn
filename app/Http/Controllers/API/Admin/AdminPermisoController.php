<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Support\ApiResponse;
use App\Support\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

class AdminPermisoController extends Controller
{
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

    public function asignarPermisos(Request $request, $id)
    {
        $request->validate([
            'permisos' => 'required|array',
        ]);

        $rol = DB::table('roles')->where('id', $id)->first();

        DB::table('roles_permisos')
            ->where('rol_id', $id)
            ->delete();

        foreach ($request->permisos as $permiso) {

            $permisoId = DB::table('permisos')
                ->where('nombre', $permiso)
                ->value('id');

            if ($permisoId) {
                DB::table('roles_permisos')->insert([
                    'rol_id'     => $id,
                    'permiso_id' => $permisoId,
                ]);
            }
        }

        Bitacora::registrar(
            'permisos',
            'asignar',
            'Asignó ' . count($request->permisos) . ' permisos al rol "' . ($rol->nombre ?? 'ID ' . $id) . '"'
        );

        return ApiResponse::success(
            null,
            'Permisos actualizados',
            'ROLE_PERMISSIONS_UPDATED'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:100|unique:permisos,nombre',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $id = DB::table('permisos')->insertGetId([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        Bitacora::registrar(
            'permisos',
            'crear',
            'Creó el permiso "' . $request->nombre . '" ID ' . $id
        );

        return ApiResponse::success(
            ['permiso_id' => $id],
            'Permiso creado correctamente',
            'PERMISSION_CREATED'
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'      => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);

        DB::table('permisos')
            ->where('id', $id)
            ->update([
                'nombre'      => $request->nombre,
                'descripcion' => $request->descripcion,
                'updated_at'  => now(),
            ]);

        Bitacora::registrar(
            'permisos',
            'actualizar',
            'Actualizó el permiso "' . $request->nombre . '" ID ' . $id
        );

        return ApiResponse::success(
            null,
            'Permiso actualizado',
            'PERMISSION_UPDATED'
        );
    }

    public function deactivate($id)
    {
        $permiso = DB::table('permisos')->where('id', $id)->first();

        DB::table('permisos')
            ->where('id', $id)
            ->delete();

        Bitacora::registrar(
            'permisos',
            'eliminar',
            'Eliminó el permiso "' . ($permiso->nombre ?? 'ID ' . $id) . '"'
        );

        return ApiResponse::success(
            null,
            'Permiso eliminado',
            'PERMISSION_DELETED'
        );
    }

    public function permisosRoles()
    {
        $roles = DB::table('roles')->select('id', 'nombre')->get();

        $permisos = DB::table('permisos')->select('id', 'nombre')->get();

        $rolesPermisos = DB::table('roles_permisos')->get();

        $data = [];

        foreach ($roles as $rol) {
            foreach ($permisos as $permiso) {

                $activo = $rolesPermisos
                    ->where('rol_id', $rol->id)
                    ->where('permiso_id', $permiso->id)
                    ->count() > 0;

                $data[] = [
                    'rol_id'     => $rol->id,
                    'rol'        => $rol->nombre,
                    'permiso_id' => $permiso->id,
                    'permiso'    => $permiso->nombre,
                    'modulo'     => explode('.', $permiso->nombre)[0] ?? '',
                    'activo'     => $activo ? 1 : 0,
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
            'rol_id'     => 'required|integer',
            'permiso_id' => 'required|integer',
            'activo'     => 'required|boolean',
        ]);

        $rol     = DB::table('roles')->where('id', $request->rol_id)->first();
        $permiso = DB::table('permisos')->where('id', $request->permiso_id)->first();

        if ($request->activo) {

            DB::table('roles_permisos')->insertOrIgnore([
                'rol_id'     => $request->rol_id,
                'permiso_id' => $request->permiso_id,
            ]);

            Bitacora::registrar(
                'permisos',
                'asignar',
                'Asignó el permiso "' . ($permiso->nombre ?? 'ID ' . $request->permiso_id) . '" al rol "' . ($rol->nombre ?? 'ID ' . $request->rol_id) . '"'
            );

        } else {

            DB::table('roles_permisos')
                ->where('rol_id', $request->rol_id)
                ->where('permiso_id', $request->permiso_id)
                ->delete();

            Bitacora::registrar(
                'permisos',
                'quitar',
                'Quitó el permiso "' . ($permiso->nombre ?? 'ID ' . $request->permiso_id) . '" del rol "' . ($rol->nombre ?? 'ID ' . $request->rol_id) . '"'
            );

        }

        return ApiResponse::success(
            null,
            'Permiso actualizado',
            'PERMISSION_ROLE_UPDATED'
        );
    }
}