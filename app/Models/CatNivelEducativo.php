<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatNivelEducativo extends Model
{
    protected $table = 'cat_niveles_educativos';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = true;
}
