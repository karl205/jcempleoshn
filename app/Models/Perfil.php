<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfiles';

    protected $fillable = [
        'usuario_id',
        'pais_id',
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

    public function pais()
    {
        return $this->belongsTo(CatPais::class, 'pais_id');
    }

    public function sexo()
    {
        return $this->belongsTo(CatSexo::class, 'sexo_id');
    }

    public function nacionalidad()
    {
        return $this->belongsTo(CatNacionalidad::class, 'nacionalidad_id');
    }

    public function disponibilidadVehicular()
    {
        return $this->belongsTo(
            CatDisponibilidadVehicular::class,
            'disponibilidad_vehicular_id'
        );
    }
}
