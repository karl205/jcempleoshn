<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatNivelIdioma extends Model
{
    protected $table = 'cat_niveles_idioma';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = true;
}
