<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $primaryKey = 'cui'; // CUI como clave primaria
    public $incrementing = false; // No es autoincremental
    protected $keyType = 'int'; // Tipo de clave primaria, numérico

    protected $fillable = [
        'cui', 'name', 'fecha_nacimiento', 'edad', 'migrante', 'pueblos', 'Escolaridad', 'Ocupacion','distancia','tiempo','comunidad','telefono'
    ];

    // Relación con el modelo Encargado
    public function encargados()
    {
        return $this->hasMany(Encargado::class, 'paciente_cui', 'cui');
    }

     // Relación con el modelo Historial
     public function historial()
     {
         return $this->hasOne(Historial::class, 'paciente_cui', 'cui');
     }
}
