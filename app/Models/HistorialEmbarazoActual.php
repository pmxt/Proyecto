<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialEmbarazoActual extends Model
{
    use HasFactory;
    protected $table = 'historial_embarazo_actual';

    // Definir los campos que pueden ser llenados (mass assignable)
    protected $fillable = [
        'embarazo_id',
        'embarazo_multiple',
        'menos_20',
        'rh_negativo',
        'mas_35',
        'hemorragia',
        'vih_sifilis',
        'presion_arterial',
        'anemia',
        'desnutricion',
        'dolor_abdominal',
        'sintomatologia_uterina',
        'ictericia',
    ];

    // Relación con la tabla "embarazo"
    public function embarazo()
    {
        return $this->belongsTo(Embarazo::class, 'embarazo_id');
    }
    

    
}
