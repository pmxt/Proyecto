<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comadronas;

class ComadronasController extends Controller
{

    public function mostrarGrafica3(Request $request)
    {
        $anioSeleccionado = $request->input('anio', date('Y'));
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    
       
        $cobertura = comadronas::where('anio', $anioSeleccionado)->orderBy('mes')->get();
    
       
        if ($cobertura->isEmpty()) {
            $cobertura = collect(array_fill(0, 12, (object)[
                'partos_atendidos' => 0,
                'cobertura_mensual' => 0,
                'cobertura_acumulada' => 0,
                'servicio_salud' => 'Servicio no disponible',
                'distrito_salud' => 'Distrito no disponible',
                'area_salud' => 'Área no disponible',
                'poblacion_total' => 0,
                'poblacion_meta' => 0,
            ]));
        }
    
        $servicioSalud = $cobertura->first()->servicio_salud ?? 'Servicio no disponible';
        $distritoSalud = $cobertura->first()->distrito_salud ?? 'Distrito no disponible';
        $areaSalud = $cobertura->first()->area_salud ?? 'Área no disponible';
        $poblacionTotal = $cobertura->first()->poblacion_total ?? 0;
        $poblacionMeta = $cobertura->first()->poblacion_meta ?? 0;
    
        $anios = comadronas::distinct()->pluck('anio');
    
        return view('graficos.grafico3', compact(
            'meses',
            'cobertura',
            'anioSeleccionado',
            'anios',
            'servicioSalud',
            'distritoSalud',
            'areaSalud',
            'poblacionTotal',
            'poblacionMeta'
        ));
    
 }

    public function mostrarFormularioAnio()
    {
        return view('graficos.comadronas.anio_comadrona');
    }


    public function guardarAnio(Request $request)
    {
        $request->validate([
            'anio' => 'required|integer',
            'servicio_salud' => 'required|string',
            'distrito_salud' => 'required|string',
            'area_salud' => 'required|string',
            'poblacion_meta' => 'required|integer', 
        ]);
    
        comadronas::create([
            'anio' => $request->input('anio'),
            'mes' => 'Enero', 
            'partos_atendidos' => 0,
            'cobertura_mensual' => 0,
            'cobertura_acumulada' => 0, 
            'servicio_salud' => $request->input('servicio_salud'),
            'distrito_salud' => $request->input('distrito_salud'),
            'area_salud' => $request->input('area_salud'),
            'poblacion_meta' => $request->input('poblacion_meta'), 
        ]);
    
        return redirect()->route('comadronas.grafica', ['anio' => $request->input('anio')])
            ->with('success', 'Año y datos guardados correctamente.');
    }

    public function mostrarFormularioMes($anio)
    {

        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        return view('graficos.comadronas.mes_comadrona', compact('meses','anio'));
    }


    public function guardarMes(Request $request)
    {
        
        $request->validate([
            'anio' => 'required|integer',
            'mes' => 'required|string',
            'partos_atendidos' => 'required|integer',
        ]);

       
        $anioData = comadronas::where('anio', $request->anio)->first();

        if ($anioData) {
            comadronas::updateOrCreate(
                [
                    'anio' => $request->anio,
                    'mes' => $request->mes,
                ],
                [
                    'partos_atendidos' => $request->partos_atendidos,
                    'cobertura_mensual' => $this->calcularCoberturaMensual($request->partos_atendidos, $anioData->poblacion_meta),
                    'cobertura_acumulada' => $this->calcularCoberturaAcumulada($request->anio, $request->mes, $request->partos_atendidos),
                    'servicio_salud' => $anioData->servicio_salud,
                    'distrito_salud' => $anioData->distrito_salud,
                    'area_salud' => $anioData->area_salud,
                    'poblacion_meta' => $anioData->poblacion_meta,
                ]
            );

            return redirect()->route('comadronas.grafica', ['anio' => $request->anio])->with('success', 'Datos del mes guardados correctamente.');
        }

        return back()->with('error', 'No se encontraron datos para el año seleccionado.');
    }


    public function calcularCoberturaMensual($partosAtendidos, $poblacionMeta)
{
    if ($poblacionMeta > 0) {
        return round(($partosAtendidos / $poblacionMeta) * 100, 2);
    }
    return 0;
}

public function calcularCoberturaAcumulada($anio, $mes, $partosAtendidos)
{
   
    $coberturaMensual = $this->calcularCoberturaMensual($partosAtendidos, comadronas::where('anio', $anio)->first()->poblacion_meta);

    
    $mesesAnteriores = comadronas::where('anio', $anio)
                                  ->where('mes', '<', $mes)
                                  ->pluck('cobertura_mensual');

    
    $coberturaAcumulada = $mesesAnteriores->sum() + $coberturaMensual;

    return round($coberturaAcumulada, 2);
}
}
