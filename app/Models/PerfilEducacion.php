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
        'area_estudio',
        'fecha_desde',
        'fecha_hasta',
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class);
    }
}
