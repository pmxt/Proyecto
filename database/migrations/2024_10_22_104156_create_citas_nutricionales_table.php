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
        Schema::create('citas_nutricionales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consulta_nutricional_id')->constrained('nuevoE')->onDelete('cascade'); 
            $table->date('fecha_cita');
            $table->string('motivo')->nullable(); 
            $table->enum('estado', ['pendiente', 'realizada'])->default('pendiente'); 
           
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas_nutricionales');
    }
};
