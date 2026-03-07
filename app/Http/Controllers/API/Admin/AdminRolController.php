<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRolController extends Controller
{

    public function index()
    {

        $roles = DB::table('roles')
        ->select(
            'id',
            'nombre',
            'descripcion',
            'estado'
        )
        ->get();

        return ApiResponse::success(
            $roles,
            'Listado de roles',
            'ADMIN_ROLES_LIST'
        );

    }


    public function store(Request $request)
    {

        $request->validate([
            'nombre'=>'required|string|max:100',
            'descripcion'=>'nullable|string'
        ]);

        $id = DB::table('roles')->insertGetId([
            'nombre'=>$request->nombre,
            'descripcion'=>$request->descripcion,
            'estado'=>1,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);

        return ApiResponse::success(
            ['rol_id'=>$id],
            'Rol creado correctamente',
            'ROL_CREATED'
        );

    }


    public function update(Request $request,$id)
    {

        $request->validate([
            'nombre'=>'required|string|max:100',
            'descripcion'=>'nullable|string',
            'estado'=>'required|boolean'
        ]);

        DB::table('roles')
        ->where('id',$id)
        ->update([
            'nombre'=>$request->nombre,
            'descripcion'=>$request->descripcion,
            'estado'=>$request->estado,
            'updated_at'=>now()
        ]);

        return ApiResponse::success(
            null,
            'Rol actualizado correctamente',
            'ROL_UPDATED'
        );

    }


    public function deactivate($id)
    {

        DB::table('roles')
        ->where('id',$id)
        ->update([
            'estado'=>0,
            'updated_at'=>now()
        ]);

        return ApiResponse::success(
            null,
            'Rol desactivado correctamente',
            'ROL_DEACTIVATED'
        );

    }

}