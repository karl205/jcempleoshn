<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilIdioma extends Model
{
    protected $table = 'perfiles_idiomas';

    protected $fillable = [
        'perfil_id',
        'idioma_id',
        'nivel_id',
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class);
    }

    public function idioma()
    {
        return $this->belongsTo(CatIdioma::class, 'idioma_id');
    }

    public function nivel()
    {
        return $this->belongsTo(CatNivelIdioma::class, 'nivel_id');
    }
}
