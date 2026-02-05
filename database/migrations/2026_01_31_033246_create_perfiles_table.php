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

            // Relación 1 a 1 con usuarios
            $table->foreignId('usuario_id')
                ->constrained('usuarios')
                ->cascadeOnDelete();

            // Ubicación / residencia
            $table->foreignId('pais_id')
                ->nullable()
                ->constrained('paises');

            // Datos personales extendidos
            $table->date('fecha_nacimiento')->nullable();
            $table->string('telefono', 20)->nullable();

            $table->foreignId('sexo_id')
                ->nullable()
                ->constrained('sexos');

            $table->foreignId('nacionalidad_id')
                ->nullable()
                ->constrained('nacionalidades');

            // Información adicional
            $table->string('foto')->nullable();
            $table->text('acerca_de_mi')->nullable();

            // Empleabilidad
            $table->foreignId('disponibilidad_vehicular_id')
                ->nullable()
                ->constrained('disponibilidades_vehiculares');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfiles');
    }
};
