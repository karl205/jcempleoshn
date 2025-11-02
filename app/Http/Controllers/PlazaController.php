<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlazaController extends Controller
{
    public function show($id)
    {
        // Por ahora solo retorna una vista de prueba
        return view('user.plazas.show');
    }
}


