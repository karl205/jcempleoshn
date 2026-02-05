<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatNacionalidad extends Model
{
    protected $table = 'cat_nacionalidades';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = true;
}
