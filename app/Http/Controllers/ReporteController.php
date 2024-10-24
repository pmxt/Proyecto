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
use Intervention\Image\Facades\Image;


use Illuminate\Http\Request;

class ReporteController extends Controller
{

    public function mostrarVista($pacienteCui)
    {
        $paciente = Paciente::where('cui', $pacienteCui)->firstOrFail();

        $embarazos = $paciente->embarazos;
        return view('layouts.Reportes', compact('paciente', 'embarazos'));
    }



    public function descargarReporte(Request $request)
    {
        $pacienteCui = $request->input('paciente_cui');
        $embarazoId = $request->input('embarazo_id');
        $tipoReporte = $request->input('reporte');

        switch ($tipoReporte) {
            case 'obstetrico':
                return redirect()->route('reporte.obstetrico', ['pacienteCui' => $pacienteCui, 'embarazoId' => $embarazoId]);
            case 'prenatal':
                return redirect()->route('reporte.prenatal', ['pacienteCui' => $pacienteCui, 'embarazoId' => $embarazoId]);
            case 'seguimiento':
                return redirect()->route('reporte.seguimiento', ['pacienteCui' => $pacienteCui, 'embarazoId' => $embarazoId]);
            case 'examen':
                return redirect()->route('reporte.examen', ['pacienteCui' => $pacienteCui, 'embarazoId' => $embarazoId]);
            default:
                return back()->withErrors('Reporte no válido seleccionado.');
        }
    }


    public function reporteObstetrico($pacienteCui, $embarazoId)
    {
        $paciente = Paciente::where('cui', $pacienteCui)->firstOrFail();


        $embarazo = ModelsEmbarazo::where('paciente_cui', $pacienteCui)
            ->where('id', $embarazoId)
            ->firstOrFail();


        $antecedentesObstetricos = $embarazo->antecedenteObstetrico;
        $historialClinico = $embarazo->historial;


        $encargado = Encargado::where('paciente_cui', $pacienteCui)->first();


        $pdf = PDF::loadView('Reportes.obstetrico', compact('paciente', 'encargado', 'antecedentesObstetricos', 'embarazo', 'historialClinico'))
            ->setPaper('legal', 'portrait');

        return $pdf->download('reporte_obstetrico_' . $paciente->cui . '.pdf');
    }
    public function reportePrenatal($pacienteCui, $embarazoId)
    {

        $paciente = Paciente::where('cui', $pacienteCui)->firstOrFail();

        $embarazo = ModelsEmbarazo::where('paciente_cui', $pacienteCui)
            ->where('id', $embarazoId)
            ->firstOrFail();

        $consulta = consulta1::where('paciente_cui', $pacienteCui)
            ->where('embarazo_id', $embarazoId)
            ->first();

        $antecedentesObstetricos = $embarazo->antecedenteObstetrico;


        $historialClinico = $embarazo->historial;

        $encargado = Encargado::where('paciente_cui', $pacienteCui)->first();

        $examenFisico = ExamenFisico::where('consulta_prenatal_id', $consulta->id)->first();

        $signos = $examenFisico ? ModelSignos_peligro::where('examen_fisico_id', $examenFisico->id)->first() : null;


        $pdf = PDF::loadView('Reportes.prenatal', compact('paciente', 'embarazo', 'consulta', 'antecedentesObstetricos', 'historialClinico', 'encargado', 'signos'))
            ->setPaper('legal', 'portrait');


        return $pdf->download('reporte_prenatal_' . $paciente->cui . '.pdf');
    }





    public function reporteSeguimiento($pacienteCui, $embarazoId)
    {

        $paciente = Paciente::where('cui', $pacienteCui)->firstOrFail();


        $embarazo = ModelsEmbarazo::where('paciente_cui', $pacienteCui)
            ->where('id', $embarazoId)
            ->firstOrFail();


        $antecedentesObstetricos = $embarazo->antecedenteObstetrico;


        $historialClinico = $embarazo->historial;


        $encargado = Encargado::where('paciente_cui', $pacienteCui)->first();


        $controles = ModeloEmbarazo_Actual::where('embarazo_id', $embarazoId)->get();


        $pdf = PDF::loadView('Reportes.seguimiento', compact('paciente', 'embarazo', 'controles', 'antecedentesObstetricos', 'historialClinico', 'encargado'))
            ->setPaper('legal', 'portrait');


        return $pdf->download('reporte_seguimiento_' . $paciente->cui . '.pdf');
    }


    public function reporteExamen($pacienteCui, $embarazoId)
    {
        $paciente = Paciente::where('cui', $pacienteCui)->firstOrFail();




        $embarazo = ModelsEmbarazo::where('paciente_cui', $pacienteCui)
            ->where('id', $embarazoId)
            ->firstOrFail();
        $consulta = consulta1::where('paciente_cui', $pacienteCui)
            ->where('embarazo_id', $embarazoId)
            ->first();

        $antecedentesObstetricos = $embarazo->antecedenteObstetrico;


        $historialClinico = $embarazo->historial;


        $encargado = Encargado::where('paciente_cui', $pacienteCui)->first();


        $controles = ModeloEmbarazo_Actual::where('embarazo_id', $embarazoId)->get();

        $examenFisico = ExamenFisico::where('consulta_prenatal_id', $consulta->id)->first();
        $signosPeligro = $examenFisico ? ModelSignos_peligro::where('examen_fisico_id', $examenFisico->id)->first() : null;
        $consejeria = $examenFisico ? ModeloConsejeria::where('examen_fisico_id', $examenFisico->id)->first() : null;
      
        $medicamentosAsignados = $examenFisico ? SuplementoAsignado::where('examen_fisico_id', $examenFisico->id)->get() : collect();


        $pdf = PDF::loadView('Reportes.examen', compact('paciente', 'signosPeligro', 'medicamentosAsignados', 'consejeria', 'embarazo', 'examenFisico', 'controles', 'consulta', 'antecedentesObstetricos', 'historialClinico', 'encargado'))
            ->setPaper('legal', 'portrait');


        return $pdf->download('reporte_seguimiento_' . $paciente->cui . '.pdf');
    }
}