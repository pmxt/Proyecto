<?php

namespace App\Http\Controllers;

use App\Models\antecedenteObstetrico;
use Illuminate\Http\Request;

use App\Models\Embarazo;

class AntecedentesObstetricosController extends Controller
{
    public function step()
    {
        $datos = session('Antecedentes_Obstetrico',[]);
        
        $currentStep = 3; 
        $totalSteps = 5;  
        $embarazo_id = session('step1')['embarazo_id'] ?? null;
        if ($embarazo_id) {
            $embarazo = Embarazo::find($embarazo_id);
        } else {
            // Manejar el caso donde no hay embarazo_id disponible
            $embarazo = null;
        }

        
        return view('layouts.antecedentes_obstetricos', compact('datos','embarazo','currentStep', 'totalSteps'));

    }
    
    public function submit(Request $request)
    {
        
  
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

        $embarazo_id = session('step1')['embarazo_id'];

        antecedenteObstetrico::create([
           'embarazo_id' => $embarazo_id, 
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

        
        session(['antecedentes_obstetricos' => $validated]);

        
        return redirect()->route('embarazo.mostrar')->with('success', 'Datos guardados correctamente.');
    }
}
