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
    {  Schema::create('consultas_prenatales', function (Blueprint $table) {
        $table->id();
        $table->string('paciente_cui');
        $table->foreign('paciente_cui')->references('cui')->on('pacientes')->onDelete('cascade');
        $table->date('fecha_consulta');
        $table->string('tipo_servicio');
        $table->string('area_salud');
        $table->string('nombre_servicio');
        $table->string('motivo_consulta');
        $table->string('tipo_consulta');
        $table->text('examen_fisico')->nullable();  // Campo para guardar los datos del examen físico
        $table->text('sintomas_peligro')->nullable(); // Campo para guardar los síntomas de peligro
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas_prenatales');
    }
};
