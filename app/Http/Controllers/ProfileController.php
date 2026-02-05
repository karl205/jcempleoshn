<?php

namespace App\Http\Controllers;

use App\Models\CatDisponibilidadVehicular;
use App\Models\CatIdioma;
use App\Models\CatNacionalidad;
use App\Models\CatNivelEducativo;
use App\Models\CatNivelIdioma;
use App\Models\CatPais;
use App\Models\CatSexo;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $usuario = auth()->user();

        $perfil = $usuario->perfil()
            ->with(['educaciones', 'idiomas', 'experiencias'])
            ->first();

        return view('perfil.index', [
            'perfil' => $perfil,
            'sexos' => CatSexo::all(),
            'niveles' => CatNivelEducativo::all(),
            'idiomasCat' => CatIdioma::all(),
            'nivelesIdioma' => CatNivelIdioma::all(),
            'paises' => CatPais::all(),
            'nacionalidades' => CatNacionalidad::all(),
            'vehiculos' => CatDisponibilidadVehicular::all(),
        ]);
    }

    public function store(Request $request)
    {
        $usuario = auth()->user();

        $validated = $request->validate([
            // Perfil
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'fecha_nacimiento' => 'nullable|date',
            'telefono' => 'nullable|string|max:20',
            'sexo_id' => 'nullable|exists:cat_sexos,id',
            'nacionalidad_id' => 'nullable|exists:cat_nacionalidades,id',
            'disponibilidad_vehicular_id' => 'nullable|exists:cat_disponibilidad_vehicular,id',
            'acerca_de_mi' => 'nullable|string',

            // Educaciones
            'educaciones' => 'array',
            'educaciones.*.institucion' => 'required|string|max:150',
            'educaciones.*.nivel_educativo_id' => 'required|exists:cat_niveles_educativos,id',
            'educaciones.*.area_estudio' => 'nullable|string|max:150',
            'educaciones.*.fecha_desde' => 'nullable|date',
            'educaciones.*.fecha_hasta' => 'nullable|date',

            // Idiomas
            'idiomas' => 'array',
            'idiomas.*.idioma_id' => 'required|exists:cat_idiomas,id',
            'idiomas.*.nivel_id' => 'required|exists:cat_niveles_idioma,id',

            // Experiencias
            'experiencias' => 'array',
            'experiencias.*.empresa' => 'required|string|max:150',
            'experiencias.*.pais_id' => 'required|exists:cat_paises,id',
            'experiencias.*.cargo' => 'required|string|max:150',
            'experiencias.*.fecha_desde' => 'nullable|date',
            'experiencias.*.fecha_hasta' => 'nullable|date',
            'experiencias.*.descripcion' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $usuario) {

            $perfil = $usuario->perfil()->updateOrCreate(
                ['usuario_id' => $usuario->id],
                collect($validated)->only([
                    'nombres',
                    'apellidos',
                    'fecha_nacimiento',
                    'telefono',
                    'sexo_id',
                    'nacionalidad_id',
                    'disponibilidad_vehicular_id',
                    'acerca_de_mi',
                ])->toArray()
            );

            $perfil->educaciones()->delete();
            $perfil->idiomas()->delete();
            $perfil->experiencias()->delete();

            foreach ($validated['educaciones'] ?? [] as $edu) {
                $perfil->educaciones()->create($edu);
            }

            foreach ($validated['idiomas'] ?? [] as $idioma) {
                $perfil->idiomas()->create($idioma);
            }

            foreach ($validated['experiencias'] ?? [] as $exp) {
                $perfil->experiencias()->create($exp);
            }
        });

        return redirect()
            ->route('perfil.index')
            ->with('success', 'Perfil guardado correctamente');
    }
}
