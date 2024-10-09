@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h2 class="text-center">Editar Medicamento</h2>

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Mostrar mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario para editar el medicamento -->
    <form action="{{ route('medicamentos.update', $medicamento->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre del Medicamento</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $medicamento->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad Disponible</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ old('cantidad', $medicamento->cantidad) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Medicamento</button>
    </form>

    <!-- Botón para regresar a la lista de medicamentos -->
    <div class="mt-3">
        <a href="{{ route('medicamentos.index') }}" class="btn btn-secondary">Regresar</a>
    </div>
</div>
@endsection
