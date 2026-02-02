<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
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

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function educations()
    {
        return $this->hasMany(ProfileEducation::class);
    }

    public function languages()
    {
        return $this->hasMany(ProfileLanguage::class);
    }

    public function experiences()
    {
        return $this->hasMany(ProfileExperience::class);
    }
}
