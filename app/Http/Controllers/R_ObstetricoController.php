<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Encargado;
use App\Models\Embarazo;



class R_ObstetricoController extends Controller
{

    public function step1()
    {
        $datos = session('step1', []);
        $currentStep = 1;
        $totalSteps = 5;

        $pacienteCui = $datos['cui'] ?? null;
        $embarazo = null;

        if ($pacienteCui) {
            $embarazo = Embarazo::where('paciente_cui', $pacienteCui)->first();
        }

        return view('layouts.nuevo_paciente', compact('datos', 'currentStep', 'totalSteps', 'embarazo'));
    }

  
    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'cui' => 'required|numeric',
            'name' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'migrante' => 'required|string',
            'pueblos' => 'required|string',
            'Escolaridad' => 'nullable|string',
            'Ocupacion' => 'nullable|string',
            'distancia' => 'nullable|string',
            'tiempo' => 'nullable|string',
            'comunidad' => 'nullable|string',
            'telefono' => 'nullable|string',
            'fecha_ultima_regla' => 'required|date',
            'fecha_probable_parto' => 'required|date',
        ], [
            'cui.required' => 'El CUI es obligatorio.',
            'cui.numeric' => 'El CUI debe ser un número.',
            'cui.unique' => 'El CUI ya está registrado.',
            'name.required' => 'El nombre de la embarazada es obligatorio.',
            'name.string' => 'El nombre debe ser texto.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'pueblos.required' => 'Debes seleccionar un pueblo.',
            'pueblos.string' => 'La selección del pueblo es inválida.',
            'fecha_ultima_regla.required' => 'La fecha de la última regla es obligatoria.',
            'fecha_probable_parto.required' => 'La fecha probable de parto es obligatoria.',
        ]);


        $fechaNacimiento = new \DateTime($validated['fecha_nacimiento']);
        $fechaActual = new \DateTime();
        $edad = $fechaActual->diff($fechaNacimiento)->y;


        $paciente = Paciente::updateOrCreate(
            ['cui' => $validated['cui']], // Condición para buscar el paciente existente
            [
            'name' => $validated['name'],
            'fecha_nacimiento' => $validated['fecha_nacimiento'],
            'edad' => $edad,
            'migrante' => $validated['migrante'],
            'pueblos' => $validated['pueblos'],
            'Escolaridad' => $validated['Escolaridad'],
            'Ocupacion' => $validated['Ocupacion'],
            'distancia' => $validated['distancia'],
            'tiempo' => $validated['tiempo'],
            'comunidad' => $validated['comunidad'],
            'telefono' => $validated['telefono'],
        ]);

        
        $embarazo = Embarazo::create([
            'paciente_cui' => $paciente->cui,
            'fecha_ultima_regla' => $validated['fecha_ultima_regla'],
            'fecha_probable_parto' => $validated['fecha_probable_parto'],
        ]);

        session(['step1' => array_merge($validated, ['edad' => $edad, 'embarazo_id' => $embarazo->id])]);




        return redirect()->route('registro.paso2');
    }



   
    public function step2()
    {
        $datos = session('step2', []);
        $currentStep = 2;
        $totalSteps = 5;
        return view('layouts.Datos_Esposo', compact('datos', 'currentStep', 'totalSteps'));
    }

    
    public function storeStep2(Request $request)
    {
        
        $validated = $request->validate([
            'cui' => 'required|numeric',
            'nombreEsposo' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'pueblos' => 'required|string',
            'Escolaridad' => 'nullable|string',
            'estado_civil' => 'nullable|string',
            'Ocupacion' => 'nullable|string',
        ], [
            'cui.required' => 'El CUI es obligatorio.',
            'cui.numeric' => 'El CUI debe ser un número.',
            'cui.unique' => 'El CUI ya está registrado.',
            'nombreEsposo.required' => 'El nombre del encargado es obligatorio.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'pueblos.required' => 'Debes seleccionar un pueblo.',
            'pueblos.string' => 'La selección del pueblo es inválida.',
        ]);


        $fechaNacimiento = new \DateTime($validated['fecha_nacimiento']);
        $fechaActual = new \DateTime();
        $edad = $fechaActual->diff($fechaNacimiento)->y;


        $pacienteCui = session('step1')['cui'];


        Encargado::updateOrCreate(
            ['cui' => $validated['cui']], // Condición para buscar el paciente existente
            [
            'paciente_cui' => $pacienteCui,
            'nombreEsposo' => $validated['nombreEsposo'],
            'fecha_nacimiento' => $validated['fecha_nacimiento'],
            'edad' => $edad,
            'pueblos' => $validated['pueblos'],
            'Escolaridad' => $validated['Escolaridad'],
            'Ocupacion' => $validated['Ocupacion'],
            'estado_civil' => $validated['estado_civil'],
        ]);


        session(['step2' => array_merge($validated, ['edad' => $edad])]);
        session()->flash('success', 'Paciente y encargado registrados correctamente.');

        
        $embarazo_id = session('step1')['embarazo_id'];
       


        return redirect()->route('antecedentes.show', ['embarazo_id' => $embarazo_id]);
    }  
    public function listarpacientes(Request $request)
    {
        $search = $request->input('search');
        $pacientes = Paciente::when($search, function ($query, $search) {
            return $query->where('cui', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%");
        })->paginate(10);

        return view('layouts.listado_pacientes', compact('pacientes'));
    }
}
