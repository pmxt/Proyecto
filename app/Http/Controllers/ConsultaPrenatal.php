<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\consulta1;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\Embarazo;

class ConsultaPrenatal extends Controller
{

    public function obtener(Request $request)
    {
        $datos = session('obtener1', []);
        $currentStep = 1;
        $totalSteps = 4;

        $pacientes = Paciente::all();
        $embarazos = [];

        if ($request->has('paciente_cui')) {
            $embarazos = Embarazo::where('paciente_cui', $request->paciente_cui)->get();
        }

        return view('layouts.consultas_prenatales', compact('datos', 'currentStep', 'totalSteps', 'pacientes', 'embarazos'));
    }

  
    public function guardar(Request $request)
    {
        $validated = $request->validate([
            'paciente_cui' => 'required|exists:pacientes,cui',
            'embarazo_id' => 'required|exists:embarazo,id',
            'fecha_consulta' => 'required|date',
            'tipo_servicio' => 'required',
            'area_salud' => 'required|string',
            'nombre_servicio' => 'required|string',
            'motivo_consulta' => 'required',
            'tipo_consulta' => 'required|string',



        ]);
        
        $consulta = consulta1::create([
            'embarazo_id' => $validated['embarazo_id'],
            'paciente_cui' => $validated['paciente_cui'],
            
            'fecha_consulta' => $validated['fecha_consulta'],
            'tipo_servicio' => $validated['tipo_servicio'],
            'area_salud' => $validated['area_salud'],
            'nombre_servicio' => $validated['nombre_servicio'],
            'motivo_consulta' => $validated['motivo_consulta'],
            'tipo_consulta' => $validated['tipo_consulta'],
        ]);
        

        session([
            'obtener1' => ['id' => $consulta->id],
            'embarazo_id' => $validated['embarazo_id'], // Asegurar que 'embarazo_id' esté en la sesión
        ]);

        return redirect()->route('examen.Obtener', ['consultaId' => $consulta->id])->with('success', 'Datos de la consulta guardados correctamente');
    }
}
