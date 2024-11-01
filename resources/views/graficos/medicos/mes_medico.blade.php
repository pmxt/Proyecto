@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ingresar Datos del Mes para el Año {{ $anio }} - Médicos</h2>

    <!-- Formulario para ingresar los datos del mes -->
    <form action="{{ route('medicos.guardarMes') }}" method="POST">
        @csrf
        <input type="hidden" name="anio" value="{{ $anio }}">

        <div class="mb-3">
            <label for="mes" class="form-label">Seleccionar Mes</label>
            <select class="form-control" id="mes" name="mes">
                @foreach($meses as $mes)
                    <option value="{{ $mes }}">{{ $mes }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="partos_atendidos" class="form-label">Número de partos atendidos por médico</label>
            <input type="number" class="form-control" id="partos_atendidos" name="partos_atendidos" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar Datos del Mes</button>
    </form>
</div>
@endsection
