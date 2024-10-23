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
        'examen_fisico_id',  
        'medicamento_id',    
        'cantidad_asignada', 
    ];

   
    public function examenFisico()
    {
        return $this->belongsTo(ExamenFisico::class, 'examen_fisico_id');
    }

   
    public function medicamento()
    {
        return $this->belongsTo(Modelmedicamento::class, 'medicamento_id');
    }
}
