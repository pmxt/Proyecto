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
        Schema::create('sintomas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('examen_fisico_id')->constrained('ExamenFisico')->onDelete('cascade');
            $table->enum('hemorragia_vaginal', ['SI', 'NO'])->nullable();
            $table->enum('dolor_cabeza_severo', ['SI', 'NO'])->nullable();
            $table->enum('vision_borrosa', ['SI', 'NO'])->nullable();
            $table->enum('convulsion', ['SI', 'NO'])->nullable();
            $table->enum('dolor_abdominal_severo', ['SI', 'NO'])->nullable();
            $table->enum('presion_arterial_alta', ['SI', 'NO'])->nullable();
            $table->enum('fiebre', ['SI', 'NO'])->nullable();
            $table->enum('presentacion_fetal_anormal', ['SI', 'NO'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signos_peligro');
    }
};
