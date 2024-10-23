<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraficaController extends Controller
{
    public function mostrarCobertura()
    {
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

  
        $casosReales = [1, 4, 3, 2, 6, 10, 5, 0, 0, 0, 0, 0]; 
        $totalEmbarazadas = 98; 

      
        $embarazosEsperadosPorMes = [6, 6, 6, 6, 6, 10, 10, 8, 9, 9, 12, 14];
        
        
        $rezagos = [];
        $coberturaMensual = [];
        $coberturaAcumulada = [];
        $coberturaAcumuladaAnterior = 0; 

       
        $rezagoAcumuladoAnterior = 0;

        foreach ($casosReales as $index => $casos) {
            $rezagoMes = $embarazosEsperadosPorMes[$index] - $casos;
            if ($rezagoMes < 0) $rezagoMes = 0; 

         
            $rezagoTotal = $rezagoMes + $rezagoAcumuladoAnterior;

          
            $rezagos[] = $rezagoTotal;

        
            $rezagoAcumuladoAnterior = $rezagoTotal;

       
            $coberturaMes = ($casos / $totalEmbarazadas) * 100;
            
           
            $coberturaAcumuladaMes = $coberturaAcumuladaAnterior + $coberturaMes;

        
            $coberturaMensual[] = round($coberturaMes, 2);
            $coberturaAcumulada[] = round($coberturaAcumuladaMes, 2);

        
            $coberturaAcumuladaAnterior = $coberturaAcumuladaMes;
        }

       
        $coberturaIdeal = [8, 17, 25, 33, 41, 50, 58, 67, 75, 83, 92, 100];

      
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
