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
        Schema::create('perfiles_educacion', function (Blueprint $table) {
            $table->id();

            $table->foreignId('perfil_id')
                ->constrained('perfiles')
                ->cascadeOnDelete();

            $table->string('institucion', 150);

            $table->foreignId('nivel_educativo_id')
                ->constrained('cat_niveles_educativos');

            $table->string('area_estudio', 150)->nullable();
            $table->date('fecha_desde')->nullable();
            $table->date('fecha_hasta')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfiles_educacion');
    }
};
