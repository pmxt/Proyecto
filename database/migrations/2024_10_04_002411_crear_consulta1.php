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
        Schema::create('consultas_prenatales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('embarazo_id');
            $table->foreign('embarazo_id')->references('id')->on('embarazo')->onDelete('cascade');  // Relación con la tabla 'embarazo'

            $table->date('fecha_consulta');
            $table->string('tipo_servicio');
            $table->string('area_salud');
            $table->string('nombre_servicio');
            $table->string('motivo_consulta');
            $table->string('tipo_consulta');
            $table->boolean('realizada')->default(false);
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
