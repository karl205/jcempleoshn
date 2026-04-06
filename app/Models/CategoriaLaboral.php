<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaLaboral extends Model
{
    protected $table = 'cat_actividades_laborales';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = true;
}
