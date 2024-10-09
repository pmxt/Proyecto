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
        Schema::create('ExamenFisico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consulta_prenatal_id')->constrained('consultas_prenatales')->onDelete('cascade');
            $table->string('presion_arterial');
            $table->string('temperatura_corporal');
            $table->float('peso');
            $table->float('frecuencia_respiratoria');
            $table->float('frecuencia_cardiaca_materna');
            $table->string('estado_general');
            $table->string('examen_bucal');
            $table->string('altura_uterina');
            $table->string('movimientos_fetales');
            $table->string('frecuencia_cardiaca_fetal');
            $table->string('leopoldo');
            $table->string('trazas_sangre');
            $table->string('verrugas');
            $table->string('flujo_vaginal');
            $table->string('hemoglobina');
            $table->string('grupo_rh');
            $table->string('orina');
            $table->string('glicemia');
            $table->string('vdrl');
            $table->string('vih');
            $table->string('papanicolau');
            $table->string('infecciones');
            $table->string('semanas_embarazo');
            $table->string('problemas_detectados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ExamenFisico');
    }
};
