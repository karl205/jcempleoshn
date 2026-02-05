<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatIdioma extends Model
{
    protected $table = 'cat_idiomas';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = true;
}
