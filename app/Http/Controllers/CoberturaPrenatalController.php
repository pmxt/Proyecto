<?php

namespace App\Http\Controllers;

use App\Models\CoberturaPrenatal;
use Illuminate\Http\Request;

class CoberturaPrenatalController extends Controller
{
    // Mostrar la gráfica para un año específico
    public function verGrafica(Request $request)
{
    // Obtiene el año seleccionado o el año actual por defecto
    $anioSeleccionado = $request->input('anio', date('Y'));

    // Obtener los meses
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    // Recuperar los datos de la base de datos para ese año
    $cobertura = CoberturaPrenatal::where('anio', $anioSeleccionado)->orderBy('mes')->get();

    // Si no hay datos en la base de datos, inicializamos con un arreglo vacío
    if ($cobertura->isEmpty()) {
        $cobertura = collect(array_fill(0, 12, (object)[
            'embarazos_realizados' => 0,
            'embarazos_esperados' => 0,
            'servicio_salud' => '',
            'distrito_salud' => '',
            'area_salud' => '',
            'poblacion_meta' => 0,
        ]));
    }

    // Obtener los datos de "casos reales" (embarazos realizados) por mes
    $casosReales = $cobertura->pluck('embarazos_realizados')->toArray();

    // Obtener los embarazos esperados por mes
    $embarazosEsperadosPorMes = $cobertura->pluck('embarazos_esperados')->toArray();

    // Calcular el total de embarazos esperados para el año
    $embarazosEsperados = array_sum($embarazosEsperadosPorMes);
    $poblacionMeta = $cobertura->first()->poblacion_meta ?? 0;

    // Obtener los datos generales del primer registro
    $servicioSalud = $cobertura->first()->servicio_salud ?? '';
    $distritoSalud = $cobertura->first()->distrito_salud ?? '';
    $areaSalud = $cobertura->first()->area_salud ?? '';
    $poblacionMeta = $cobertura->first()->poblacion_meta ?? 0;

    // Variables para almacenar cálculos
    $rezagos = [];
    $coberturaAcumulada = [];
    $coberturaMensual = [];
    $coberturaTotalAcumulada = 0;
    $rezagoAcumuladoAnterior = 0; // Rezago acumulado desde el mes anterior

    // Cálculos por cada mes
    foreach ($cobertura as $index => $mesData) {
        // Calcular el rezago del mes actual
        $rezagoMes = $embarazosEsperadosPorMes[$index] - $mesData->embarazos_realizados;
        $rezagoMes = $rezagoMes > 0 ? $rezagoMes : 0; // Asegurarse de no tener rezagos negativos

        // Sumar el rezago anterior
        $rezagoTotal = $rezagoMes + $rezagoAcumuladoAnterior;
        $rezagos[] = $rezagoTotal;

        // Actualizar el rezago acumulado para el siguiente mes
        $rezagoAcumuladoAnterior = $rezagoTotal;

        // Verificar si la población meta es mayor a 0 para evitar división por cero
        if ($poblacionMeta > 0) {
            $coberturaMes = ($mesData->embarazos_realizados / $poblacionMeta) * 100;
        } else {
            $coberturaMes = 0; // Si no hay población meta, la cobertura es 0
        }

        $coberturaMensual[] = round($coberturaMes, 2);

        // Calcular la cobertura acumulada sumando lo del mes anterior
        $coberturaTotalAcumulada += $coberturaMes;
        $coberturaAcumulada[] = round($coberturaTotalAcumulada, 2);
    }

    // Calcular cobertura ideal
    $coberturaIdeal = [];
    $coberturaIdealMes = 0;
    foreach ($meses as $mes) {
        $coberturaIdealMes += 100 / 12; // Cobertura ideal total debe ser 100% al final del año
        $coberturaIdeal[] = round($coberturaIdealMes, 2);
    }

    // Obtener los años disponibles
    $anios = CoberturaPrenatal::distinct()->pluck('anio');

    // Pasar datos a la vista
    return view('layouts.graficaCobertura', compact(
        'meses',
        'casosReales',
        'embarazosEsperadosPorMes',
        'coberturaAcumulada',
        'coberturaIdeal',
        'anios',
        'anioSeleccionado',
        'servicioSalud',
        'distritoSalud',
        'areaSalud',
        'poblacionMeta',
        'embarazosEsperados',
        'rezagos',
        'coberturaMensual'
    ));
}





