<?php

namespace App\Http\Controllers;

use App\Models\consulta1;
use Illuminate\Http\Request;
use App\Models\ExamenFisico;
use App\Models\Medicamento;
use App\Models\Modelmedicamento;
use App\Models\SuplementoAsignado;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class AsignarMedicamentoController extends Controller
{

    public function obtener($examenFisicoId)
    {

        $medicamentos = Modelmedicamento::all();

        $examenFisico = ExamenFisico::with('consultaPrenatal.paciente')->findOrFail($examenFisicoId);
        $paciente = $examenFisico->consultaPrenatal->paciente;
        //dd($paciente->cui);

        $paciente = $examenFisico->consultaPrenatal->paciente;

        return view('layouts.asignar_medicamento', compact('medicamentos', 'examenFisicoId', 'paciente'));
    }

    public function guardar(Request $request, $examenFisicoId)
    {

        DB::beginTransaction();

        try {

            $validated = $request->validate([
                'paciente_cui' => 'required|string|exists:pacientes,cui',
                'medicamentos' => 'required|array',
                'cantidades' => 'required|array',
                'cantidades.*' => 'integer|min:1',
                'embarazo_id' => 'required|exists:embarazo,id',
            ]);


            foreach ($validated['medicamentos'] as $key => $medicamentoId) {
                $medicamento = Modelmedicamento::find($medicamentoId);
                $cantidadAsignada = $validated['cantidades'][$key];

                if ($medicamento->cantidad >= $cantidadAsignada) {

                    SuplementoAsignado::create([
                        'examen_fisico_id' => $examenFisicoId,
                        'medicamento_id' => $medicamentoId,
                        'cantidad_asignada' => $cantidadAsignada,
                        'embarazo_id' => $validated['embarazo_id'],
                    ]);


                    $medicamento->decrement('cantidad', $cantidadAsignada);
                } else {

                    throw new \Exception('No hay suficiente stock de ' . $medicamento->nombre);
                }
            }


            $citaAgendada = $this->agendarNuevaCita($examenFisicoId);


            if ($citaAgendada) {
                DB::commit();
                return redirect()->route('medicamentos.asignar', ['examenFisicoId' => $examenFisicoId])
                    ->with('success', 'Suplementos asignados correctamente y nueva cita agendada. Se ha generado un PDF con los detalles.');
            }


            throw new \Exception('No se pudo agendar una nueva cita.');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }


    private function agendarNuevaCita($examenFisicoId)
    {
       
        $examenFisico = ExamenFisico::with('consultaPrenatal.paciente')->findOrFail($examenFisicoId);
        $consultaPrenatal = $examenFisico->consultaPrenatal;
    
        
        $fechaControlActual = $consultaPrenatal->fecha_consulta; 
        $proximaFechaCita = \Carbon\Carbon::parse($fechaControlActual)->addMonth(); 
    
      
        $consulta = consulta1::create([
            'paciente_cui' => $consultaPrenatal->paciente_cui,
            'fecha_consulta' => $proximaFechaCita,
            'tipo_servicio' => $consultaPrenatal->tipo_servicio,
            'area_salud' => $consultaPrenatal->area_salud,
            'nombre_servicio' => $consultaPrenatal->nombre_servicio,
            'motivo_consulta' => 'Control Prenatal',
            'tipo_consulta' => 'Seguimiento',
            'embarazo_id' => $consultaPrenatal->embarazo_id,
        ]);
    
        
        session()->put('consultaId', $consulta->id);
    
        return true;
    }
    


    public function descargarReporteCita($consultaId)
    {

        $consultaPrenatal = consulta1::with('paciente')->findOrFail($consultaId);

        if (!$consultaPrenatal->paciente) {
            return redirect()->back()->withErrors('No se encontró el paciente para esta consulta.');
        }


        $embarazo = $consultaPrenatal->paciente->embarazos()->orderBy('fecha_probable_parto', 'desc')->first();


        if (!$embarazo) {
            return redirect()->back()->withErrors('No se encontró un embarazo asociado al paciente.');
        }

        $proximaFechaCita = \Carbon\Carbon::parse($consultaPrenatal->fecha_consulta->toDateString())->format('d/m/Y');
        $fechaUltimaRegla = \Carbon\Carbon::parse($embarazo->fecha_ultima_regla)->format('d/m/Y');
        $fechaProbableParto = \Carbon\Carbon::parse($embarazo->fecha_probable_parto)->format('d/m/Y');



        $pdf = PDF::loadView('Reportes.reporte_cita', [
            'paciente' => $consultaPrenatal->paciente,
            'proximaFechaCita' =>  $proximaFechaCita,
            'motivo_consulta' => 'Control Prenatal',
            'area_salud' => $consultaPrenatal->area_salud,
            'nombre_servicio' => $consultaPrenatal->nombre_servicio,
            'fecha_probable_parto' => $fechaProbableParto,
            'fecha_ultima_regla' => $fechaUltimaRegla

        ]);


        return $pdf->download('reporte_cita_' . $consultaPrenatal->paciente->name . '.pdf');
    }
}
