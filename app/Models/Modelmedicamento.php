<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelmedicamento extends Model
{
    use HasFactory;
    use HasFactory;

    // Nombre de la tabla asociada (opcional, si no sigue el nombre por defecto en plural)
    protected $table = 'medicamentos';

    // Campos que pueden ser asignados de manera masiva
    protected $fillable = [
        'nombre',
        'cantidad',
    ];

    // Relaciones si hay algún otro modelo relacionado en el futuro (por ejemplo, medicamentos asignados a pacientes)
    public function suplementosAsignados()
    {
        // necesitamos asignar el medicamento a un paciente falta todavia xd
       // return $this->hasMany(SuplementoAsignado::class);
    }
}
