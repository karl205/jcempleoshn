<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatPais extends Model
{
    protected $table = 'cat_paises';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = true;
}
