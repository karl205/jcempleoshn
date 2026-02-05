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
        Schema::create('cache', function (Blueprint $table) {
            $table->string('clave')->primary();
            $table->mediumText('valor');
            $table->integer('expiracion');
        });

        Schema::create('bloqueos_cache', function (Blueprint $table) {
            $table->string('clave')->primary();
            $table->string('propietario');
            $table->integer('expiracion');
        });
    }

    /**
     * Revertir las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloqueos_cache');
        Schema::dropIfExists('cache');
    }
};
