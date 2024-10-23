@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Ficha de Registro Obstétrico - Paso 1</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(isset($currentStep) && isset($totalSteps))
    @php
        $progress = ($currentStep / $totalSteps) * 100;
    @endphp
    <div class="progress mb-4">
        <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" 
            aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
            Paso {{ $currentStep }} de {{ $totalSteps }}
        </div>
    </div>
@endif
        <form action="{{ route('registro.storeStep1') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>CUI</label>
                <input type="number" name='cui' class="form-control" value="{{ old('cui', $datos['cui'] ?? '') }}"
                    required>
            </div>

            <div class="form-group">
                <label>Nombre de la embarazada</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $datos['name'] ?? '') }}"
                    required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Fecha de Nacimiento</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control"
                        value="{{ old('fecha_nacimiento', $datos['fecha_nacimiento'] ?? '') }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="edad">Edad de la paciente en años</label>
                    <input type="number" id="edad" name="edad" class="form-control"
                        value="{{ old('edad', $datos['edad'] ?? '') }}" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Fecha de la última regla</label>
                    <input type="date" id="fecha_ultima_regla" name="fecha_ultima_regla" class="form-control"
                        value="{{ old('fecha_ultima_regla', $datos['fecha_ultima_regla'] ?? '') }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Fecha probable de parto</label>
                    <input type="date" id="fecha_probable_parto" name="fecha_probable_parto" class="form-control"
                        value="{{ old('fecha_probable_parto', $datos['fecha_probable_parto'] ?? '') }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label>Migrante</label>
                <div class="d-flex flex-wrap">
                    <div class="mr-3">
                        <input type="radio" name="migrante" value="Sí" id="migrante_si"
                            {{ old('migrante', $datos['migrante'] ?? '') == 'Sí' ? 'checked' : '' }} required>
                        <label for="migrante_si">Sí</label>
                    </div>
                    <div class="mr-3">
                        <input type="radio" name="migrante" value="No" id="migrante_no"
                            {{ old('migrante', $datos['migrante'] ?? '') == 'No' ? 'checked' : '' }}>
                        <label for="migrante_no">No</label>
                    </div>
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
                    value="{{ old('Escolaridad', $datos['Escolaridad'] ?? '') }}" required>
            </div>

            <div class="form-group">
                <label>Ocupación</label>
                <input type="text" name="Ocupacion" class="form-control"
                    value="{{ old('Ocupacion', $datos['Ocupacion'] ?? '') }}" required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Distancia al servicio de salud más cercano</label>
                    <input type="text" name="distancia" class="form-control"
                        value="{{ old('distancia', $datos['distancia'] ?? '') }}" required>
                </div>


                <div class="form-group col-md-6">
                    <label>Tiempo en horas para llegar </label>
                    <input type="text" name="tiempo" class="form-control"
                        value="{{ old('tiempo', $datos['tiempo'] ?? '') }}" required>
                </div>

            </div>

            <div class="form-group">
                <label>Nombre de la comunidad</label>
                <input type="text" name="comunidad" class="form-control"
                    value="{{ old('comunidad', $datos['comunidad'] ?? '') }}" required>
            </div>

            <div class="form-group">
                <label>No. celular</label>
                <input type="text" name="telefono" class="form-control"
                    value="{{ old('telefono', $datos['telefono'] ?? '') }}" required>
            </div>
            <button type="submit" class="btn btn-success">Siguiente</button>
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
        <script>
            document.getElementById('fecha_ultima_regla').addEventListener('change', function() {
                const fechaUltimaRegla = new Date(this.value);
                // Sumar 280 días (40 semanas) a la fecha de la última regla
                const fechaProbableParto = new Date(fechaUltimaRegla);
                fechaProbableParto.setDate(fechaProbableParto.getDate() + 281);

                
                const year = fechaProbableParto.getFullYear();
                const month = String(fechaProbableParto.getMonth() + 1).padStart(2, '0'); 
                const day = String(fechaProbableParto.getDate()).padStart(2, '0');
                document.getElementById('fecha_probable_parto').value = `${year}-${month}-${day}`;
            });
        </script>
    </div>
@endsection
