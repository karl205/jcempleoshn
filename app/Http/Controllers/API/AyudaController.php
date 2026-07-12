<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\AyudaService;
use App\Support\ApiResponse;

class AyudaController extends Controller
{
    protected $service;

    public function __construct(AyudaService $service)
    {
        $this->service = $service;
    }

    // GET /ayuda-items  -> items activos de la sección pública
    public function publico()
    {
        $data = $this->service->listarActivosPorSeccion('publico');

        return ApiResponse::success(
            $data,
            'Listado de ayuda pública',
            'AYUDA_PUBLICA_LIST'
        );
    }

    // GET /ayuda-items/{id}/ver
    public function ver($id)
    {
        $item = $this->service->obtenerActivoPorSeccion($id, 'publico');

        if (!$item) {
            abort(404);
        }

        $path = storage_path("app/ayuda/{$item->archivo}");

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    // GET /ayuda-items/{id}/descargar
    public function descargar($id)
    {
        $item = $this->service->obtenerActivoPorSeccion($id, 'publico');

        if (!$item) {
            abort(404);
        }

        $path = storage_path("app/ayuda/{$item->archivo}");

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path, $item->titulo . '.pdf');
    }
}