<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar las migraciones.
     */
    public function up(): void
    {
        Schema::create('perfiles_idiomas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('perfil_id')
                ->constrained('perfiles')
                ->cascadeOnDelete();

            $table->foreignId('idioma_id')
                ->nullable()
                ->constrained('cat_idiomas');

            $table->foreignId('nivel_id')
                ->nullable()
                ->constrained('cat_niveles_idioma');

            $table->unique(['perfil_id', 'idioma_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfiles_idiomas');
    }
};
