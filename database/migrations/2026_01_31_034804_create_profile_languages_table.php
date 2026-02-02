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
        Schema::create('profile_languages', function (Blueprint $table) {
            $table->id();
    
            $table->foreignId('profile_id')
                ->constrained()
                ->cascadeOnDelete();
    
            $table->foreignId('idioma_id')
                ->constrained('cat_idiomas');
    
            $table->foreignId('nivel_id')
                ->constrained('cat_nivel_idioma');
    
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('profile_languages');
    }

};
