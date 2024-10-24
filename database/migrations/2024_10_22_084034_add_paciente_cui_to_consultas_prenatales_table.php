<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   
    public function up()
    {
        Schema::table('consultas_prenatales', function (Blueprint $table) {
            $table->string('paciente_cui')->nullable(); 
        });
    }
    
    public function down()
    {
        Schema::table('consultas_prenatales', function (Blueprint $table) {
            $table->dropColumn('paciente_cui');
        });
    }
};
