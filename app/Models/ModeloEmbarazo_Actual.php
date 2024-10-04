<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloEmbarazo_Actual extends Model
{
    use HasFactory;
    protected $table = 'nuevoE'; // Cambia el nombre de la tabla según corresponda
    protected $fillable = [
        'paciente_cui',
        'numero_control',
        'fecha_control',
        'peso_libras',
        'peso_kg',
        'talla',
        'semanas_gestacion',
        'ganancia_peso',
        'responsable',
         'imc',
         'diagnostico' 

    ];
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_cui', 'cui');
    }
}
