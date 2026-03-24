<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\PlazaService;
use App\Support\ApiResponse;
use Illuminate\Http\Request;

class PlazaController extends Controller
{
    protected $service;

    public function __construct(PlazaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->listar();

        return ApiResponse::success(
            $data,
            'Listado de plazas',
            'PLAZAS_LIST'
        );
    }

    public function show($id)
    {
        $data = $this->service->obtener($id);

        if (! $data) {
            return ApiResponse::error(
                'Plaza no encontrada',
                'PLAZA_NOT_FOUND',
                404
            );
        }

        return ApiResponse::success(
            $data,
            'Detalle de plaza',
            'PLAZA_DETAIL'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'requisitos' => 'nullable|string',
            'beneficios' => 'nullable|string',
            'cargo_id' => 'required|integer',
            'categoria_id' => 'required|integer',
            'actividad_id' => 'required|integer',
            'ciudad_id' => 'required|integer',
            'tipo_contratacion' => 'required|string',
            'nivel_educativo_id' => 'required|integer',
            'sexo_id' => 'required|integer',
            'experiencia_minima' => 'nullable|integer',
            'edad_minima' => 'nullable|integer',
            'edad_maxima' => 'nullable|integer',
            'salario_min' => 'nullable|numeric',
            'salario_max' => 'nullable|numeric',
            'fecha_cierre' => 'required|date',
        ]);

        $usuarioId = auth()->user()->id;

        $this->service->crear(
            $request->all(),
            $usuarioId
        );

        return ApiResponse::success(
            null,
            'Plaza creada correctamente',
            'PLAZA_CREATED'
        );
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'requisitos' => 'nullable|string',
            'beneficios' => 'nullable|string',
            'cargo_id' => 'required|integer',
            'categoria_id' => 'required|integer',
            'actividad_id' => 'required|integer',
            'ciudad_id' => 'required|integer',
            'tipo_contratacion' => 'required|string',
            'nivel_educativo_id' => 'required|integer',
            'sexo_id' => 'required|integer',
            'experiencia_minima' => 'nullable|integer',
            'edad_minima' => 'nullable|integer',
            'edad_maxima' => 'nullable|integer',
            'salario_min' => 'nullable|numeric',
            'salario_max' => 'nullable|numeric',
            'fecha_cierre' => 'required|date'
        ]);

        $this->service->actualizar($id, $request->all());

        return ApiResponse::success(
            null,
            'Plaza actualizada correctamente',
            'PLAZA_UPDATED'
        );

    }

    public function cerrar($id)
    {

        $this->service->cerrar($id);

        return ApiResponse::success(
            null,
            'Plaza cerrada correctamente',
            'PLAZA_CLOSED'
        );

    }

    // public function ultimas()
    // {
    //     $data = $this->service->ultimasPublicadas(3);
    
    //     return ApiResponse::success(
    //         $data,
    //         'Últimas plazas publicadas',
    //         'PLAZAS_LATEST'
    //     );
    // }
}
