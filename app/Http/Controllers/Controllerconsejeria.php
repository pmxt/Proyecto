<?php

namespace App\Http\Controllers;

use App\Models\ModeloConsejeria;
use Illuminate\Http\Request;

class Controllerconsejeria extends Controller
{
      // Función para mostrar el formulario de consejería
      public function obtener($examenFisicoId)
      {
        $currentStep = 4;
        $totalSteps = 4;
          return view('layouts.consejeria', compact('examenFisicoId'));
      }
  
      // Función para guardar los datos de consejería
      public function guardar(Request $request, $examenFisicoId)
      {
          // Validación de los campos
          $validated = $request->validate([
              'alimentacion' => 'required|in:SI,NO',
              'senales_peligro_embarazo' => 'required|in:SI,NO',
              'consejeria_vih' => 'required|in:SI,NO',
              'plan_parto' => 'required|in:SI,NO',
              'plan_emergencia' => 'required|in:SI,NO',
              'lactancia_materna' => 'required|in:SI,NO',
              'metodos_planificacion' => 'required|in:SI,NO',
              'control_posparto' => 'required|in:SI,NO',
              'vacunacion' => 'required|in:SI,NO',
          ]);


          $examenFisicoId = session('obtener2')['id'] ?? $examenFisicoId;
  
          // Guardar los datos de consejería relacionados con el examen físico
          ModeloConsejeria::create([
              'examen_fisico_id' => $examenFisicoId,
              'alimentacion' => $validated['alimentacion'],
              'senales_peligro_embarazo' => $validated['senales_peligro_embarazo'],
              'consejeria_vih' => $validated['consejeria_vih'],
              'plan_parto' => $validated['plan_parto'],
              'plan_emergencia' => $validated['plan_emergencia'],
              'lactancia_materna' => $validated['lactancia_materna'],
              'metodos_planificacion' => $validated['metodos_planificacion'],
              'control_posparto' => $validated['control_posparto'],
              'vacunacion' => $validated['vacunacion'],
          ]);
  
          // Redirigir al siguiente paso (medicamentos o citas) o mostrar un mensaje de éxito
          return redirect()->route('medicamentos.asignar', ['examenFisicoId' => $examenFisicoId])
                           ->with('success', 'Consejería guardada correctamente.');
      }
}
