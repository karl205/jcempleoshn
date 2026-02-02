<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileExperience extends Model
{
    protected $table = 'profile_experiences';

    protected $fillable = [
        'profile_id',
        'empresa',
        'pais_id',
        'cargo',
        'fecha_desde',
        'fecha_hasta',
        'descripcion',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
