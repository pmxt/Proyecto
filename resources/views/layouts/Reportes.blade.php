@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
  
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Seleccionar Reporte para Descargar</h2>

        <div class="mb-4">
            <a href="{{ route('pacientes.listar') }}" class="btn btn-primary">Volver</a>
        </div>
        <form action="{{ route('reporte-paciente') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="paciente_cui">CUI de la paciente</label>
                    <input type="text" name="paciente_cui" id="paciente_cui" class="form-control" value="{{ $paciente->cui }}" readonly>
                </div>
        
                <div class="form-group col-md-6">
                    <label for="paciente_nombre">Nombre de la paciente</label>
                    <input type="text" name="paciente_nombre" id="paciente_nombre" class="form-control" value="{{ $paciente->name }}" readonly>
                </div>
            </div>
        
            <div class="form-group">
                <label for="embarazo_id">Selecciona el embarazo:</label>
                <select name="embarazo_id" id="embarazo_id" class="form-control" required>
                    <option value="" disabled selected>-- Selecciona un embarazo --</option>
                    @foreach($embarazos as $embarazo)
                        <option value="{{ $embarazo->id }}">
                            Embarazo {{ $embarazo->id }} - Fecha probable de parto: {{ $embarazo->fecha_probable_parto }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <div class="form-group">
                <label for="reporte">Selecciona el tipo de reporte:</label>
                <select name="reporte" id="reporte" class="form-control" required>
                    <option value="" disabled selected>-- Selecciona un reporte --</option>
                    <option value="obstetrico">Reporte Ficha Obstétrica</option>
                    <option value="prenatal">Reporte Prenatal</option>
                    <option value="seguimiento">Reporte Seguimiento</option>
                    <option value="examen">Reporte Examen</option>
                </select>
            </div>
        
            <button type="submit" class="btn btn-primary mt-4">Descargar Reporte</button>
        </form>
    </div>
@endsection
