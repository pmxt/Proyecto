@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h2 class="text-center">Listado de Pacientes</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario de búsqueda -->
    <form action="{{ route('pacientes.listar') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por CUI o nombre" value="{{ request('search') }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>CUI</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
                <tr>
                    <td>{{ $paciente->cui }}</td>
                    <td>{{ $paciente->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años</td>
                    <td>{{ $paciente->telefono }}</td>
                    <td>
                        <!-- Botón para editar -->
                       

                        <!-- Botón para contactar por WhatsApp -->
                        <a href="https://api.whatsapp.com/send?phone={{ $paciente->telefono }}&text=Hola%20{{ urlencode($paciente->name) }}%2C%20queremos%20confirmar%20tu%20próxima%20cita%20de%20control%20prenatal." target="_blank" class="btn btn-success">WhatsApp</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $pacientes->links() }} <!-- Paginación -->
    </div>
</div>
@endsection
