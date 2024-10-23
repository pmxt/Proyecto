<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    protected $primaryKey = 'cui';
    public $incrementing = false; 
    protected $keyType = 'int'; 

    protected $fillable = [
        'cui', 'paciente_cui', 'nombreEsposo', 'fecha_nacimiento', 'edad', 'pueblos', 'Escolaridad', 'Ocupacion', 'estado_civil',
    ];


    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_cui', 'cui');
    }
}
