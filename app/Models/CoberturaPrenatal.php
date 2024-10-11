<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoberturaPrenatal extends Model
{
    use HasFactory;
    protected $table = 'coberturas_prenatales';
    protected $fillable = [
        'servicio_salud',
        'distrito_salud',
        'area_salud',
        'anio',
        'mes',
        'poblacion_meta',
        'embarazos_esperados',
        'embarazos_realizados'
    ];
}
