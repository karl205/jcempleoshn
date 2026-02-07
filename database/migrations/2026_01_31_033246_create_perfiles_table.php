<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perfiles', function (Blueprint $table) {
            $table->id();

            // Usuario
            $table->foreignId('usuario_id')
                ->constrained('usuarios')
                ->cascadeOnDelete();

            // Catálogos
            $table->foreignId('pais_id')
                ->nullable()
                ->constrained('cat_paises');

            $table->foreignId('sexo_id')
                ->nullable()
                ->constrained('cat_sexos');

            $table->foreignId('nacionalidad_id')
                ->nullable()
                ->constrained('cat_nacionalidades');

            $table->foreignId('disponibilidad_vehicular_id')
                ->nullable()
                ->constrained('cat_disponibilidad_vehicular');

            // Datos personales
            $table->date('fecha_nacimiento')->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('foto')->nullable();
            $table->text('acerca_de_mi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfiles');
    }
};
