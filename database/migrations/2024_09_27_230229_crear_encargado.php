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
        Schema::create('encargados', function (Blueprint $table) {
            $table->bigInteger('cui')-> primary(); 
            $table->bigInteger('paciente_cui'); 
            $table->foreign('paciente_cui')->references('cui')->on('pacientes')->onDelete('cascade'); // Relación con 'pacientes'
            $table->string('nombreEsposo');
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->string('pueblos');
            $table->string('Escolaridad')->nullable();
            $table->string('Ocupacion')->nullable();
            $table->string('estado_civil')->nullable();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('encargados');
    }
};
