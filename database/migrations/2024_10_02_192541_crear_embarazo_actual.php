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
            $table->float('peso_lb');
            $table->float('peso_kg');
            $table->float('talla');
            $table->float('imc');
            $table->float('cmb');
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
