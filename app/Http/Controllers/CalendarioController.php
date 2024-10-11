<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\CitasNotification;
use App\Models\consulta1;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class CalendarioController extends Controller
{

    public function index()
    {
        return view('layouts.fullcalendar');
    }


    public function getCitas()
    {

        // Obtener las citas de la base de datos
        $citas = consulta1::with('paciente')
            ->select('id', 'fecha_consulta as start', 'motivo_consulta as title', 'paciente_cui')
            ->get();

        $citasFormatted = $citas->map(function ($cita) {
            return [
                'id' => $cita->id,
                'start' => $cita->start,
                'title' => $cita->title,
                'paciente' => $cita->paciente->name,
            ];
        });

        // Verificar si hay citas en la fecha actual
        $fechaHoy = Carbon::now()->format('Y-m-d');
        $citasHoy = $citas->filter(function ($cita) use ($fechaHoy) {
            return Carbon::parse($cita->start)->format('Y-m-d') === $fechaHoy;
        });

        // Si hay citas hoy, enviar notificación
        if ($citasHoy->isNotEmpty()) {
            $listaCitas = $citasHoy->pluck('title')->implode(', ');

            // Enviar la notificación al usuario autenticado
            $user = Auth::user();
            
            // Enviar la notificación al usuario autenticado
            $user->notify(new CitasNotification($listaCitas));
        }
        // Devolver las citas en formato JSON
        return response()->json($citasFormatted);
    }
}
