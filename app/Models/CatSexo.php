<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatSexo extends Model
{
    protected $table = 'cat_sexos';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = true;
}
