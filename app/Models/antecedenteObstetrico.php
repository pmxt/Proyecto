<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class antecedenteObstetrico extends Model
{
    protected $table = 'antecedentes';

    protected $fillable = [
        'embarazo_id', 
        'muerte_fetal',
        'abortos_consecutivos',
        'gestas',
        'peso_bebe_2500g',
        'peso_bebe_4500g',
        'hipertension',
        'cirugias_reproductor',
        'num_embarazos',
        'num_partos',
        'num_cesarias',
        'num_abortos',
        'num_hijos_nacidos_vivos',
        'num_hijos_nacidos_muertos',
        'num_hijos_vivos',
        'num_hijos_fallecidos'
    ];


    public function embarazo()
    {
        return $this->belongsTo(Embarazo::class);
    }
}
