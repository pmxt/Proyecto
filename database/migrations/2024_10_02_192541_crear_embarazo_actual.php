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

        Schema::create('nuevoE', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('paciente_cui');
            $table->foreign('paciente_cui')->references('cui')->on('pacientes')->onDelete('cascade');
            $table->integer('numero_control');
            $table->date('fecha_control');
            $table->float('peso_libras');
            $table->float('peso_kg');
            $table->float('talla');
            $table->integer('semanas_gestacion');
            $table->float('ganancia_peso');
            $table->string('responsable');
            $table->float('imc');
            $table->string('diagnostico');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nuevoE');
    }
};
