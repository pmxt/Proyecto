<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    protected $primaryKey = 'cui'; // CUI como clave primaria
    public $incrementing = false; // No es autoincremental
    protected $keyType = 'int'; // Cambiar a 'string' si el CUI es alfanumérico

    protected $fillable = [
        'cui', 'paciente_cui', 'nombreEsposo', 'fecha_nacimiento', 'edad', 'pueblos', 'Escolaridad', 'Ocupacion', 'estado_civil',
    ];

    // Relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_cui', 'cui');
    }
}
