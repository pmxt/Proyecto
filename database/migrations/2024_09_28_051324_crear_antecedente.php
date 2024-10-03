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
        Schema::create('antecedentes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('paciente_cui'); // CUI del paciente
            $table->foreign('paciente_cui')->references('cui')->on('pacientes')->onDelete('cascade'); // Relación con la tabla 'pacientes'
            $table->enum('muerte_fetal', ['si', 'no']);
            $table->enum('abortos_consecutivos', ['si', 'no']);
            $table->enum('gestas', ['si', 'no']);
            $table->enum('peso_bebe_2500g', ['si', 'no']);
            $table->enum('peso_bebe_4500g', ['si', 'no']);
            $table->enum('hipertension', ['si', 'no']);
            $table->enum('cirugias_reproductor', ['si', 'no']);

             // Nuevos campos
             $table->integer('num_embarazos')->default(0);
             $table->integer('num_partos')->default(0);
             $table->integer('num_cesarias')->default(0);
             $table->integer('num_abortos')->default(0);
             $table->integer('num_hijos_nacidos_vivos')->default(0);
             $table->integer('num_hijos_nacidos_muertos')->default(0);
             $table->integer('num_hijos_vivos')->default(0);
             $table->integer('num_hijos_fallecidos')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentes');
    }
};
