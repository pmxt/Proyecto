<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamenFisico;
use App\Models\consulta1;

class  examen1Controller extends Controller
{

    public function obtener($consultaId)
    {
        $datos = session('obtener2', []);
        $currentStep = 2;
        $totalSteps = 4;

        return view('layouts.examen_fisico', compact('datos', 'currentStep', 'totalSteps'));
    }

    public function guardar(Request $request)
    {
        $validated = $request->validate([

            'presion_arterial' => 'required|string',
            'temperatura_corporal' => 'required|string',
            'peso' => 'required|numeric',
            'frecuencia_respiratoria' => 'required|numeric',
            'frecuencia_cardiaca_materna' => 'required|numeric',
            'estado_general' => 'required|string',
            'examen_bucal' => 'required|string',
            'altura_uterina' => 'required|string',
            'movimientos_fetales' => 'required|string',
            'frecuencia_cardiaca_fetal' => 'required|string',
            'leopoldo' => 'required|string',
            'trazas_sangre' => 'required|string',
            'verrugas' => 'required|string',
            'flujo_vaginal' => 'required|string',
            'hemoglobina' => 'required|string',
            'grupo_rh' => 'required|string',
            'orina' => 'required|string',
            'glicemia' => 'required|string',
            'vdrl' => 'required|string',
            'vih' => 'required|string',
            'papanicolau' => 'required|string',
            'infecciones' => 'required|string',
            'semanas_embarazo' => 'required|string',
            'problemas_detectados' => 'required|string',

        ]);

        // obtener el id de la consulta 
        
        $consultaId = session('obtener1')['id'];

        // Crear el examen físico relacionado con la consulta prenatal
        ExamenFisico::create([
            'consulta_prenatal_id' => $consultaId,
            'presion_arterial' => $validated['presion_arterial'],
            'temperatura_corporal' => $validated['temperatura_corporal'],
            'peso' => $validated['peso'],
            'frecuencia_respiratoria' => $validated['frecuencia_respiratoria'],
            'frecuencia_cardiaca_materna' => $validated['frecuencia_cardiaca_materna'],
            'estado_general' => $validated['estado_general'],
            'examen_bucal' => $validated['examen_bucal'],
            'altura_uterina' => $validated['altura_uterina'],
            'movimientos_fetales' => $validated['movimientos_fetales'],
            'frecuencia_cardiaca_fetal' => $validated['frecuencia_cardiaca_fetal'],
            'leopoldo' => $validated['leopoldo'],
            'trazas_sangre' => $validated['trazas_sangre'],
            'verrugas' => $validated['verrugas'],
            'flujo_vaginal' => $validated['flujo_vaginal'],
            'hemoglobina' => $validated['hemoglobina'],
            'grupo_rh' => $validated['grupo_rh'],
            'orina' => $validated['orina'],
            'glicemia' => $validated['glicemia'],
            'vdrl' => $validated['vdrl'],
            'vih' => $validated['vih'],
            'papanicolau' => $validated['papanicolau'],
            'infecciones' => $validated['infecciones'],
            'semanas_embarazo' => $validated['semanas_embarazo'],
            'problemas_detectados' => $validated['problemas_detectados'],
        ]);
        session(['datos' => $validated]);
        

        // Redirigir al siguiente paso
        return redirect()->route('consulta.Obtener')->with('success', 'Examen físico guardado correctamente');
    }
}
