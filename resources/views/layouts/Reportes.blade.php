@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    @vite('resources/css/app.css')
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
                <div class="form-group">
                    <label for="paciente_cui">CUI de la paciente</label>
                    <input type="text" name="paciente_cui" id="paciente_cui" class="form-control"
                        value="{{ $paciente->cui }}" readonly>
                </div>

                <div class="form-group">
                    <label for="paciente_nombre">Nombre de la paciente</label>
                    <input type="text" name="paciente_nombre" id="paciente_nombre" class="form-control"
                        value="{{ $paciente->name }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="reporte">Selecciona el tipo de reporte:</label>
                <select name="reporte" id="reporte" class="form-control">
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
