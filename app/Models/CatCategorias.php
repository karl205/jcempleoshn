<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class catCategorias extends Model
{
    protected $table = 'cat_categorias_laborales';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = true;
}
