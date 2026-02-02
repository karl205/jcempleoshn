<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
    
            $table->foreignId('user_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();
    
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->date('fecha_nacimiento')->nullable();
            $table->string('telefono', 20)->nullable();
    
            $table->foreignId('sexo_id')->nullable()
                ->constrained('cat_sexos');
    
            $table->foreignId('nacionalidad_id')->nullable()
                ->constrained('cat_nacionalidades');
    
            $table->foreignId('disponibilidad_vehicular_id')->nullable()
                ->constrained('cat_disponibilidad_vehicular');
    
            $table->text('acerca_de_mi')->nullable();
            $table->string('foto')->nullable();
    
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('profiles');
    }

};
