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
        Schema::create('profile_experiences', function (Blueprint $table) {
            $table->id();
    
            $table->foreignId('profile_id')
                ->constrained()
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
    
    public function down()
    {
        Schema::dropIfExists('profile_experiences');
    }

};
