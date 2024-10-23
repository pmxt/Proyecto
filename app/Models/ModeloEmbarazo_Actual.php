<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloEmbarazo_Actual extends Model
{
    use HasFactory;
    protected $table = 'nuevoE'; 
    protected $fillable = [
        'embarazo_id',
        'numero_control',
        'fecha_control',
        'peso_libras',
        'peso_kg',
        'talla',
        'semanas_gestacion',
        'ganancia_peso',
        'responsable',
         'imc',
         'diagnostico' 

    ];
    public function embarazo()
    {
        return $this->belongsTo(Embarazo::class);
    }
}
