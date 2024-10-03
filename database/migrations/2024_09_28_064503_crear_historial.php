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
        Schema::create('historial', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('paciente_cui'); // CUI del paciente, relacionado con la tabla de pacientes
            $table->foreign('paciente_cui')->references('cui')->on('pacientes')->onDelete('cascade');
            $table->boolean('diabetes_a')->nullable();
            $table->boolean('diabetes_b')->nullable();
            $table->boolean('renal_a')->nullable();
            $table->boolean('renal_b')->nullable();
            $table->boolean('corazon_a')->nullable();
            $table->boolean('corazon_b')->nullable();
            $table->boolean('hipertension_a')->nullable();
            $table->boolean('hipertension_b')->nullable();
            $table->boolean('drogas_a')->nullable();
            $table->boolean('drogas_b')->nullable();
            $table->boolean('otra_a')->nullable();
            $table->boolean('otra_b')->nullable();
            $table->text('especificacion');  // Especificación de cualquier otra enfermedad
            $table->string('referido_a');    // A dónde será referido
            $table->date('fecha');
            $table->string('responsable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial');
    }
};
