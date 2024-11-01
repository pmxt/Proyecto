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
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->integer('anio');
            $table->string('mes');
            $table->integer('partos_atendidos')->default(0);
            $table->float('cobertura_mensual')->default(0);
            $table->float('cobertura_acumulada')->default(0);
            $table->string('servicio_salud')->nullable();
            $table->string('distrito_salud')->nullable();
            $table->string('area_salud')->nullable();
            $table->integer('poblacion_meta')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
