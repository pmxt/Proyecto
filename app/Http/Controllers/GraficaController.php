<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraficaController extends Controller
{
    public function mostrarCobertura()
    {
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        // Datos de ejemplo
        $casosReales = [1, 4, 3, 2, 6, 10, 5, 0, 0, 0, 0, 0]; // Cambia según tus datos reales
        $totalEmbarazadas = 98; // Muestra total

        // Definir embarazos esperados para cada mes
        $embarazosEsperadosPorMes = [6, 6, 6, 6, 6, 10, 10, 8, 9, 9, 12, 14];
        
        // Variables para almacenar cálculos
        $rezagos = [];
        $coberturaMensual = [];
        $coberturaAcumulada = [];
        $coberturaAcumuladaAnterior = 0; // Esto será lo que acumulamos del mes anterior

        // Variable para almacenar rezago acumulado
        $rezagoAcumuladoAnterior = 0;

        foreach ($casosReales as $index => $casos) {
            // Calcular el rezago del mes actual
            // El rezago del mes es la diferencia entre los embarazos esperados y los casos reales, sumado al rezago acumulado del mes anterior
            $rezagoMes = $embarazosEsperadosPorMes[$index] - $casos;
            if ($rezagoMes < 0) $rezagoMes = 0; // Evitar rezagos negativos

            // Sumar el rezago anterior acumulado
            $rezagoTotal = $rezagoMes + $rezagoAcumuladoAnterior;

            // Guardar el rezago total del mes actual
            $rezagos[] = $rezagoTotal;

            // Actualizar el rezago acumulado para el siguiente mes
            $rezagoAcumuladoAnterior = $rezagoTotal;

            // Calcular la cobertura mensual
            $coberturaMes = ($casos / $totalEmbarazadas) * 100;
            
            // Calcular la cobertura acumulada sumando lo del mes anterior
            $coberturaAcumuladaMes = $coberturaAcumuladaAnterior + $coberturaMes;

            // Redondeo según lo acordado (mayor o menor a 0.5)
            $coberturaMensual[] = round($coberturaMes, 2);
            $coberturaAcumulada[] = round($coberturaAcumuladaMes, 2);

            // Actualizar la cobertura acumulada para el siguiente mes
            $coberturaAcumuladaAnterior = $coberturaAcumuladaMes;
        }

        // Cobertura ideal mes a mes (esto lo mantienes igual)
        $coberturaIdeal = [8, 17, 25, 33, 41, 50, 58, 67, 75, 83, 92, 100];

        // Pasar las variables a la vista
        return view('layouts.graficacobertura', compact(
            'meses', 
            'casosReales', 
            'rezagos', 
            'coberturaMensual', 
            'coberturaAcumulada', 
            'coberturaIdeal', 
            'embarazosEsperadosPorMes'
        ));
    }
}
