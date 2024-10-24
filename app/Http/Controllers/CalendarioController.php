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
        
        $citas = consulta1::with('paciente') 
            ->select('id', 'fecha_consulta as start', 'motivo_consulta as title', 'paciente_cui')
            ->get();

     
        $citasFormatted = $citas->map(function ($cita) {
            return [
                'id' => $cita->id,
                'start' => $cita->start,
                'title' => $cita->title . ' - ' . ($cita->paciente ? $cita->paciente->name : 'Sin paciente'), 
            ];
        });

       
        return response()->json($citasFormatted);
    }

    
    public function verificarCitasDiarias()
    {
       
        $citas = consulta1::select('id', 'fecha_consulta', 'motivo_consulta', 'paciente_cui')
            ->with('paciente') 
            ->get();
    
      
        $fechaHoy = Carbon::now()->format('Y-m-d');
        $citasHoy = $citas->filter(function ($cita) use ($fechaHoy) {
            return Carbon::parse($cita->fecha_consulta)->format('Y-m-d') === $fechaHoy;
        });
    
       
        if ($citasHoy->isNotEmpty()) {
            $listaCitas = $citasHoy->map(function ($cita) {
                return "Cita para: " . ($cita->paciente ? $cita->paciente->name : 'Sin paciente') . 
                       " - Motivo: " . $cita->motivo_consulta . 
                       " a las " . Carbon::parse($cita->fecha_consulta)->format('H:i');
            })->implode(', ');
    
           
            $user = Auth::user(); 
    
            $user->notify(new CitasNotification($listaCitas));
        }
        $citasFormatted = $citasHoy->map(function ($cita) {
            return [
                'id' => $cita->id,
                'motivo' => $cita->motivo_consulta,
                'paciente' => $cita->paciente ? $cita->paciente->name : 'Sin paciente',
                'fecha' => Carbon::parse($cita->fecha_consulta)->format('H:i'),
            ];
        });
    
     
        return response()->json($citasFormatted);
    }

    
    public function enviarNotificacionPrueba()
    {
        
        $user = Auth::find(1);

        
        $detalleCita = "Tu cita es el 25 de octubre a las 10:00 AM.";

    
        $user->notify(new CitasNotification($detalleCita));

        return "Notificación de prueba enviada!";
    }
}
