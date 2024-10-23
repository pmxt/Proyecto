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
        Schema::create('historial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('embarazo_id'); 
            $table->foreign('embarazo_id')->references('id')->on('embarazo')->onDelete('cascade');

           
            $table->enum('diabetes', ['si', 'no']);
            $table->enum('renal', ['si', 'no']);
            $table->enum('corazon', ['si', 'no']);
            $table->enum('hipertension', ['si', 'no']);
            $table->enum('drogas', ['si', 'no']);
            $table->enum('otra', ['si', 'no']);

            
            $table->text('especificacion');  
            $table->string('referido_a');    
            $table->date('fecha');
            $table->string('responsable');
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('historial');
    }
};
