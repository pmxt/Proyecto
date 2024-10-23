<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelmedicamento extends Model
{
    use HasFactory;
    use HasFactory;

   
    protected $table = 'medicamentos';

   
    protected $fillable = [
        'nombre',
        'cantidad',
    ];

   
    public function suplementosAsignados()
    {
        // necesitamos asignar el medicamento a un paciente falta todavia xd
       // return $this->hasMany(SuplementoAsignado::class);
    }
}
