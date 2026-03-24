<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\PlazaService;
use App\Support\ApiResponse;

class PublicPlazaController extends Controller
{
    protected $service;

    public function __construct(PlazaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->listarActivas(); 

        return ApiResponse::success(
            $data,
            'Listado de plazas públicas',
            'PLAZAS_PUBLIC_LIST'
        );
    }

    public function show($id)
    {
        $data = $this->service->obtener($id);

        if (!$data || $data->estado != 1) {
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

    public function ultimas()
    {
        $data = $this->service->ultimasPublicadas(3);
    
        return ApiResponse::success(
            $data,
            'Últimas plazas publicadas',
            'PLAZAS_LATEST'
        );
    }
}