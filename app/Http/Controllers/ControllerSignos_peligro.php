<?php

namespace App\Http\Controllers;

use App\Models\ModelSignos_peligro;
use Illuminate\Http\Request;

class ControllerSignos_peligro extends Controller
{
  
    public function obtener($examenFisicoId)
    {
        $currentStep = 3;
        $totalSteps = 4; 
        return view('layouts.signos_sintomas_peligro', compact('examenFisicoId','currentStep', 'totalSteps'));
    }

  public function guardar(Request $request, $examenFisicoId)
{
    $validated = $request->validate([
        'hemorragia_vaginal' => 'required|in:SI,NO',
        'dolor_cabeza_severo' => 'required|in:SI,NO',
        'vision_borrosa' => 'required|in:SI,NO',
        'convulsion' => 'required|in:SI,NO',
        'dolor_abdominal_severo' => 'required|in:SI,NO',
        'presion_arterial_alta' => 'required|in:SI,NO',
        'fiebre' => 'required|in:SI,NO',
        'presentacion_fetal_anormal' => 'required|in:SI,NO',
    ]);

    $examenFisicoId = session('obtener2')['id'] ?? $examenFisicoId;

   
    ModelSignos_peligro::create([
        'examen_fisico_id' => $examenFisicoId,
        'hemorragia_vaginal' => $validated['hemorragia_vaginal'],
        'dolor_cabeza_severo' => $validated['dolor_cabeza_severo'],
        'vision_borrosa' => $validated['vision_borrosa'],
        'convulsion' => $validated['convulsion'],
        'dolor_abdominal_severo' => $validated['dolor_abdominal_severo'],
        'presion_arterial_alta' => $validated['presion_arterial_alta'],
        'fiebre' => $validated['fiebre'],
        'presentacion_fetal_anormal' => $validated['presentacion_fetal_anormal'],
    ]);

    return redirect()->route('consejeria.Obtener', ['examenFisicoId' => $examenFisicoId])
                     ->with('success', 'Signos y síntomas de peligro guardados correctamente.');
}

}
