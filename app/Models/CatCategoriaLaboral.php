<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaLaboral extends Model
{
    protected $table = 'cat_categorias_laborales';

    protected $fillable = [
        'nombre',
        'estado',
    ];
}