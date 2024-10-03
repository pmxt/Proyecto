<?php

namespace App\Http\Controllers;

use App\Models\antecedenteObstetrico;
use App\Models\Embarazo as ModelsEmbarazo;
use Illuminate\Http\Request;

class embarazo extends Controller
{
    public function mostrarFormulario()
    {
        $datos = session('embarazo', []); // Recupera los datos de la sesión o un array vacío si no hay datos
        $currentStep = 4;  // Definimos que es el paso 4
        $totalSteps = 5;   // Suponemos que este es el paso final

        // Retornar la vista del formulario del historial clínico
        return view('layouts.embarazo', compact('datos', 'currentStep', 'totalSteps'));
    }
    public function guardarFormulario(Request $request)
    {

        $validated = $request->validate([
            'fecha_ultima_regla' => 'required|date',
            'fecha_probable_parto' => 'required|date',
            'embarazo_multiple' => 'required|in:Sí,No',
            'menos_20' => 'required|in:Sí,No',
            'rh_negativo' => 'required|in:Sí,No',
            'mas_35' => 'required|in:Sí,No',
            'hemorragia' => 'required|in:Sí,No',
            'vih_sifilis' => 'required|in:Sí,No',
            'presion_arterial' => 'required|in:Sí,No',
            'anemia' => 'required|in:Sí,No',
            'desnutricion' => 'required|in:Sí,No',
            'dolor_abdominal' => 'required|in:Sí,No',
            'sintomatologia_uterina' => 'required|in:Sí,No',
            'ictericia' => 'required|in:Sí,No',
        ]);

        $pacienteCui = session('step1')['cui'];


        // GUARDAR EN LA BD 
        ModelsEmbarazo::create([
            'paciente_cui' => $pacienteCui,
            'fecha_ultima_regla' => $validated['fecha_ultima_regla' ],
            'fecha_probable_parto' => $validated['fecha_probable_parto'],
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
        // Guardar en sesión los datos temporalmente si es necesario
        session(['embarazo' => $validated]);

        return redirect()->route('historial.mostrar')->with('success', 'Datos guardados correctamente.');
    }
}
