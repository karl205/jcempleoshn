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
        Schema::create('perfiles_experiencias', function (Blueprint $table) {
            $table->id();

            $table->foreignId('perfil_id')
                ->constrained('perfiles')
                ->cascadeOnDelete();

            $table->string('empresa', 150);

            $table->foreignId('pais_id')
                ->constrained('cat_paises');

            $table->string('cargo', 150);
            $table->date('fecha_desde')->nullable();
            $table->date('fecha_hasta')->nullable();
            $table->text('descripcion')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfiles_experiencias');
    }
};
