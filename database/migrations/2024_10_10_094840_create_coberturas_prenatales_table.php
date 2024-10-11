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
        Schema::create('coberturas_prenatales', function (Blueprint $table) {
            $table->id();
            $table->integer('anio');  // Año del registro
            $table->string('mes'); // Mes como string (Enero, Febrero, etc.)
            $table->string('servicio_salud');  // Servicio de salud
            $table->string('distrito_salud');  // Distrito de salud
            $table->string('area_salud');  // Área de salud
            $table->integer('poblacion_meta')->nullable();  // Población meta (opcional)
            $table->integer('embarazos_esperados')->default(0);  // Número de embarazos esperados (inicializado a 0)
            $table->integer('embarazos_realizados')->default(0);  // Número de embarazos realizados (inicializado a 0)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coberturas_prenatales');
    }
};
