@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ingresar Año - Médicos</h2>

    <!-- Formulario para ingresar el año y los datos generales -->
    <form action="{{ route('medicos.guardarAnio') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="anio" class="form-label">Año</label>
            <input type="number" class="form-control" id="anio" name="anio" required>
        </div>

        <div class="mb-3">
            <label for="servicio_salud" class="form-label">Servicio de Salud</label>
            <input type="text" class="form-control" id="servicio_salud" name="servicio_salud" required>
        </div>

        <div class="mb-3">
            <label for="distrito_salud" class="form-label">Distrito de Salud</label>
            <input type="text" class="form-control" id="distrito_salud" name="distrito_salud" required>
        </div>

        <div class="mb-3">
            <label for="area_salud" class="form-label">Área de Salud</label>
            <input type="text" class="form-control" id="area_salud" name="area_salud" required>
        </div>

        <div class="mb-3">
            <label for="poblacion_meta" class="form-label">Población total atendida</label>
            <input type="number" class="form-control" id="poblacion_meta" name="poblacion_meta" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar Año</button>
    </form>
</div>
@endsection
