<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilExperiencia extends Model
{
    protected $table = 'perfiles_experiencias';

    protected $fillable = [
        'perfil_id',
        'empresa',
        'pais_id',
        'cargo',
        'fecha_desde',
        'fecha_hasta',
        'descripcion',
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class);
    }

    public function pais()
    {
        return $this->belongsTo(CatPais::class, 'pais_id');
    }

    public function categoria()
    {
        return $this->belongsTo(
            CatCategorias::class,
            'categoria_id'
        );
    }

    public function actividad()
    {
        return $this->belongsTo(
            CatActividadLaboral::class,
            'actividad_id'
        );
    }
}
