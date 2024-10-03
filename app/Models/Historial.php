<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;
    protected $table = 'historial';
    protected $fillable = [
        'paciente_cui',
        'diabetes_a',
        'diabetes_b',
        'renal_a',
        'renal_b',
        'corazon_a',
        'corazon_b',
        'hipertension_a',
        'hipertension_b',
        'drogas_a',
        'drogas_b',
        'otra_a',
        'otra_b',
        'especificacion',
        'referido_a',
        'fecha',
        'responsable',
    ];
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_cui', 'cui');
    }
}
