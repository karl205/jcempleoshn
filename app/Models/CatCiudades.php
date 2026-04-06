<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class catCiudades extends Model
{
    protected $table = 'cat_ciudades';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = true;
}
