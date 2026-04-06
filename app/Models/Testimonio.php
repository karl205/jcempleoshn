<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario; 

class Testimonio extends Model
{
    protected $table = 'testimonios';

    protected $fillable = [
        'usuario_id',
        'comentario',
        'calificacion',
        'aprobado',
        'destacado',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}