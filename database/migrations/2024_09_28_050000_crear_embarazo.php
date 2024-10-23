<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('embarazo', function (Blueprint $table) {
            $table->id();  
            $table->bigInteger('paciente_cui'); 
            $table->foreign('paciente_cui')->references('cui')->on('pacientes')->onDelete('cascade'); 
            $table->date('fecha_ultima_regla');
            $table->date('fecha_probable_parto');           
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('embarazo');
    }
};
