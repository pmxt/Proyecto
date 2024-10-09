<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuplementoAsignado extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table = 'suplementos_asignados';

    protected $fillable = [
        'examen_fisico_id',  // Relacionado con el examen físico
        'medicamento_id',    // Medicamento asignado
        'cantidad_asignada', // Cantidad asignada
    ];

    // Relación con Examen Físico
    public function examenFisico()
    {
        return $this->belongsTo(ExamenFisico::class, 'examen_fisico_id');
    }

    // Relación con Medicamento
    public function medicamento()
    {
        return $this->belongsTo(Modelmedicamento::class, 'medicamento_id');
    }
}
