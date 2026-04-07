<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;

    protected $table = 'postulaciones';

    protected $fillable = [
        'usuario_id',
        'plaza_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function plaza()
    {
        return $this->belongsTo(Plaza::class);
    }

    // public function plaza()
    // {
    //     return $this->belongsTo(Plaza::class, 'plaza_id');
    // }
}