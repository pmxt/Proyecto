@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="card shadow-sm p-4 mt-4">
        <h2 class="text-center">Ingresar un Nuevo Año para Cobertura Prenatal</h2>

        <!-- Formulario para ingresar un nuevo año -->
        <form method="POST" action="{{ route('guardarAnio') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="anio" class="form-label">Año:</label>
                    <input type="number" name="anio" id="anio" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="servicio_salud" class="form-label">Servicio de Salud:</label>
                    <input type="text" name="servicio_salud" id="servicio_salud" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="distrito_salud" class="form-label">Distrito de Salud:</label>
                    <input type="text" name="distrito_salud" id="distrito_salud" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="area_salud" class="form-label">Área de Salud:</label>
                    <input type="text" name="area_salud" id="area_salud" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="poblacion_meta" class="form-label">Población Meta:</label>
                    <input type="number" name="poblacion_meta" id="poblacion_meta" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Nuevo Año</button>
        </form>
    </div>
</div>
@endsection
