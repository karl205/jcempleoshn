<?php

namespace App\Http\Controllers;

use App\Models\Postulacion;
use Illuminate\Http\Request;

class PostulacionController extends Controller
{
    public function index()
    {
        $usuarioId = auth()->id();

        $postulaciones = Postulacion::with('plaza')
            ->where('usuario_id', $usuarioId)
            ->get();

        return view('user.postulaciones', compact('postulaciones'));
    }
}
