<?php

namespace App\Http\Controllers;

use App\Models\CatDisponibilidadVehicular;
use App\Models\CatIdioma;
use App\Models\CatNacionalidad;
use App\Models\CatNivelEducativo;
use App\Models\CatNivelIdioma;
use App\Models\CatPais;
use App\Models\CatSexo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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

        // LIMPIAR ARRAYS DINÁMICOS
        $request->merge([
            'educations' => collect($request->educations ?? [])
                ->filter(fn ($e) => collect($e)->filter()->isNotEmpty())
                ->values()
                ->toArray(),

            'languages' => collect($request->languages ?? [])
                ->filter(fn ($l) => collect($l)->filter()->isNotEmpty())
                ->values()
                ->toArray(),

            'experiences' => collect($request->experiences ?? [])
                ->filter(fn ($e) => collect($e)->filter()->isNotEmpty())
                ->values()
                ->toArray(),
        ]);

        // VALIDACIÓN
        $validated = $request->validate([
            'pais_id' => 'nullable|exists:cat_paises,id',
            'fecha_nacimiento' => 'nullable|date',
            'telefono' => 'nullable|string|max:20',
            'sexo_id' => 'nullable|exists:cat_sexos,id',
            'nacionalidad_id' => 'nullable|exists:cat_nacionalidades,id',
            'disponibilidad_vehicular_id' => 'nullable|exists:cat_disponibilidad_vehicular,id',
            'acerca_de_mi' => 'nullable|string',
            'foto' => 'nullable|file|max:5120',

            'educations' => 'nullable|array',
            'educations.*.institucion' => 'required|string|max:150',
            'educations.*.nivel_educativo_id' => 'required|exists:cat_niveles_educativos,id',

            'languages' => 'nullable|array',
            'languages.*.idioma_id' => 'required|exists:cat_idiomas,id',
            'languages.*.nivel_id' => 'required|exists:cat_niveles_idioma,id',

            'experiences' => 'nullable|array',
            'experiences.*.empresa' => 'required|string|max:150',
            'experiences.*.cargo' => 'required|string|max:150',
        ]);

        DB::transaction(function () use ($validated, $usuario, $request) {

            // 1️⃣ Asegurar que el perfil exista
            $perfil = $usuario->perfil()->firstOrCreate(
                ['usuario_id' => $usuario->id]
            );

            // 2️⃣ Datos del perfil
            $dataPerfil = collect($validated)->only([
                'pais_id',
                'fecha_nacimiento',
                'telefono',
                'sexo_id',
                'nacionalidad_id',
                'disponibilidad_vehicular_id',
                'acerca_de_mi',
            ])->toArray();

            // 3️⃣ FOTO DE PERFIL
            if ($request->hasFile('foto')) {

                if ($perfil->foto &&
                    Storage::disk('public')->exists('fotos_perfil/'.$perfil->foto)) {
                    Storage::disk('public')->delete('fotos_perfil/'.$perfil->foto);
                }

                $extension = $request->file('foto')->guessExtension();
                $nombreFoto = 'perfil_'.$usuario->id.'_'.time().'.'.$extension;

                $ruta = storage_path('app/public/fotos_perfil/'.$nombreFoto);
                $manager = new ImageManager(new Driver());
                $image = $manager->read($request->file('foto'));
                $image->cover(400, 400);       // 👈 cuadrado perfecto
                $image->save($ruta, quality: 85);

                $dataPerfil['foto'] = $nombreFoto;
            }

            // 🔥 4️⃣ AQUÍ estaba el error: guardar en BD
            $perfil->update($dataPerfil);

            // 5️⃣ RELACIONES
            if (!empty($validated['educations'])) {
                $perfil->educaciones()->delete();
                foreach ($validated['educations'] as $edu) {
                    $perfil->educaciones()->create($edu);
                }
            }

            if (!empty($validated['languages'])) {
                $perfil->idiomas()->delete();
                foreach ($validated['languages'] as $lang) {
                    $perfil->idiomas()->create($lang);
                }
            }

            if (!empty($validated['experiences'])) {
                $perfil->experiencias()->delete();
                foreach ($validated['experiences'] as $exp) {
                    $perfil->experiencias()->create($exp);
                }
            }
        });

        return redirect()
            ->route('perfil.index')
            ->with('success', 'Perfil guardado correctamente');
    }
}
