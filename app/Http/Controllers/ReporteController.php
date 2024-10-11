<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Encargado;
use App\Models\antecedenteObstetrico;
use App\Models\Embarazo as ModelsEmbarazo;
use App\Models\Historial;
use App\Models\ModeloEmbarazo_Actual;
use App\Models\consulta1;
use App\Models\ExamenFisico;
use App\Models\ModelSignos_peligro;
use App\Models\ModeloConsejeria;
use App\Models\SuplementoAsignado;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    // Muestra la vista para seleccionar el tipo de reporte
    public function mostrarVista($pacienteCui)
    {
        $paciente = Paciente::where('cui', $pacienteCui)->firstOrFail();
        return view('layouts.Reportes', compact('paciente'));
    }

    // Controla la lógica de selección del reporte
    public function descargarReporte(Request $request)
    {
        // Obtener el CUI y el tipo de reporte seleccionado
        $pacienteCui = $request->input('paciente_cui');
        $tipoReporte = $request->input('reporte');

        // Redirige a la ruta correspondiente en función del tipo de reporte seleccionado
        switch ($tipoReporte) {
            case 'obstetrico':
                return redirect()->route('reporte.obstetrico', $pacienteCui);
            case 'prenatal':
                return redirect()->route('reporte.prenatal', $pacienteCui);
            case 'seguimiento':
                return redirect()->route('reporte.seguimiento', $pacienteCui);
            case 'examen':
                return redirect()->route('reporte.examen', $pacienteCui);
            default:
                return back()->withErrors('Reporte no válido seleccionado.');
        }
    }

    // Métodos individuales para generar y descargar cada reporte
    public function reporteObstetrico($pacienteCui)
    {
        $paciente = Paciente::where('cui', $pacienteCui)->firstOrFail();

        // Buscar el encargado relacionado con el paciente
        $encargado = Encargado::where('paciente_cui', $pacienteCui)->first();
    
        // Buscar los antecedentes obstétricos relacionados con el paciente
        $antecedentesObstetricos = antecedenteObstetrico::where('paciente_cui', $pacienteCui)->first();
    
        // Buscar los datos del embarazo relacionados con el paciente
        $embarazo = ModelsEmbarazo::where('paciente_cui', $pacienteCui)->first();
    
        // Buscar los datos del historial clínico relacionados con el paciente
        $historialClinico = Historial::where('paciente_cui', $pacienteCui)->first();
    
        // Generar el PDF usando la vista reportes.obstetrico
        $pdf = PDF::loadView('reportes.obstetrico', compact('paciente', 'encargado', 'antecedentesObstetricos', 'embarazo', 'historialClinico'));
    
        // Descargar el PDF
        return $pdf->download('reporte_obstetrico.pdf');
    }

    public function reportePrenatal($pacienteCui)
    {
           // Buscar el paciente por CUI
           $paciente = Paciente::where('cui', $pacienteCui)->firstOrFail();

           // Buscar la primera consulta prenatal relacionada con el paciente
           $consulta = consulta1::where('paciente_cui', $pacienteCui)->first();
   
           // Buscar otros datos del embarazo si son necesarios
           $embarazo = ModelsEmbarazo::where('paciente_cui', $pacienteCui)->first();
   
           // Generar el PDF usando la vista reportes.prenatal
           $pdf = PDF::loadView('reportes.prenatal', compact('paciente', 'consulta', 'embarazo'));
   
           // Descargar el PDF
           return $pdf->download('reporte_prenatal.pdf');
    }

    public function reporteSeguimiento($pacienteCui)
    {
         // Buscar el paciente por CUI
         $paciente = Paciente::where('cui', $pacienteCui)->firstOrFail();

         // Buscar los controles de seguimiento relacionados con el paciente
         $controles = ModeloEmbarazo_Actual::where('paciente_cui', $pacienteCui)->get();
 
         // Generar el PDF usando la vista reportes.seguimiento
         $pdf = PDF::loadView('reportes.seguimiento', compact('paciente', 'controles'));
 
         // Descargar el PDF
         return $pdf->download('reporte_seguimiento.pdf');
    }

    public function reporteExamen($pacienteCui)
    {
        $paciente = Paciente::where('cui', $pacienteCui)->firstOrFail();

        // Obtener la última consulta del paciente
        $consulta = consulta1::where('paciente_cui', $pacienteCui)->latest()->first();

        // Obtener los datos del examen físico relacionados con la consulta
        $examenFisico = ExamenFisico::where('consulta_prenatal_id', $consulta->id)->first();

        // Obtener los signos y síntomas de peligro relacionados con el examen físico
        $signosPeligro = ModelSignos_peligro::where('examen_fisico_id', $examenFisico->id)->first();

        // Obtener los datos de consejería relacionados con el examen físico
        $consejeria = ModeloConsejeria::where('examen_fisico_id', $examenFisico->id)->first();

        // Obtener los medicamentos asignados
        $medicamentosAsignados = SuplementoAsignado::where('examen_fisico_id', $examenFisico->id)->get();

        // Generar el PDF usando la vista reportes.examen
        $pdf = PDF::loadView('reportes.examen', compact('paciente', 'consulta', 'examenFisico', 'signosPeligro', 'consejeria', 'medicamentosAsignados'));

        // Descargar el PDF
        return $pdf->download('reporte_examen.pdf');
    }
}
