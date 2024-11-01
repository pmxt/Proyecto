<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicos extends Model
{
    use HasFactory;
    protected $table = 'medicos';

    // Los campos que se pueden asignar masivamente
    protected $fillable = [
        'anio',
        'mes',
        'partos_atendidos',
        'cobertura_mensual',
        'cobertura_acumulada',
        'servicio_salud',
        'distrito_salud',
        'area_salud',
        'poblacion_meta',
    ];
}
