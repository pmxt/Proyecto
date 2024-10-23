<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitaNutricional extends Model
{
    use HasFactory;

    protected $fillable = [
        'embarazo_id',
        'paciente_cui',
        'fecha_cita',
        'motivo',
        'estado',
    ];

    // Relación con el modelo Embarazo
    public function embarazo()
    {
        return $this->belongsTo(Embarazo::class);
    }

    // Relación con el modelo Paciente (opcional, si lo necesitas)
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_cui', 'cui');
    }
}
