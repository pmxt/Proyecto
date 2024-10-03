<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class antecedenteObstetrico extends Model
{
    protected $table = 'antecedentes'; 
    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'paciente_cui', // Relacionar con el paciente por su CUI
        'muerte_fetal',
        'abortos_consecutivos',
        'gestas',
        'peso_bebe_2500g',
        'peso_bebe_4500g',
        'hipertension',
        'cirugias_reproductor',

        'num_embarazos',            // Nuevo campo
        'num_partos',               // Nuevo campo
        'num_cesarias',             // Nuevo campo
        'num_abortos',              // Nuevo campo
        'num_hijos_nacidos_vivos',  // Nuevo campo
        'num_hijos_nacidos_muertos',// Nuevo campo
        'num_hijos_vivos',          // Nuevo campo
        'num_hijos_fallecidos'     
    ];

    // Relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_cui', 'cui');
    }
   
}
