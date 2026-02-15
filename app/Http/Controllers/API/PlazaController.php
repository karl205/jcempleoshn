<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\PlazaService;
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
        return response()->json($this->service->listar());
    }

    public function show($id)
    {
        return response()->json($this->service->obtener($id));
    }

    public function store(Request $request)
    {
        $this->service->crear($request->all());
        return response()->json(['message' => 'Plaza creada']);
    }
}
