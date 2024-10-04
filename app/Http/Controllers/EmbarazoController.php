<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\ModeloEmbarazo_Actual;

use Illuminate\Http\Request;

class EmbarazoController extends Controller
{
    public function obtener()
    {
        $datos = session('obtener', []);

        $pacientes = Paciente::all();

        // Pasar la lista de pacientes a la vista
        return view('layouts.control', compact('pacientes'));
    }
    public function guardar(Request $request)
    {
        $validated = $request->validate([
            'paciente_cui' => 'required|exists:pacientes,cui',
            'numero_control' => 'required|integer|min:1|max:10',
            'fecha_control' => 'required|date',
            'peso_libras' => 'required|numeric',
            'peso_kg' => 'required|numeric',
            'talla' => 'required|numeric',
            'semanas_gestacion' => 'required|integer|min:1|max:40',
            'ganancia_peso' => 'required|numeric',
            'responsable' => 'required|string|max:255',
            'imc' => 'required|numeric', // Validar el IMC calculado
            'diagnostico' => 'required|string', // Validar el diagnóstico
        ]);
        ModeloEmbarazo_Actual::create([
            'paciente_cui' => $validated['paciente_cui'],
            'numero_control' => $validated['numero_control'],
            'fecha_control' => $validated['fecha_control'],
            'peso_libras' => $validated['peso_libras'],
            'peso_kg' => $validated['peso_kg'],
            'talla' => $validated['talla'],
            'semanas_gestacion' => $validated['semanas_gestacion'],
            'ganancia_peso' => $validated['ganancia_peso'],
            'responsable' => $validated['responsable'],
            'imc' => $validated['imc'], // Guardar el IMC
            'diagnostico' => $validated['diagnostico'], // Guardar el diagnóstico

        ]);
        //dd($request->all());
        session(['obtener' => $validated]);
        return redirect()->route('nutricion.Obtener')->with('success', 'Datos de embarazo guardados correctamente');
    }
}
