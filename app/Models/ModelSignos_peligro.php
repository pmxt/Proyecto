<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelSignos_peligro extends Model
{
    use HasFactory;
    protected $table = 'sintomas';
    protected $fillable = [
        'examen_fisico_id',
        'hemorragia_vaginal',
        'dolor_cabeza_severo',
        'vision_borrosa',
        'convulsion',
        'dolor_abdominal_severo',
        'presion_arterial_alta',
        'fiebre',
        'presentacion_fetal_anormal',
    ];
    public function examenFisico()
    {
        return $this->belongsTo(ExamenFisico::class,'examen_fisico_id');
    }
}
