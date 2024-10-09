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
        $embarazosEsperadosPorMes = [12, 9, 14, 11, 16, 8, 10, 13, 15, 9, 12, 14]; // Valores variados para cada mes
        // Diferentes embarazos esperados por mes
        // Embarazos esperados por mes
        $embarazosEsperadosAnuales = array_sum($embarazosEsperadosPorMes);
        // Variables para almacenar cálculos
        $resagos = [];
        $coberturaMensual = [];
        $coberturaAcumulada = [];
        $totalCasosAcumulados = 0;

        foreach ($casosReales as $index => $casos) {
            $embarazosEsperados = $embarazosEsperadosPorMes[$index];
            $resago =$embarazosEsperados - $casos;
            $coberturaMes = ($casos / $embarazosEsperados) * 100;
            $totalCasosAcumulados += $casos;
            $coberturaAcumuladaMes = ($totalCasosAcumulados / $embarazosEsperadosAnuales) * 100;

            $resagos[] = $resago;
            $coberturaMensual[] = round($coberturaMes, 2);
            $coberturaAcumulada[] = round($coberturaAcumuladaMes, 2);
        }

        $coberturaIdeal = [8, 17, 25, 33, 41, 50, 58, 67, 75, 83, 92, 100]; // Cobertura ideal mes a mes

        return view('layouts.graficacobertura', compact('meses', 'casosReales', 'resagos', 'coberturaMensual', 'coberturaAcumulada', 'coberturaIdeal', 'embarazosEsperados','embarazosEsperadosPorMes'));
    }
}
