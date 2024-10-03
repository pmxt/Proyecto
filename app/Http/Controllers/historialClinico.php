<?php

namespace App\Http\Controllers;
use App\Models\Historial;

use Illuminate\Http\Request;

class historialClinico extends Controller
{
    public function mostrarFormulario()
    {
        $datos = session('historia_clinica', []); // Recupera los datos de la sesión o un array vacío si no hay datos
        $currentStep = 5;  // Definimos que es el paso 4
        $totalSteps = 5;   // Suponemos que este es el paso final

        // Retornar la vista del formulario del historial clínico
        return view('layouts.historia_clinica',compact('datos','currentStep', 'totalSteps'));
    }

    public function guardarHistorial(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'diabetes_a' => 'nullable|boolean',
            'diabetes_b' => 'nullable|boolean',
            'renal_a' => 'nullable|boolean',
            'renal_b' => 'nullable|boolean',
            'corazon_a' => 'nullable|boolean',
            'corazon_b' => 'nullable|boolean',
            'hipertension_a' => 'nullable|boolean',
            'hipertension_b' => 'nullable|boolean',
            'drogas_a' => 'nullable|boolean',
            'drogas_b' => 'nullable|boolean',
            'otra_a' => 'nullable|boolean',
            'otra_b' => 'nullable|boolean',
            'especificacion' => 'required|string',
            'referido_a' => 'required|string',
            'fecha' => 'required|date',
            'responsable' => 'required|string',
        ], [
            // Mensajes de error personalizados
            
            'especificacion.required' => 'La especificación es obligatoria.',
            'referido_a.required' => 'Debe especificar a dónde será referido.',
            'fecha.required' => 'La fecha es obligatoria.',
            'responsable.required' => 'Debe ingresar el nombre del responsable.',
        ]);


        $pacienteCui = session('step1')['cui'];

        Historial::create([
            'paciente_cui' => $pacienteCui,
            'diabetes_a' => $request->diabetes_a ?? 0,
            'diabetes_b' => $request->diabetes_b ?? 0,
            'renal_a' => $request->renal_a ?? 0,
            'renal_b' => $request->renal_b ?? 0,
            'corazon_a' => $request->corazon_a ?? 0,
            'corazon_b' => $request->corazon_b ?? 0,
            'hipertension_a' => $request->hipertension_a ?? 0,
            'hipertension_b' => $request->hipertension_b ?? 0,
            'drogas_a' => $request->drogas_a ?? 0,
            'drogas_b' => $request->drogas_b ?? 0,
            'otra_a' => $request->otra_a ?? 0,
            'otra_b' => $request->otra_b ?? 0,
            'especificacion' => $request->especificacion,
            'referido_a' => $request->referido_a,
            'fecha' => $request->fecha,
            'responsable' => $request->responsable,
        ]);

        // Guardar los datos en la base de datos o realizar cualquier lógica necesaria
        // Por ejemplo, podrías tener un modelo para guardar estos datos.
        
        // Aquí podrías hacer algo como:
        // HistorialClinico::create($validated);

        // Redirigir con un mensaje de éxito
        session(['historia_clinica' => $validated]);
        return redirect()->route('pacientes.listar')->with('success', 'Datos guardados correctamente.');
    }
    //
}
