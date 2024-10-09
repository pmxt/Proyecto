<?php

namespace App\Http\Controllers;

use App\Models\consulta1;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    // Muestra la vista del calendario
    public function index()
    {
        return view('layouts.fullcalendar');
    }

    // Obtiene las citas desde la base de datos
    public function getCitas()
    {
        // Obtenemos las citas desde la base de datos junto con el nombre del paciente asociado
        $citas = consulta1::with('paciente') // Asegúrate de tener una relación definida entre 'consulta1' y 'Paciente'
            ->select('id', 'fecha_consulta as start', 'motivo_consulta as title', 'paciente_cui')
            ->get();

        // Devolvemos los eventos en formato JSON incluyendo el nombre del paciente
        $citasFormatted = $citas->map(function ($cita) {
            return [
                'id' => $cita->id,
                'start' => $cita->start,
                'title' => $cita->title,
                'paciente' => $cita->paciente->name, // Asegúrate que 'paciente' es la relación correcta en tu modelo
            ];
        });

        // Devolvemos los eventos en formato JSON
        return response()->json($citasFormatted);
    }
}
