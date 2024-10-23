<?php


namespace App\Http\Controllers;

use App\Models\Paciente;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generarPDF()
    {
        $pacientes = Paciente::with('encargados','Historial')->get();
        
     
        $pdf = PDF::loadView('layouts.Reporte', compact('pacientes'));

        return $pdf->download('reporte-todos-los-pacientes.pdf');
      
    }
}
