<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPostulacionesController extends Controller
{
    public function index()
    {
        // Simulación de plazas activas
        $plazas = [
            ['id' => 1, 'cargo' => 'Programador Web', 'ciudad' => 'Tegucigalpa'],
            ['id' => 2, 'cargo' => 'Diseñador Gráfico', 'ciudad' => 'San Pedro Sula'],
        ];
    
        return view('admin.postulaciones.plazas', compact('plazas'));
    }
    public function ver($id)
    {
        // Simulación de la plaza
        $plaza = [
            'id' => $id,
            'cargo' => $id == 1 ? 'Programador Web' : 'Diseñador Gráfico',
            'ciudad' => $id == 1 ? 'Tegucigalpa' : 'San Pedro Sula'
        ];
    
        // Simulación de postulantes
        $postulantes = [
            ['id' => 1, 'nombre' => 'Carlos Martínez', 'ciudad' => 'Tegucigalpa', 'fecha' => '2025-08-01', 'estado' => 'Nuevo'],
            ['id' => 2, 'nombre' => 'Ana Gómez', 'ciudad' => 'San Pedro Sula', 'fecha' => '2025-07-30', 'estado' => 'Revisado'],
        ];
    
        return view('admin.postulaciones.ver', compact('plaza', 'postulantes'));
    }
}
