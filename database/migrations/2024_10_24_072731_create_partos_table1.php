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
        Schema::create('comadronas', function (Blueprint $table) {
            $table->id();
            $table->integer('anio');
            $table->string('mes');
            $table->integer('partos_atendidos')->default(0);
            $table->decimal('cobertura_mensual', 5, 2)->default(0);
            $table->decimal('cobertura_acumulada', 5, 2)->default(0);
            $table->string('servicio_salud');
            $table->string('distrito_salud');
            $table->string('area_salud');
            $table->integer('poblacion_meta')->default(0); // Aquí agregamos el campo
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partos_table1');
    }
};
