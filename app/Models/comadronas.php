<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comadronas extends Model
{

    use HasFactory;
    protected $table = 'Comadronas';
    protected $fillable = [
        'servicio_salud', 
        'distrito_salud', 
        'area_salud', 
        'anio', 
        'poblacion_meta', 
        'mes', 
        'partos_atendidos', 
        'cobertura_mensual', 
        'cobertura_acumulada'
    ];
}
