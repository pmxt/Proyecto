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
        'embarazo_multiple',
        'fecha_ultima_regla',
        'fecha_probable_parto',
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
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_cui', 'cui');
    }
}
