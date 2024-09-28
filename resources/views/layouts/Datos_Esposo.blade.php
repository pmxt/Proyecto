@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Ficha de Registro Obstétrico Del Ministerio De Salud Pública y Asistencia Social</h2>

        <!-- Barra de progreso -->
        <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0"
                aria-valuemax="100">
                Paso 2 de 2
            </div>
        </div>

        <form action="{{ route('registro.storeStep2') }}" method="POST">
            @csrf
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
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Solo redirige al dar clic en aceptar -->
            <a href="{{ route('registro.paso1') }}" class="btn btn-primary">Aceptar</a>
        @endif

            <div class="form-group">
                <label>CUI</label>
                <input type="number" name='cui' class="form-control" value="{{ old('cui', $datos['cui'] ?? '') }}"
                    required>
            </div>

            <div class="form-group">
                <label>Nombre del esposo o conviviente</label>
                <input type="text" name="nombreEsposo" class="form-control"
                    value="{{ old('nombreEsposo', $datos['nombreEsposo'] ?? '') }}" required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                        value="{{ old('fecha_nacimiento', $datos['fecha_nacimiento'] ?? '') }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label>Edad en años</label>
                    <input type="number" id="edad" name="edad" class="form-control"
                        value="{{ old('edad', $datos['edad'] ?? '') }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label>Pueblo</label>
                <div class="d-flex flex-wrap">
                    <div class="mr-3">
                        <input type="radio" name="pueblos" value="Maya" id="maya"
                            {{ old('pueblos', $datos['pueblos'] ?? '') == 'Maya' ? 'checked' : '' }} required>
                        <label for="maya">Maya</label>
                    </div>
                    <div class="mr-3">
                        <input type="radio" name="pueblos" value="Xinca" id="xinca"
                            {{ old('pueblos', $datos['pueblos'] ?? '') == 'Xinca' ? 'checked' : '' }}>
                        <label for="xinca">Xinca</label>
                    </div>
                    <div class="mr-3">
                        <input type="radio" name="pueblos" value="Garifuna" id="garifuna"
                            {{ old('pueblos', $datos['pueblos'] ?? '') == 'Garifuna' ? 'checked' : '' }}>
                        <label for="garifuna">Garífuna</label>
                    </div>
                    <div class="mr-3">
                        <input type="radio" name="pueblos" value="Mestizo" id="mestizo"
                            {{ old('pueblos', $datos['pueblos'] ?? '') == 'Mestizo' ? 'checked' : '' }}>
                        <label for="mestizo">Mestizo</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Escolaridad</label>
                <input type="text" name="Escolaridad" class="form-control"
                    value="{{ old('Escolaridad', $datos['Escolaridad'] ?? '') }}">
            </div>

            <div class="form-group">
                <label>Ocupación</label>
                <input type="text" name="Ocupacion" class="form-control"
                    value="{{ old('Ocupacion', $datos['Ocupacion'] ?? '') }}">
            </div>

            <div class="form-group">
                <label>Estado civil</label>
                <input type="text" name="estado_civil" class="form-control"
                    value="{{ old('estado_civil', $datos['estado_civil'] ?? '') }}">
            </div>

            <a href="{{ route('registro.paso1') }}" class="btn btn-warning">Volver</a>
            <!-- Enlace para volver al paso 1 -->
            <button type="submit" class="btn btn-success">Finalizar</button>
        </form>

        <script>
            document.getElementById('fecha_nacimiento').addEventListener('change', function() {
                const fechaNacimiento = new Date(this.value);
                const fechaActual = new Date();
                let edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();
                const mesActual = fechaActual.getMonth();
                const mesNacimiento = fechaNacimiento.getMonth();
                if (mesActual < mesNacimiento || (mesActual === mesNacimiento && fechaActual.getDate() < fechaNacimiento
                        .getDate())) {
                    edad--;
                }
                document.getElementById('edad').value = edad;
            });
        </script>
    </div>
@endsection
