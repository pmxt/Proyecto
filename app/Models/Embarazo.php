<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Embarazo extends Model
{
    use HasFactory;
    protected $table = 'embarazo';
    protected $fillable = [
        'paciente_cui',
      'fecha_ultima_regla',
      'fecha_probable_parto', 

    ];


    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_cui', 'cui');
    }
    public function historial()
    {
        return $this->hasOne(Historial::class);
    }
    public function antecedenteObstetrico()
    {
        return $this->hasOne(AntecedenteObstetrico::class); // 1 a 1 
    }
    public function consultasPrenatales()
{
    return $this->hasMany(Consulta1::class, 'embarazo_id', 'id');
}

    public function historialEmbarazoActual()
    {
        return $this->hasOne(HistorialEmbarazoActual::class);
    }
    
}
