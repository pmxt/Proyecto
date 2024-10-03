<?php

namespace App\Http\Controllers;

use App\Models\antecedenteObstetrico;
use Illuminate\Http\Request;

class AntecedentesObstetricosController extends Controller
{
    public function step()
    {
        $datos = session('antecedentes_obstetricos', []); // Recupera los datos de la sesión o un array vacío si no hay datos
        $currentStep = 3; // Estás en el paso 1
        $totalSteps = 5;  // Suponiendo que tienes 3 pasos en total
        return view('layouts.antecedentes_obstetricos', compact('datos', 'currentStep', 'totalSteps'));
    }

    public function submit(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'num_embarazos' => 'required|numeric',
            'num_partos' => 'required|numeric',
            'num_cesarias' => 'required|numeric',
            'num_abortos' => 'required|numeric',
            'num_hijos_nacidos_vivos' => 'required|numeric',
            'num_hijos_nacidos_muertos' => 'required|numeric',
            'num_hijos_vivos' => 'required|numeric',
            'num_hijos_fallecidos' => 'required|numeric',


            'muerte_fetal' => 'required|in:si,no',
            'abortos_consecutivos' => 'required|in:si,no',
            'gestas' => 'required|in:si,no',
            'peso_bebe_2500g' => 'required|in:si,no',
            'peso_bebe_4500g' => 'required|in:si,no',
            'hipertension' => 'required|in:si,no',
            'cirugias_reproductor' => 'required|in:si,no',
        ]);

        // Obtener el ID del paciente (asegúrate de tener este valor disponible)
        $pacienteCui = session('step1')['cui']; // Ejemplo, asegúrate de tener este valor en sesión o desde otra fuente

        // Guardar los datos en la base de datos
        antecedenteObstetrico::create([
            'paciente_cui' => $pacienteCui, // Debes obtener el paciente CUI de forma correcta
            'muerte_fetal' => $validated['muerte_fetal'],
            'abortos_consecutivos' => $validated['abortos_consecutivos'],
            'gestas' => $validated['gestas'],
            'peso_bebe_2500g' => $validated['peso_bebe_2500g'],
            'peso_bebe_4500g' => $validated['peso_bebe_4500g'],
            'hipertension' => $validated['hipertension'],
            'cirugias_reproductor' => $validated['cirugias_reproductor'],

            'num_embarazos' => $validated['num_embarazos'],
            'num_partos' => $validated['num_partos'],
            'num_cesarias' => $validated['num_cesarias'],
            'num_abortos' => $validated['num_abortos'],
            'num_hijos_nacidos_vivos' => $validated['num_hijos_nacidos_vivos'],
            'num_hijos_nacidos_muertos' => $validated['num_hijos_nacidos_muertos'],
            'num_hijos_vivos' => $validated['num_hijos_vivos'],
            'num_hijos_fallecidos' => $validated['num_hijos_fallecidos'],

        ]);

        // Guardar en sesión los datos temporalmente si es necesario
        session(['antecedentes_obstetricos' => $validated]);

        // Redirigir al usuario a la página deseada con un mensaje de éxito
        return redirect()->route('embarazo.mostrar')->with('success', 'Datos guardados correctamente.');
    }
}
