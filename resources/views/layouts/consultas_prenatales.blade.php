@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h2 class="text-center">Registro de Consulta Prenatal</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
      <!-- Barra de progreso -->
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
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <form action="{{ route('consulta.guardar') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="paciente">Seleccionar Paciente</label>
            <select name="paciente_cui" id="paciente" class="form-control" required>
                <option value="">-- Selecciona una paciente --</option>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->cui }}" {{ old('paciente_cui', $datos['paciente_cui'] ?? '') == $paciente->cui ? 'selected' : '' }}>
                        {{ $paciente->name }} - {{ $paciente->cui }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_consulta">Fecha de la Consulta</label>
            <input type="date" id="fecha_consulta" name="fecha_consulta" class="form-control" value="{{ old('fecha_consulta', $datos['fecha_consulta'] ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="tipo_servicio">Tipo de Servicio</label>
            <select name="tipo_servicio" id="tipo_servicio" class="form-control" required>
                <option value="">Seleccione el tipo de servicio</option>
                <option value="PSF" {{ old('tipo_servicio', $datos['tipo_servicio'] ?? '') == 'PSF' ? 'selected' : '' }}>PSF</option>
                <option value="C/S 'A'" {{ old('tipo_servicio', $datos['tipo_servicio'] ?? '') == 'C/S \'A\'' ? 'selected' : '' }}>C/S 'A'</option>
                <option value="C/S 'B'" {{ old('tipo_servicio', $datos['tipo_servicio'] ?? '') == 'C/S \'B\'' ? 'selected' : '' }}>C/S 'B'</option>
                <option value="CENAPA" {{ old('tipo_servicio', $datos['tipo_servicio'] ?? '') == 'CENAPA' ? 'selected' : '' }}>CENAPA</option>
                <option value="CAP" {{ old('tipo_servicio', $datos['tipo_servicio'] ?? '') == 'CAP' ? 'selected' : '' }}>CAP</option>
                <option value="CAIMI" {{ old('tipo_servicio', $datos['tipo_servicio'] ?? '') == 'CAIMI' ? 'selected' : '' }}>CAIMI</option>
            </select>
        </div>

        <div class="form-group">
            <label for="area_salud">Área de Salud</label>
            <input type="text" name="area_salud" id="area_salud" class="form-control" value="{{ old('area_salud', $datos['area_salud'] ?? '') }}" placeholder="Ingrese el área de salud" required>
        </div>

        <div class="form-group">
            <label for="nombre_servicio">Distrito</label>
            <input type="text" name="nombre_servicio" id="nombre_servicio" class="form-control" value="{{ old('nombre_servicio', $datos['nombre_servicio'] ?? '') }}" placeholder="Ingrese el nombre del servicio" required>
        </div>

        <div class="form-group">
            <label for="motivo_consulta">Motivo de la Consulta</label>
            <select name="motivo_consulta" id="motivo_consulta" class="form-control" required>
                <option value="">Seleccione el motivo de la consulta</option>
                <option value="Pre Natal" {{ old('motivo_consulta', $datos['motivo_consulta'] ?? '') == 'Pre Natal' ? 'selected' : '' }}>Embarazo</option>
                <option value="Parto" {{ old('motivo_consulta', $datos['motivo_consulta'] ?? '') == 'Parto' ? 'selected' : '' }}>Parto</option>
                <option value="Post Natal" {{ old('motivo_consulta', $datos['motivo_consulta'] ?? '') == 'Post Natal' ? 'selected' : '' }}>Postparto</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tipo_consulta">Tipo de Consulta</label>
            <input type="text" id="tipo_consulta" name="tipo_consulta" class="form-control" value="{{ old('tipo_consulta', $datos['tipo_consulta'] ?? '') }}" placeholder="Consulta prenatal, control rutinario, etc." required>
        </div>

        <!-- Botón para Enviar el Formulario -->
        <button type="submit" class="btn btn-success">Guardar y continuar</button>
    </form>

    <div class="mt-4">
        <a href="" class="btn btn-secondary">Realizar Examen Físico</a>
        <a href="" class="btn btn-warning">Evaluar Signos y Síntomas de Peligro</a>
    </div>
</div>
@endsection
