<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraficaController extends Controller
{
    public function mostrarCobertura()
    {
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        // Datos de ejemplo
        $casosReales = [4, 5, 3, 2, 6, 10, 5, 0, 0, 0, 0, 0]; // Cambia según tus datos reales
        $totalEmbarazadas = 98; // Muestra total

        // Definir embarazos esperados para cada mes (puedes ajustar estos valores)
        $embarazosEsperadosPorMes = [1, 6, 6, 6, 6, 10, 10, 8, 9, 9, 12, 14];
        $embarazosEsperados = array_sum($embarazosEsperadosPorMes); // Total de embarazos esperados en el año

        // Variables para almacenar cálculos
        $rezagos = [];
        $coberturaMensual = [];
        $coberturaAcumulada = [];
        $coberturaAcumuladaAnterior = 0; // Esto será lo que acumulamos del mes anterior

        foreach ($casosReales as $index => $casos) {
            // Calcular la cobertura mensual en base a los casos de cada mes
            $coberturaMes = ($casos / $totalEmbarazadas) * 100;

            // Calcular la cobertura acumulada sumando lo del mes anterior
            $coberturaAcumuladaMes = $coberturaAcumuladaAnterior + $coberturaMes;

            // Redondeo según lo acordado (mayor o menor a 0.5)
            $coberturaMensual[] = round($coberturaMes);
            $coberturaAcumulada[] = round($coberturaAcumuladaMes);

            // Actualizar la cobertura acumulada para el siguiente mes
            $coberturaAcumuladaAnterior = $coberturaAcumuladaMes;
        }

        $coberturaIdeal = [8, 17, 25, 33, 41, 50, 58, 67, 75, 83, 92, 100]; // Cobertura ideal mes a mes

        // Pasar las variables a la vista
        return view('layouts.graficacobertura', compact(
            'meses', 
            'casosReales', 
            'rezagos', 
            'coberturaMensual', 
            'coberturaAcumulada', 
            'coberturaIdeal', 
            'embarazosEsperados', 
            'embarazosEsperadosPorMes'
        ));
    }
}
