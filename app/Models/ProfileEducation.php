<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileEducation extends Model
{
    protected $table = 'profile_educations';

    protected $fillable = [
        'profile_id',
        'institucion',
        'nivel_educativo_id',
        'area_estudio',
        'fecha_desde',
        'fecha_hasta',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