    // Guardar los datos ingresados de un año
    public function guardarDatos(Request $request)
    {
        foreach ($request->embarazos_realizados as $index => $realizados) {
            CoberturaPrenatal::updateOrCreate(
                [
                    'anio' => $request->anio,
                    'mes' => $index + 1, // Meses van del 1 al 12
                ],
                [
                    'servicio_salud' => $request->servicio_salud,
                    'distrito_salud' => $request->distrito_salud,
                    'area_salud' => $request->area_salud,
                    'poblacion_meta' => $request->poblacion_meta,
                    'embarazos_esperados' => $request->embarazos_esperados[$index],
                    'embarazos_realizados' => $realizados,
                ]
            );
        }

        return back()->with('success', 'Datos guardados correctamente y gráfica actualizada.');
    }


    // Mostrar formulario para agregar un nuevo año
    public function mostrarFormularioAnio()
    {
        return view('layouts.ingresarAnio');
    }

    // Guardar los datos de un nuevo año
    public function guardarAnio(Request $request)
    {
        // Asignar el valor de enero (1) si el campo 'mes' no está presente en la solicitud
        $mes = $request->mes ?? 'Enero';  // Si no se envía un mes, se asigna enero (1)

        // Verificar si ya existe un registro para el año y mes
        $registroAnioMes = CoberturaPrenatal::where('anio', $request->anio)
            ->where('mes', $mes)
            ->first();

        if (!$registroAnioMes) {
            // Crear un nuevo registro para el año y mes (enero si no se especifica otro mes)
            CoberturaPrenatal::create([
                'anio' => $request->anio,
                'mes' => $mes, // Aquí se asegura que 'mes' tenga el valor de enero (1) si no se especifica
                'servicio_salud' => $request->servicio_salud,
                'distrito_salud' => $request->distrito_salud,
                'area_salud' => $request->area_salud,
                'poblacion_meta' => $request->poblacion_meta,
                'embarazos_realizados' => 0,
                'embarazos_esperados' => 0,
            ]);

            return redirect()->route('verGrafica', ['anio' => $request->anio])
                ->with('success', 'Nuevo año y mes guardados correctamente.');
        } else {
            return back()->with('error', 'Ya existe un registro para este año y mes.');
        }
    }



    public function mostrarFormularioMes($anio)
    {
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        return view('layouts.ingresarMes', compact('anio', 'meses'));
    }

    public function guardarMes(Request $request)
    {
        // Recuperar los datos del año existente para obtener los datos estáticos
        $anioData = CoberturaPrenatal::where('anio', $request->anio)->first();

        if ($anioData) {
            // Crear o actualizar el registro para el mes específico, manteniendo los datos estáticos
            CoberturaPrenatal::updateOrCreate(
                [
                    'anio' => $request->anio,
                    'mes' => $request->mes, // El mes que estás actualizando o creando
                ],
                [
                    'embarazos_esperados' => $request->embarazos_esperados,
                    'embarazos_realizados' => $request->embarazos_realizados,
                    'servicio_salud' => $anioData->servicio_salud, // Recuperar datos estáticos del año
                    'distrito_salud' => $anioData->distrito_salud,
                    'area_salud' => $anioData->area_salud,
                    'poblacion_meta' => $anioData->poblacion_meta // Mantener la población meta del año existente
                ]
            );

            return redirect()->route('verGrafica', ['anio' => $request->anio])
                ->with('success', 'Datos del mes guardados correctamente.');
        }

        return back()->with('error', 'No se encontraron datos para el año seleccionado.');
    }
}
