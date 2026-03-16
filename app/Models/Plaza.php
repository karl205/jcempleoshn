<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plaza extends Model
{
    protected $table = 'plazas';

    protected $fillable = [
        'usuario_id',
        'ciudad_id',
        'categoria_laboral_id',
        'cargo_id',
        'actividad_laboral_id',
        'nivel_educativo_id',
        'sexo_id',
        'titulo',
        'descripcion',
        'requisitos',
        'beneficios',
        'tipo_contratacion',
        'experiencia_minima',
        'edad_minima',
        'edad_maxima',
        'salario_min',
        'salario_max',
        'fecha_cierre',
        'estado'
    ];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function cargo()
    {
        return $this->belongsTo(CargoLaboral::class,'cargo_id');
    }

    public function categoria()
    {
        return $this->belongsTo(CategoriaLaboral::class,'categoria_laboral_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}