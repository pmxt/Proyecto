<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\ModeloEmbarazo_Actual;
use App\Models\Embarazo;

use Illuminate\Http\Request;

class EmbarazoController extends Controller
{
    public function obtener(Request $request)
    {
       
        $pacientes = Paciente::all();
        $embarazos = [];
        $controlesNutricionales = [];

        if ($request->has('paciente_cui')) {
         
            $embarazos = Embarazo::where('paciente_cui', $request->paciente_cui)->get();

      
            if ($request->has('embarazo_id')) {
                $controlesNutricionales = ModeloEmbarazo_Actual::where('embarazo_id', $request->embarazo_id)->get();
            }
        }

        return view('layouts.control', compact('pacientes', 'embarazos', 'controlesNutricionales'));
    }



    public function guardar(Request $request)
    {
        $validated = $request->validate([
            'embarazo_id' => 'required|exists:embarazo,id', 
            'numero_control' => 'required|integer|min:1|max:10',
            'fecha_control' => 'required|date',
            'peso_libras' => 'required|numeric',
            'peso_kg' => 'required|numeric',
            'talla' => 'required|numeric',
            'semanas_gestacion' => 'required|integer|min:1|max:40',
            'ganancia_peso' => 'required|numeric',
            'responsable' => 'required|string|max:255',
            'imc' => 'required|numeric', 
            'diagnostico' => 'required|string',
        ]);

        ModeloEmbarazo_Actual::create([
            'embarazo_id' => $validated['embarazo_id'], 
            'numero_control' => $validated['numero_control'],
            'fecha_control' => $validated['fecha_control'],
            'peso_libras' => $validated['peso_libras'],
            'peso_kg' => $validated['peso_kg'],
            'talla' => $validated['talla'],
            'semanas_gestacion' => $validated['semanas_gestacion'],
            'ganancia_peso' => $validated['ganancia_peso'],
            'responsable' => $validated['responsable'],
            'imc' => $validated['imc'],
            'diagnostico' => $validated['diagnostico'],
        ]);
        

        return redirect()->route('nutricion.Obtener')->with('success', 'Control nutricional guardado correctamente');
    }
}