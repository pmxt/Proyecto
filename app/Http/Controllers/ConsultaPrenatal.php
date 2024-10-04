<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\consulta1;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class ConsultaPrenatal extends Controller
{



    // funciones para mostrar la primera cita 
    // en esta seleccionamos el paciente 
    public function obtener()
    {
        $datos = session('obtener1', []);
        $currentStep = 1; // Estás en el paso 1
        $totalSteps = 4;  // Suponiendo que tienes 3 pasos en total

        $pacientes = Paciente::all();

        return view('layouts.consultas_prenatales', compact('datos', 'currentStep', 'totalSteps','pacientes'));
    }

    // funcion apra guaradar la primera cita 
    public function guardar(Request $request)
    {
        $validated = $request->validate([
            'paciente_cui' => 'required|exists:pacientes,cui',
            'fecha_consulta' => 'required|date',
            'tipo_servicio' => 'required',
            'area_salud' => 'required|string',
            'nombre_servicio' => 'required|string',
            'motivo_consulta' => 'required',
            'tipo_consulta' => 'required|string',



        ]);
        $consultaId= consulta1::create([
            'paciente_cui' => $validated['paciente_cui'],
            'fecha_consulta' => $validated['fecha_consulta'],
            'tipo_servicio' => $validated['tipo_servicio'],
            'area_salud' => $validated['area_salud'],
            'nombre_servicio' => $validated['nombre_servicio'],
            'motivo_consulta' => $validated['motivo_consulta'],
            'tipo_consulta' => $validated['tipo_consulta'],
        ]);

        // Obtener el ID de la consulta recién creada

        session(['obtener1' => ['id' => $consultaId->id]]);
        
        return redirect()->route('examen.Obtener')->with('success', 'Datos de la consulta guardados correctamente');
    }
}
