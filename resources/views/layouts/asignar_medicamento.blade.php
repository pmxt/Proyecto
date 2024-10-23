@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Asignar Suplementos a la Paciente</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    
        <!-- Botón para descargar el PDF -->
        <a href="{{ route('reporte.descargar', ['consultaId' => session('consultaId')]) }}" class="btn btn-secondary">
            <i class="fa fa-file-pdf-o"></i> Descargar PDF de la Cita
        </a>
    @endif
    

        <form
            action="{{ route('medicamentos.asignar.guardar', ['examenFisicoId' => $examenFisicoId, 'consultaId' => session('obtener1')['id']]) }}"
            method="POST">
            @csrf
            <input type="hidden" name="embarazo_id" value="{{ session('embarazo_id') }}">
            <input type="hidden" name="paciente_cui" value="{{ $paciente->cui }}">



            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Suplemento</th>
                        <th>Cantidad Disponible</th>
                        <th>Asignar</th>
                        <th>Cantidad a Asignar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medicamentos as $medicamento)
                        <tr>
                            <td>{{ $medicamento->nombre }}</td>
                            <td>{{ $medicamento->cantidad }}</td>
                            <td>
                                @if ($medicamento->cantidad > 0)
                                    <input type="checkbox" name="medicamentos[]" value="{{ $medicamento->id }}">
                                @else
                                    <span class="text-danger">No Disponible</span>
                                @endif
                            </td>
                            <td>
                                <input type="number" name="cantidades[]" class="form-control" min="1"
                                    placeholder="Cantidad">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Asignar Suplementos</button>
        </form>
    </div>
@endsection
