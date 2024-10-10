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
        
        // Pasar los datos a la vista
        $pdf = PDF::loadView('layouts.Reporte', compact('pacientes'));

        // Descargar el PDF
        return $pdf->download('reporte-todos-los-pacientes.pdf');
      
    }
}
