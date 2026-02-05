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
            // PERFIL (tabla perfiles)
            'pais_id' => 'nullable|exists:cat_paises,id',
            'fecha_nacimiento' => 'nullable|date',
            'telefono' => 'nullable|string|max:20',
            'sexo_id' => 'nullable|exists:cat_sexos,id',
            'nacionalidad_id' => 'nullable|exists:cat_nacionalidades,id',
            'disponibilidad_vehicular_id' => 'nullable|exists:cat_disponibilidad_vehicular,id',
            'acerca_de_mi' => 'nullable|string',

            // EDUCACIÓN
            'educations' => 'array',
            'educations.*.institucion' => 'required|string|max:150',
            'educations.*.nivel_educativo_id' => 'required|exists:cat_niveles_educativos,id',
            'educations.*.area_estudio' => 'nullable|string|max:150',
            'educations.*.fecha_desde' => 'nullable|date',
            'educations.*.fecha_hasta' => 'nullable|date',

            // IDIOMAS
            'languages' => 'array',
            'languages.*.idioma_id' => 'required|exists:cat_idiomas,id',
            'languages.*.nivel_id' => 'required|exists:cat_niveles_idioma,id',

            // EXPERIENCIA
            'experiences' => 'array',
            'experiences.*.empresa' => 'required|string|max:150',
            'experiences.*.pais_id' => 'nullable|exists:cat_paises,id',
            'experiences.*.cargo' => 'required|string|max:150',
            'experiences.*.fecha_desde' => 'nullable|date',
            'experiences.*.fecha_hasta' => 'nullable|date',
            'experiences.*.descripcion' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $usuario) {

            $perfil = $usuario->perfil()->updateOrCreate(
                ['usuario_id' => $usuario->id],
                collect($validated)->only([
                    'pais_id',
                    'fecha_nacimiento',
                    'telefono',
                    'sexo_id',
                    'nacionalidad_id',
                    'disponibilidad_vehicular_id',
                    'acerca_de_mi',
                ])->toArray()
            );

            // Limpiar hijos
            $perfil->educaciones()->delete();
            $perfil->idiomas()->delete();
            $perfil->experiencias()->delete();

            // EDUCACIÓN
            foreach (array_values($validated['educations'] ?? []) as $edu) {
                $perfil->educaciones()->create($edu);
            }

            // IDIOMAS
            foreach (array_values($validated['languages'] ?? []) as $lang) {
                $perfil->idiomas()->create($lang);
            }

            // EXPERIENCIA
            foreach (array_values($validated['experiences'] ?? []) as $exp) {
                $perfil->experiencias()->create($exp);
            }
        });

        return redirect()
            ->route('perfil.index')
            ->with('success', 'Perfil guardado correctamente');
    }
}
