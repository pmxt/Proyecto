<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consulta1 extends Model
{
    use HasFactory;
    protected $table = 'consultas_prenatales';

    // Campos que se permiten para la asignación masiva
    protected $fillable = [
        'paciente_cui',
        'fecha_consulta',
        'tipo_servicio',
        'area_salud',
        'nombre_servicio',
        'motivo_consulta',
        'tipo_consulta',
    ];

    // Relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_cui', 'cui');
    }
}
