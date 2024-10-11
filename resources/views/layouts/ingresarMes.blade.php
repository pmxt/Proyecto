@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Ingresar Datos para el Año {{ $anio }}</h2>

    <form method="POST" action="{{ route('guardarMes') }}">
        @csrf
        <input type="hidden" name="anio" value="{{ $anio }}">
    
        <label for="mes">Seleccionar Mes:</label>
        <select name="mes" id="mes" class="form-control">
            @foreach ($meses as $mes)
                <option value="{{ $mes }}">{{ $mes }}</option>
            @endforeach
        </select>
    
        <label for="embarazos_esperados">Embarazos Esperados</label>
        <input type="number" name="embarazos_esperados" class="form-control" required>
    
        <label for="embarazos_realizados">Embarazos Realizados</label>
        <input type="number" name="embarazos_realizados" class="form-control" required>
    
        <button type="submit" class="btn btn-primary mt-3">Guardar Mes</button>
    </form>
</div>
@endsection

