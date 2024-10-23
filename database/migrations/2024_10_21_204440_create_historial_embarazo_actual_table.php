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
        Schema::create('historial_embarazo_actual', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('embarazo_id'); 
            $table->foreign('embarazo_id')->references('id')->on('embarazo')->onDelete('cascade');
            $table->enum('embarazo_multiple', ['si', 'no']);
            $table->enum('menos_20', ['si', 'no']);
            $table->enum('rh_negativo', ['si', 'no']);
            $table->enum('mas_35', ['si', 'no']);
            $table->enum('hemorragia', ['si', 'no']);
            $table->enum('vih_sifilis', ['si', 'no']);
            $table->enum('presion_arterial', ['si', 'no']);
            $table->enum('anemia', ['si', 'no']);
            $table->enum('desnutricion', ['si', 'no']);
            $table->enum('dolor_abdominal', ['si', 'no']);
            $table->enum('sintomatologia_uterina', ['si', 'no']);
            $table->enum('ictericia', ['si', 'no']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_embarazo_actual');
    }
};
