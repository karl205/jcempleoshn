<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfiles';

    protected $fillable = [
        'usuario_id',
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'telefono',
        'sexo_id',
        'nacionalidad_id',
        'disponibilidad_vehicular_id',
        'acerca_de_mi',
        'foto',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function educaciones()
    {
        return $this->hasMany(PerfilEducacion::class);
    }

    public function idiomas()
    {
        return $this->hasMany(PerfilIdioma::class);
    }

    public function experiencias()
    {
        return $this->hasMany(PerfilExperiencia::class);
    }
}
