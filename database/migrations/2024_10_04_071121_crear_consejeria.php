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
        Schema::create('consejerias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('examen_fisico_id')->constrained('ExamenFisico')->onDelete('cascade');
            $table->enum('alimentacion', ['SI', 'NO']);
            $table->enum('senales_peligro_embarazo', ['SI', 'NO']);
            $table->enum('consejeria_vih', ['SI', 'NO']);
            $table->enum('plan_parto', ['SI', 'NO']);
            $table->enum('plan_emergencia', ['SI', 'NO']);
            $table->enum('lactancia_materna', ['SI', 'NO']);
            $table->enum('metodos_planificacion', ['SI', 'NO']);
            $table->enum('control_posparto', ['SI', 'NO']);
            $table->enum('vacunacion', ['SI', 'NO']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consejerias');
    }
};
