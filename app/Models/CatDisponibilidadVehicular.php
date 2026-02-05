<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatDisponibilidadVehicular extends Model
{
    protected $table = 'cat_disponibilidad_vehicular';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = true;
}
