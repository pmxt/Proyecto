<?php

namespace App\Http\Controllers;


use App\Models\HistorialEmbarazoActual;
use App\Models\Embarazo as ModelsEmbarazo;
use Illuminate\Http\Request;

class embarazo extends Controller
{
    public function mostrarFormulario()
    {
    $datos = session('Embarazo',[]);
        $currentStep = 4;
        $totalSteps = 5; 

       
        return view('layouts.embarazo', compact('datos', 'currentStep', 'totalSteps'));
    }
    public function guardarFormulario(Request $request)
    {

        $validated = $request->validate([
            'embarazo_multiple' => 'required|in:si,no',
            'menos_20' => 'required|in:si,no',
            'rh_negativo' => 'required|in:si,no',
            'mas_35' => 'required|in:si,no',
            'hemorragia' => 'required|in:si,no',
            'vih_sifilis' => 'required|in:si,no',
            'presion_arterial' => 'required|in:si,no',
            'anemia' => 'required|in:si,no',
            'desnutricion' => 'required|in:si,no',
            'dolor_abdominal' => 'required|in:si,no',
            'sintomatologia_uterina' => 'required|in:si,no',
            'ictericia' => 'required|in:si,no',
           
        ]);

        $embarazo_id = session('step1')['embarazo_id'];
      
        HistorialEmbarazoActual::create([
            'embarazo_id' => $embarazo_id,
            'embarazo_multiple' => $validated['embarazo_multiple'],
            'menos_20' => $validated['menos_20'],
            'rh_negativo' => $validated['rh_negativo'],
            'mas_35' => $validated['mas_35'],
            'hemorragia' => $validated['hemorragia'],
            'vih_sifilis' => $validated['vih_sifilis'],
            'presion_arterial' => $validated['presion_arterial'],
            'anemia' => $validated['anemia'],
            'desnutricion' => $validated['desnutricion'],
            'dolor_abdominal' => $validated['dolor_abdominal'],
            'sintomatologia_uterina' => $validated['sintomatologia_uterina'],
            'ictericia' => $validated['ictericia'],
        ]);
       
        session(['embarazo' => $validated]);
        

        return redirect()->route('historial.mostrar')->with('success', 'Datos guardados correctamente.');
    }
}
