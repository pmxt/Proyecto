<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->bigInteger('cui')-> primary(); 
             $table->string('name'); 
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->string('migrante');
            $table->string('pueblos');
            $table->string('Escolaridad')->nullable();
            $table->string('Ocupacion')->nullable();
            $table->string('distancia')->nullable();
            $table->string('tiempo')->nullable();
            $table->string('comunidad')->nullable();
            $table->string('telefono')->nullable();   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
