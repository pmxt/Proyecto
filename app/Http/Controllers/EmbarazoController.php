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
        return view('layouts.EmbarazoActual', compact('pacientes'));
    }
    public function guardar(Request $request)
    {
       $validated = $request->validate([
            'paciente_cui' => 'required|exists:pacientes,cui',
            'peso_lb' => 'required|numeric',
            'peso_kg' => 'required|numeric',
            'talla' => 'required|numeric',
            'imc' => 'required|numeric',
            'cmb' => 'required|numeric',
        ]);
        ModeloEmbarazo_Actual::create([
            'paciente_cui' => $request->input('paciente_cui'),
            'peso_lb' => $request->input('peso_lb'),
            'peso_kg' => $request->input('peso_kg'),
            'talla' => $request->input('talla'),
            'imc' => $request->input('imc'),
            'cmb' => $request->input('cmb'),
        ]);
        //dd($request->all());
        session(['obtener' => $validated]);
        return redirect()->route('pacientes.Obtener')->with('success', 'Datos de embarazo guardados correctamente');
       
    }
}
