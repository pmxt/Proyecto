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
                        <th>Sí</th>
                        <th>No</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>20</td>
                        <td>Diabetes</td>
                        <td>
                            <input type="radio" name="diabetes" value="si" 
                            {{ old('diabetes', isset($datos['diabetes']) && $datos['diabetes'] == 'si' ? 'checked' : '') }} required> Sí
                        </td>
                        <td>
                            <input type="radio" name="diabetes" value="no" 
                            {{ old('diabetes', isset($datos['diabetes']) && $datos['diabetes'] == 'no' ? 'checked' : '') }} required> No
                        </td>
                    </tr>
                    <tr>
                        <td>21</td>
                        <td>Enfermedad renal</td>
                        <td>
                            <input type="radio" name="renal" value="si" 
                            {{ old('renal', isset($datos['renal']) && $datos['renal'] == 'si' ? 'checked' : '') }} required> Sí
                        </td>
                        <td>
                            <input type="radio" name="renal" value="no" 
                            {{ old('renal', isset($datos['renal']) && $datos['renal'] == 'no' ? 'checked' : '') }} required> No
                        </td>
                    </tr>
                    <tr>
                        <td>22</td>
                        <td>Enfermedad del Corazón</td>
                        <td>
                            <input type="radio" name="corazon" value="si" 
                            {{ old('corazon', isset($datos['corazon']) && $datos['corazon'] == 'si' ? 'checked' : '') }} required> Sí
                        </td>
                        <td>
                            <input type="radio" name="corazon" value="no" 
                            {{ old('corazon', isset($datos['corazon']) && $datos['corazon'] == 'no' ? 'checked' : '') }} required> No
                        </td>
                    </tr>
                    <tr>
                        <td>23</td>
                        <td>Hipertensión Arterial</td>
                        <td>
                            <input type="radio" name="hipertension" value="si" 
                            {{ old('hipertension', isset($datos['hipertension']) && $datos['hipertension'] == 'si' ? 'checked' : '') }} required> Sí
                        </td>
                        <td>
                            <input type="radio" name="hipertension" value="no" 
                            {{ old('hipertension', isset($datos['hipertension']) && $datos['hipertension'] == 'no' ? 'checked' : '') }} required> No
                        </td>
                    </tr>
                    <tr>
                        <td>24</td>
                        <td>Consumo de drogas, incluido alcohol/tabaco</td>
                        <td>
                            <input type="radio" name="drogas" value="si" 
                            {{ old('drogas', isset($datos['drogas']) && $datos['drogas'] == 'si' ? 'checked' : '') }} required> Sí
                        </td>
                        <td>
                            <input type="radio" name="drogas" value="no" 
                            {{ old('drogas', isset($datos['drogas']) && $datos['drogas'] == 'no' ? 'checked' : '') }} required> No
                        </td>
                    </tr>
                    <tr>
                        <td>25</td>
                        <td>Cualquier otra enfermedad o afección médica severa</td>
                        <td>
                            <input type="radio" name="otra" value="si" 
                            {{ old('otra', isset($datos['otra']) && $datos['otra'] == 'si' ? 'checked' : '') }} required> Sí
                        </td>
                        <td>
                            <input type="radio" name="otra" value="no" 
                            {{ old('otra', isset($datos['otra']) && $datos['otra'] == 'no' ? 'checked' : '') }} required> No
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
