<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileLanguage extends Model
{
    protected $table = 'profile_languages';

    protected $fillable = [
        'profile_id',
        'idioma_id',
        'nivel_id',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
