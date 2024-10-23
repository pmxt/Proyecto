<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $primaryKey = 'cui'; 
    public $incrementing = false; 
    protected $keyType = 'int'; 

    protected $fillable = [
        'cui', 'name', 'fecha_nacimiento', 'edad', 'migrante', 'pueblos', 'Escolaridad', 'Ocupacion','distancia','tiempo','comunidad','telefono'
    ];


    public function encargados()
    {
        return $this->hasOne(Encargado::class, 'paciente_cui', 'cui');
    }

    public function embarazos()
{
    return $this->hasMany(Embarazo::class, 'paciente_cui', 'cui');
} 
}
