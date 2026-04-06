<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class catDepartamentos extends Model
{
    protected $table = 'cat_departamentos';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = true;
}
