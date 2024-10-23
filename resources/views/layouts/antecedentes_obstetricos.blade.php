@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Antecedentes obstétricos</h2>

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

        <form action="{{ route('antecedentes.submit', ['embarazo_id' => $embarazo->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="embarazo_id" value="{{ $embarazo->id }}">
           

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>No. Embarazos</label>
                    <input type="number" name='num_embarazos' class="form-control"
                        value="{{ old('num_embarazos', $datos['num_embarazos'] ?? '') }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label>No. Partos</label>
                    <input type="number" name='num_partos' class="form-control"
                        value="{{ old('num_partos', $datos['num_partos'] ?? '') }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label>No. Cesáreas</label>
                    <input type="number" name='num_cesarias' class="form-control"
                        value="{{ old('num_cesarias', $datos['num_cesarias'] ?? '') }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>No. Abortos</label>
                    <input type="number" name="num_abortos" class="form-control"
                        value="{{ old('num_abortos', $datos['num_abortos'] ?? '') }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label>No. Hijos nacidos vivos</label>
                    <input type="number" name="num_hijos_nacidos_vivos" class="form-control"
                        value="{{ old('num_hijos_nacidos_vivos', $datos['num_hijos_nacidos_vivos'] ?? '') }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label>No. Hijos nacidos muertos</label>
                    <input type="number" name="num_hijos_nacidos_muertos" class="form-control"
                        value="{{ old('num_hijos_nacidos_muertos', $datos['num_hijos_nacidos_muertos'] ?? '') }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label>No. Hijos vivos</label>
                    <input type="number" name="num_hijos_vivos" class="form-control"
                        value="{{ old('num_hijos_vivos', $datos['num_hijos_vivos'] ?? '') }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label>No. Hijos fallecidos</label>
                    <input type="number" name="num_hijos_fallecidos" class="form-control"
                        value="{{ old('num_hijos_fallecidos', $datos['num_hijos_fallecidos'] ?? '') }}" required>
                </div>
            </div>
            
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
                        <td>1</td>
                        <td>Muerte fetal o neonatal previa</td>
                        <td><input type="radio" name="muerte_fetal" value="si" {{ old('muerte_fetal') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="muerte_fetal" value="no" {{ old('muerte_fetal') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Antecedentes de 3 o más abortos espontáneos consecutivos</td>
                        <td><input type="radio" name="abortos_consecutivos" value="si" {{ old('abortos_consecutivos') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="abortos_consecutivos" value="no" {{ old('abortos_consecutivos') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Antecedentes de 3 o más gestas</td>
                        <td><input type="radio" name="gestas" value="si" {{ old('gestas') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="gestas" value="no" {{ old('gestas') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Peso al nacer del último bebé < 2500g (5 lbs 8 onzas)</td>
                        <td><input type="radio" name="peso_bebe_2500g" value="si" {{ old('peso_bebe_2500g') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="peso_bebe_2500g" value="no" {{ old('peso_bebe_2500g') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Peso al nacer del último bebé > 4500g (9 lbs 9 onzas)</td>
                        <td><input type="radio" name="peso_bebe_4500g" value="si" {{ old('peso_bebe_4500g') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="peso_bebe_4500g" value="no" {{ old('peso_bebe_4500g') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Antecedentes de hipertensión o preeclampsia/eclampsia</td>
                        <td><input type="radio" name="hipertension" value="si" {{ old('hipertension') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="hipertension" value="no" {{ old('hipertension') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Cirugías previas en el tracto reproductor (miomectomía, conización, cesárea o cerclaje cervical)</td>
                        <td><input type="radio" name="cirugias_reproductor" value="si" {{ old('cirugias_reproductor') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="cirugias_reproductor" value="no" {{ old('cirugias_reproductor') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('registro.paso2') }}" class="btn btn-warning">Volver</a>
            <button type="submit" class="btn btn-success">Siguiente</button>
        </form>
    </div>
@endsection
