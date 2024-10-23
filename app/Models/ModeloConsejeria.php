<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloConsejeria extends Model
{
    use HasFactory;

    protected $table = 'consejerias';

   
    protected $fillable = [
        'examen_fisico_id',
        'alimentacion',
        'senales_peligro_embarazo',
        'consejeria_vih',
        'plan_parto',
        'plan_emergencia',
        'lactancia_materna',
        'metodos_planificacion',
        'control_posparto',
        'vacunacion',
    ];
       
       public function examenFisico()
       {
           return $this->belongsTo(ExamenFisico::class, 'examen_fisico_id');
       }

}
