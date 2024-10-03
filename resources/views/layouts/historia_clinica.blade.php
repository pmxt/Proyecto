@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Historial Clínica General</h2>

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

        <form action="{{ route('historial.guardar') }}" method="POST">
            @csrf

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Descripción</th>
                        <th>A</th>
                        <th>B</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>20</td>
                        <td>Diabetes</td>
                        <td>
                            <input type="checkbox" name="diabetes_a" value="1" 
                            {{ old('diabetes_a', isset($datos['diabetes_a']) ? $datos['diabetes_a'] : false) ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="diabetes_b" value="1" 
                            {{ old('diabetes_b', isset($datos['diabetes_b']) ? $datos['diabetes_b'] : false) ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td>21</td>
                        <td>Enfermedad renal</td>
                        <td>
                            <input type="checkbox" name="renal_a" value="1" 
                            {{ old('renal_a', isset($datos['renal_a']) ? $datos['renal_a'] : false) ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="renal_b" value="1" 
                            {{ old('renal_b', isset($datos['renal_b']) ? $datos['renal_b'] : false) ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td>22</td>
                        <td>Enfermedad del Corazón</td>
                        <td>
                            <input type="checkbox" name="corazon_a" value="1" 
                            {{ old('corazon_a', isset($datos['corazon_a']) ? $datos['corazon_a'] : false) ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="corazon_b" value="1" 
                            {{ old('corazon_b', isset($datos['corazon_b']) ? $datos['corazon_b'] : false) ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td>23</td>
                        <td>Hipertensión Arterial</td>
                        <td>
                            <input type="checkbox" name="hipertension_a" value="1" 
                            {{ old('hipertension_a', isset($datos['hipertension_a']) ? $datos['hipertension_a'] : false) ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="hipertension_b" value="1" 
                            {{ old('hipertension_b', isset($datos['hipertension_b']) ? $datos['hipertension_b'] : false) ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td>24</td>
                        <td>Consumo de drogas, incluido alcohol/tabaco</td>
                        <td>
                            <input type="checkbox" name="drogas_a" value="1" 
                            {{ old('drogas_a', isset($datos['drogas_a']) ? $datos['drogas_a'] : false) ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="drogas_b" value="1" 
                            {{ old('drogas_b', isset($datos['drogas_b']) ? $datos['drogas_b'] : false) ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <td>25</td>
                        <td>Cualquier otra enfermedad o afección médica severa</td>
                        <td>
                            <input type="checkbox" name="otra_a" value="1" 
                            {{ old('otra_a', isset($datos['otra_a']) ? $datos['otra_a'] : false) ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="otra_b" value="1" 
                            {{ old('otra_b', isset($datos['otra_b']) ? $datos['otra_b'] : false) ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="form-group">
                <label for="especificacion">Por favor especifique</label>
                <textarea name="especificacion" id="especificacion" class="form-control">{{ old('especificacion', isset($datos['especificacion']) ? $datos['especificacion'] : '') }}</textarea>
            </div>

            <p>La presencia de alguna de las características anteriores hace necesaria la evaluación de la paciente por un médico, quien tomará las decisiones de referirla o no a otro servicio de mayor complejidad.</p>

            <div class="form-group">
                <label for="referido_a">Si la respuesta es sí, será referido a</label>
                <input type="text" name="referido_a" id="referido_a" class="form-control" value="{{ old('referido_a', isset($datos['referido_a']) ? $datos['referido_a'] : '') }}">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', isset($datos['fecha']) ? $datos['fecha'] : '') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="responsable">Nombre de la persona responsable</label>
                    <input type="text" name="responsable" id="responsable" class="form-control" value="{{ old('responsable', isset($datos['responsable']) ? $datos['responsable'] : '') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-success">Siguiente</button>
        </form>
    </div>
@endsection
