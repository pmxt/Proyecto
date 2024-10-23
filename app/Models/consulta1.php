<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consulta1 extends Model
{
    use HasFactory;
    protected $table = 'consultas_prenatales';


    protected $fillable = [
        'paciente_cui',
        'fecha_consulta',
        'tipo_servicio',
        'area_salud',
        'nombre_servicio',
        'motivo_consulta',
        'tipo_consulta',
        'embarazo_id',


        
    ];
    protected $casts = [
        'fecha_consulta' => 'date',
    ];

    public function embarazo()
{
    return $this->belongsTo(Embarazo::class, 'embarazo_id', 'id');
}
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_cui', 'cui');
    }
}
