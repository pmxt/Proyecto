@extends('layouts.app')

@section('title', 'Dashboard - Sistema de Control Prenatal')

@section('content_header')
    <h1 class="text-center">Sala situacional del puesto de salud del canton chotacaj totonicapan</h1>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection



@section('content')
    <div class="row">
   
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Control prenatal</h3>
                    <p>Cobertura acumulada</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <a href="{{ route('grafica1') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

      
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Embarazos Esperados</h3>
                    <p>Cobertura Anual acumulada</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <a href="{{ route('graficaPastel') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>Partos realizados por comadronas </h3>
                    <p>Porcentaje</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <a href="{{ route('comadronas.grafica') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>Partos realizados por Medicos</h3>
                    <p>Porcentaje </p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-area"></i>
                </div>
                <a href="{{ route('medicos.grafica') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log("Dashboard cargado exitosamente."); </script>
@stop
