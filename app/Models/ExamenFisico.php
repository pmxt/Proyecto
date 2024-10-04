<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenFisico extends Model
{
    use HasFactory;

    protected $table = 'ExamenFisico';
    protected $fillable = [
        'consulta_prenatal_id',
        'presion_arterial',
        'temperatura_corporal',
        'peso',
        'frecuencia_respiratoria',
        'frecuencia_cardiaca_materna',
        'estado_general',
        'examen_bucal',
        'altura_uterina',
        'movimientos_fetales',
        'frecuencia_cardiaca_fetal',
        'leopoldo',
        'trazas_sangre',
        'verrugas',
        'flujo_vaginal',
        'hemoglobina',
        'grupo_rh',
        'orina',
        'glicemia',
        'vdrl',
        'vih',
        'papanicolau',
        'infecciones',
        'semanas_embarazo',
        'problemas_detectados',

    ];
}
