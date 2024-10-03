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
        Schema::create('embarazo', function (Blueprint $table) {
            $table->id();  // ID de la tabla historial
            $table->bigInteger('paciente_cui'); // CUI del paciente, relacionado con la tabla de pacientes
            $table->foreign('paciente_cui')->references('cui')->on('pacientes')->onDelete('cascade'); // Llave foránea a la tabla pacientes
            // NUEVOS CAMPOS AGREGADOS
            $table->date('fecha_ultima_regla');
            $table->date('fecha_probable_parto');


            // Campos booleanos para el historial obstétrico
            $table->enum('embarazo_multiple',['si', 'no']); // Diagnóstico o sospecha de embarazo múltiple
            $table->enum('menos_20',['si', 'no']); // Menos de 20 años
            $table->enum('rh_negativo',['si', 'no']); // Paciente Rh (-)
            $table->enum('mas_35',['si', 'no']); // Más de 35 años
            $table->enum('hemorragia',['si', 'no']); // Hemorragia vaginal sin importar cantidad
            $table->enum('vih_sifilis',['si', 'no']); // VIH positivo o sífilis positivo
            $table->enum('presion_arterial',['si', 'no']); // Presión arterial diastólica de 90 mm Hg o más
            $table->enum('anemia',['si', 'no']); // Anemia clínica o de laboratorio
            $table->enum('desnutricion',['si', 'no']); // Desnutrición u obesidad
            $table->enum('dolor_abdominal',['si', 'no']); // Dolor abdominal
            $table->enum('sintomatologia_uterina',['si', 'no']); // Sintomatología uterina
            $table->enum('ictericia',['si', 'no']); // Ictericia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('embarazo');
    }
};
