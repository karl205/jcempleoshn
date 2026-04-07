<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilEducacion extends Model
{
    protected $table = 'perfiles_educacion';

    protected $fillable = [
        'perfil_id',
        'institucion',
        'nivel_educativo_id',
        'area_estudio_id',
        'fecha_desde',
        'fecha_hasta',
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class);
    }

    public function nivelEducativo()
    {
        return $this->belongsTo(
            CatNivelEducativo::class,
            'nivel_educativo_id'
        );
    }

    public function areaEstudio()
    {
        return $this->belongsTo(
            CatAreasEstudio::class,
            'area_estudio_id'
        );
    }
}
