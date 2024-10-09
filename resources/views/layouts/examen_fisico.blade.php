@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Examen Físico de la Embarazada</h2>
        
        <!-- error de registro -->
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
        @if (isset($currentStep) && isset($totalSteps))
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
        <!-- registro correcto  -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('examen.guardar', ['consultaId' => session('obtener1')['id']]) }}" method="POST">            @csrf

            <!-- Signos Vitales -->
            <h4>Signos Vitales</h4>
            <div class="form-group">
                <label for="presion_arterial">Presión Arterial</label>
                <input type="text" name="presion_arterial" id="presion_arterial" class="form-control" placeholder="mmHg"
                    value="{{ old('presion_arterial', $datos['presion_arterial'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="temperatura_corporal">Temperatura Corporal</label>
                <input type="text" name="temperatura_corporal" id="temperatura_corporal" class="form-control"
                    placeholder="°C" value="{{ old('temperatura_corporal', $datos['temperatura_corporal'] ?? '') }}"
                    required>
            </div>
            <div class="form-group">
                <label for="peso">Peso (libras)</label>
                <input type="number" name="peso" id="peso" class="form-control"
                    placeholder="Ingrese el peso en libras" value="{{ old('peso', $datos['peso'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="frecuencia_respiratoria">Frecuencia Respiratoria</label>
                <input type="number" name="frecuencia_respiratoria" id="frecuencia_respiratoria" class="form-control"
                    placeholder="Respiraciones por minuto"
                    value="{{ old('frecuencia_respiratoria', $datos['frecuencia_respiratoria'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="frecuencia_cardiaca_materna">Frecuencia Cardiaca Materna</label>
                <input type="number" name="frecuencia_cardiaca_materna" id="frecuencia_cardiaca_materna"
                    class="form-control" placeholder="Latidos por minuto"
                    value="{{ old('frecuencia_cardiaca_materna', $datos['frecuencia_cardiaca_materna'] ?? '') }}" required>
            </div>

            <!-- Examen General -->
            <h4>Examen General</h4>
            <div class="container">
                <!-- Tabla para seleccionar Bueno con opciones de Sí o No -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Evaluación</th>
                            <th>¿Normal?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Estado General, palidez palmar, conjuntiva, uñas</td>
                            <td>
                                <label for="palidez_si">Sí</label>
                                <input type="radio" name="estado_general" id="palidez_si" value="si"
                                    {{ old('estado_general', $datos['estado_general'] ?? '') == 'si' ? 'checked' : '' }}>
                                <label for="palidez_no">No</label>
                                <input type="radio" name="estado_general" id="palidez_no" value="no"
                                    {{ old('estado_general', $datos['estado_general'] ?? '') == 'no' ? 'checked' : '' }}>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <label for="examen_bucal">Examen Bucal/Dental</label>
                <input type="text" name="examen_bucal" id="examen_bucal" class="form-control"
                    placeholder="Ingrese hallazgos dentales"
                    value="{{ old('examen_bucal', $datos['examen_bucal'] ?? '') }}" required>
            </div>

            <!-- Examen Obstétrico -->
            <h4>Examen Obstétrico</h4>
            <div class="form-group">
                <label for="altura_uterina">Altura Uterina</label>
                <input type="text" name="altura_uterina" id="altura_uterina" class="form-control"
                    placeholder="Ingrese la altura uterina"
                    value="{{ old('altura_uterina', $datos['altura_uterina'] ?? '') }}" required>
            </div>
            <div class="container">
                <!-- Tabla para seleccionar Bueno con opciones de Sí o No -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Evaluación</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Presencia de movimientos fetales</td>
                            <td>
                                <label for="movimientos_fetales_si">Sí</label>
                                <input type="radio" name="movimientos_fetales" id="movimientos_fetales_si" value="si"
                                    {{ old('movimientos_fetales', $datos['movimientos_fetales'] ?? '') == 'si' ? 'checked' : '' }}>
                                <label for="movimientos_fetales_no">No</label>
                                <input type="radio" name="movimientos_fetales" id="movimientos_fetales_no" value="no"
                                    {{ old('movimientos_fetales', $datos['movimientos_fetales'] ?? '') == 'no' ? 'checked' : '' }}>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <label for="frecuencia_cardiaca_fetal">Frecuencia Cardiaca Fetal (si procede)</label>
                <input type="text" name="frecuencia_cardiaca_fetal" id="frecuencia_cardiaca_fetal"
                    class="form-control" placeholder="Ingrese la frecuencia cardiaca fetal"
                    value="{{ old('frecuencia_cardiaca_fetal', $datos['frecuencia_cardiaca_fetal'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="leopoldo">Presentación por Leopoldo</label>
                <input type="text" name="leopoldo" id="leopoldo" class="form-control"
                    placeholder="Ingrese la presentación por Leopoldo"
                    value="{{ old('leopoldo', $datos['leopoldo'] ?? '') }}" required>
            </div>

            <!-- Examen Ginecológico -->
            <h4>Examen Ginecológico</h4>
            <div class="container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Evaluación</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Presencia de trazas de sangre o manchado</td>
                            <td>
                                <label for="trazas_sangre_si">Sí</label>
                                <input type="radio" name="trazas_sangre" id="trazas_sangre_si" value="si"
                                    {{ old('trazas_sangre', $datos['trazas_sangre'] ?? '') == 'si' ? 'checked' : '' }}>
                                <label for="trazas_sangre_no">No</label>
                                <input type="radio" name="trazas_sangre" id="trazas_sangre_no" value="no"
                                    {{ old('trazas_sangre', $datos['trazas_sangre'] ?? '') == 'no' ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <td>Verrugas, herpes, papiloma, ulceras</td>
                            <td>
                                <label for="verrugas_si">Sí</label>
                                <input type="radio" name="verrugas" id="verrugas_si" value="si"
                                    {{ old('verrugas', $datos['verrugas'] ?? '') == 'si' ? 'checked' : '' }}>
                                <label for="verrugas_no">No</label>
                                <input type="radio" name="verrugas" id="verrugas_no" value="no"
                                    {{ old('verrugas', $datos['verrugas'] ?? '') == 'no' ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <td>Flujo Vaginal</td>
                            <td>
                                <label for="flujo_vaginal_si">Sí</label>
                                <input type="radio" name="flujo_vaginal" id="flujo_vaginal_si" value="si"
                                    {{ old('flujo_vaginal', $datos['flujo_vaginal'] ?? '') == 'si' ? 'checked' : '' }}>
                                <label for="flujo_vaginal_no">No</label>
                                <input type="radio" name="flujo_vaginal" id="flujo_vaginal_no" value="no"
                                    {{ old('flujo_vaginal', $datos['flujo_vaginal'] ?? '') == 'no' ? 'checked' : '' }}>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Exámenes de Laboratorio -->
            <h4>Exámenes de Laboratorio</h4>
            <div class="form-group">
                <label for="hemoglobina">Hemoglobina y Hematocrito</label>
                <input type="text" name="hemoglobina" id="hemoglobina" class="form-control"
                    placeholder="Ingrese los niveles de hemoglobina"
                    value="{{ old('hemoglobina', $datos['hemoglobina'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="grupo_rh">Grupo y RH</label>
                <input type="text" name="grupo_rh" id="grupo_rh" class="form-control"
                    placeholder="Ingrese el grupo y RH" value="{{ old('grupo_rh', $datos['grupo_rh'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="orina">Orina (proteínas, glucosa, cetonas)</label>
                <input type="text" name="orina" id="orina" class="form-control"
                    placeholder="Ingrese los resultados de la orina" value="{{ old('orina', $datos['orina'] ?? '') }}"
                    required>
            </div>
            <div class="form-group">
                <label for="glicemia">Glicemia</label>
                <input type="text" name="glicemia" id="glicemia" class="form-control"
                    placeholder="Ingrese los niveles de glicemia" value="{{ old('glicemia', $datos['glicemia'] ?? '') }}"
                    required>
            </div>
            <div class="form-group">
                <label for="vdrl">VDRL</label>
                <input type="text" name="vdrl" id="vdrl" class="form-control"
                    placeholder="Ingrese los resultados de VDRL" value="{{ old('vdrl', $datos['vdrl'] ?? '') }}"
                    required>
            </div>
            <div class="form-group">
                <label for="vih">VIH</label>
                <input type="text" name="vih" id="vih" class="form-control"
                    placeholder="Ingrese los resultados de VIH" value="{{ old('vih', $datos['vih'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="papanicolau">Papanicolau</label>
                <input type="text" name="papanicolau" id="papanicolau" class="form-control"
                    placeholder="Ingrese los resultados del Papanicolau"
                    value="{{ old('papanicolau', $datos['papanicolau'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="infecciones">Infecciones</label>
                <input type="text" name="infecciones" id="infecciones" class="form-control"
                    placeholder="Ingrese las infecciones detectadas"
                    value="{{ old('infecciones', $datos['infecciones'] ?? '') }}" required>
            </div>

            <!-- Clasificación -->
            <h4>Clasificación</h4>
            <div class="form-group">
                <label for="semanas_embarazo">Semanas de embarazo</label>
                <input type="text" name="semanas_embarazo" id="semanas_embarazo" class="form-control"
                    placeholder="Ingrese las semanas de embarazo"
                    value="{{ old('semanas_embarazo', $datos['semanas_embarazo'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="problemas_detectados">Problemas detectados</label>
                <input type="text" name="problemas_detectados" id="problemas_detectados" class="form-control"
                    placeholder="Ingrese los problemas detectados"
                    value="{{ old('problemas_detectados', $datos['problemas_detectados'] ?? '') }}" required>
            </div>

            <!-- Botón para Enviar el Formulario -->
            <button type="submit" class="btn btn-success">Guardar Examen Físico</button>
        </form>
    </div>
@endsection
