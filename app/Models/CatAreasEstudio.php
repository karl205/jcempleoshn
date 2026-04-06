<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class catAreasEstudio extends Model
{
    protected $table = 'cat_areas_estudio';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = true;
}
