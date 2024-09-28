<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente; // Asegúrate de incluir el modelo Paciente
use App\Models\Encargado;

class R_ObstetricoController extends Controller
{
    public function step1()
    {
        $datos = session('step1', []); // Recupera los datos de la sesión, o un array vacío si no hay datos
        return view('layouts.nuevo_paciente', compact('datos')); // Pasa los datos a la vista
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'cui' => 'required|numeric|unique:pacientes,cui', // Asegura que el CUI sea único en la tabla pacientes
            'name' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'migrante' => 'required|string',
            'pueblos' => 'required|string',
            'Escolaridad' => 'nullable|string',
            'Ocupacion' => 'nullable|string',
            'distancia'=> 'nullable|string',
            'tiempo'=> 'nullable|string',
            'comunidad'=> 'nullable|string',
            'telefono'=> 'nullable|string',

        ], [
            'cui.required' => 'El CUI es obligatorio.',
            'cui.numeric' => 'El CUI debe ser un número.',
            'cui.unique' => 'El CUI ya está registrado.',
            'name.required' => 'El nombre de la embarazada es obligatorio.',
            'name.string' => 'El nombre debe ser texto.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'pueblos.required' => 'Debes seleccionar un pueblo.',
            'pueblos.string' => 'La selección del pueblo es inválida.',
            'Escolaridad.string' => 'La escolaridad debe ser texto.',
            'Ocupacion.string' => 'La ocupación debe ser texto.',
        ]);

        // Calcular la edad
        $fechaNacimiento = new \DateTime($validated['fecha_nacimiento']);
        $fechaActual = new \DateTime();
        $edad = $fechaActual->diff($fechaNacimiento)->y;

        // Guardar los datos del paciente en la base de datos
        $paciente = Paciente::create([
            'cui' => $validated['cui'],
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

        // Guardar en la sesión para el siguiente paso
        session(['step1' => array_merge($validated, ['edad' => $edad])]);

        return redirect()->route('registro.paso2');
    }


    public function step2()
    {
        $datos = session('step2', []); // Recupera los datos de la sesión, o un array vacío si no hay datos
        return view('layouts.datos_esposo', compact('datos')); // Pasa los datos a la vista
    }

    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'cui' => 'required|numeric|unique:encargados,cui', // Asegura que el CUI del encargado sea único en la tabla encargados
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
            'Escolaridad.string' => 'La escolaridad debe ser texto.',
            'Ocupacion.string' => 'La ocupación debe ser texto.',
        ]);

        // Calcular la edad del encargado
        $fechaNacimiento = new \DateTime($validated['fecha_nacimiento']);
        $fechaActual = new \DateTime();
        $edad = $fechaActual->diff($fechaNacimiento)->y;

        // Obtener el CUI del paciente desde la sesión (guardado en el paso 1)
        $pacienteCui = session('step1')['cui'];

        // Guardar los datos del encargado en la base de datos
        Encargado::create([
            'cui' => $validated['cui'], // CUI del encargado
            'paciente_cui' => $pacienteCui, // Relación con el paciente
            'nombreEsposo' => $validated['nombreEsposo'],
            'fecha_nacimiento' => $validated['fecha_nacimiento'],
            'edad' => $edad,
            'pueblos' => $validated['pueblos'],
            'Escolaridad' => $validated['Escolaridad'],
            'Ocupacion' => $validated['Ocupacion'],
            'estado_civil' => $validated['estado_civil'],
        ]);

        // Limpiar la sesión después de guardar todos los datos
        session()->forget('step1');
        session()->flash('success', 'Paciente y encargado registrados correctamente.');

        // Redirigir a una página de éxito
        return redirect()->route('registro.paso2');
    }


    public function listarpacientes(Request $request)
    {
        $search = $request->input('search'); // Recibe el valor de búsqueda
        $pacientes = Paciente::when($search, function($query, $search) {
            return $query->where('cui', 'LIKE', "%{$search}%")
                         ->orWhere('name', 'LIKE', "%{$search}%");
        })->paginate(10); 
    
        // Retornar la vista con la variable $pacientes
        return view('layouts.listado_pacientes', compact('pacientes'));
    }
    
}
