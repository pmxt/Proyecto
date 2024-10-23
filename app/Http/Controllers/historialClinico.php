<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use Illuminate\Http\Request;

class historialClinico extends Controller
{
    public function mostrarFormulario()
    {
        $datos = session('historia_clinica', []);
        $currentStep = 5;
        $totalSteps = 5;

        return view('layouts.historia_clinica', compact('datos', 'currentStep', 'totalSteps'));
    }

    public function guardarHistorial(Request $request)
    {
        // Reglas de validación para asegurar que los campos acepten solo "si" o "no"
        $validated = $request->validate([
            'diabetes' => 'required|in:si,no',
            'renal' => 'required|in:si,no',
            'corazon' => 'required|in:si,no',
            'hipertension' => 'required|in:si,no',
            'drogas' => 'required|in:si,no',
            'otra' => 'required|in:si,no',
            'especificacion' => 'required|string',
            'referido_a' => 'required|string',
            'fecha' => 'required|date',
            'responsable' => 'required|string',
        ]);
    
        // Guardado de los datos en la base de datos
        $embarazo_id = session('step1')['embarazo_id'];
    
        Historial::create([
            'embarazo_id' => $embarazo_id,
            'diabetes' => $validated['diabetes'],
            'renal' => $validated['renal'],
            'corazon' => $validated['corazon'],
            'hipertension' => $validated['hipertension'],
            'drogas' => $validated['drogas'],
            'otra' => $validated['otra'],
            'especificacion' => $validated['especificacion'],
            'referido_a' => $validated['referido_a'],
            'fecha' => $validated['fecha'],
            'responsable' => $validated['responsable'],
        ]);
    

        session(['historia_clinica' => $validated]);
        return redirect()->route('pacientes.listar')->with('success', 'Datos guardados correctamente.');
    }
}
