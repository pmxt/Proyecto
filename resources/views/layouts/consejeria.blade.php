@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Consejería</h2>

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

        <form action="{{ route('consejeria.guardar',['examenFisicoId' => $examenFisicoId]) }}" method="POST">
            @csrf

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Consejería</th>
                        <th>Sí</th>
                        <th>No</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Alimentación durante el embarazo</td>
                        <td><input type="radio" name="alimentacion" value="SI" required
                                {{ old('alimentacion') == 'SI' ? 'checked' : '' }}></td>
                        <td><input type="radio" name="alimentacion" value="NO" required
                                {{ old('alimentacion') == 'NO' ? 'checked' : '' }}></td>
                    </tr>
                    <tr>
                        <td>Señales de peligro durante el embarazo</td>
                        <td><input type="radio" name="senales_peligro_embarazo" value="SI" required
                                {{ old('senales_peligro_embarazo') == 'SI' ? 'checked' : '' }}></td>
                        <td><input type="radio" name="senales_peligro_embarazo" value="NO" required
                                {{ old('senales_peligro_embarazo') == 'NO' ? 'checked' : '' }}></td>
                    </tr>
                    <tr>
                        <td>Consejería sobre propósito y prueba VIH</td>
                        <td><input type="radio" name="consejeria_vih" value="SI" required
                                {{ old('consejeria_vih') == 'SI' ? 'checked' : '' }}></td>
                        <td><input type="radio" name="consejeria_vih" value="NO" required
                                {{ old('consejeria_vih') == 'NO' ? 'checked' : '' }}></td>
                    </tr>
                    <tr>
                        <td>Plan de parto</td>
                        <td><input type="radio" name="plan_parto" value="SI" required
                                {{ old('plan_parto') == 'SI' ? 'checked' : '' }}></td>
                        <td><input type="radio" name="plan_parto" value="NO" required
                                {{ old('plan_parto') == 'NO' ? 'checked' : '' }}></td>
                    </tr>
                    <tr>
                        <td>Plan de emergencia familiar y comunitario</td>
                        <td><input type="radio" name="plan_emergencia" value="SI" required
                                {{ old('plan_emergencia') == 'SI' ? 'checked' : '' }}></td>
                        <td><input type="radio" name="plan_emergencia" value="NO" required
                                {{ old('plan_emergencia') == 'NO' ? 'checked' : '' }}></td>
                    </tr>
                    <tr>
                        <td>Lactancia materna exclusiva/MIELA</td>
                        <td><input type="radio" name="lactancia_materna" value="SI" required
                                {{ old('lactancia_materna') == 'SI' ? 'checked' : '' }}></td>
                        <td><input type="radio" name="lactancia_materna" value="NO" required
                                {{ old('lactancia_materna') == 'NO' ? 'checked' : '' }}></td>
                    </tr>
                    <tr>
                        <td>Otros métodos de planificación familiar</td>
                        <td><input type="radio" name="metodos_planificacion" value="SI" required
                                {{ old('metodos_planificacion') == 'SI' ? 'checked' : '' }}></td>
                        <td><input type="radio" name="metodos_planificacion" value="NO" required
                                {{ old('metodos_planificacion') == 'NO' ? 'checked' : '' }}></td>
                    </tr>
                    <tr>
                        <td>Importancia del control posparto</td>
                        <td><input type="radio" name="control_posparto" value="SI" required
                                {{ old('control_posparto') == 'SI' ? 'checked' : '' }}></td>
                        <td><input type="radio" name="control_posparto" value="NO" required
                                {{ old('control_posparto') == 'NO' ? 'checked' : '' }}></td>
                    </tr>
                    <tr>
                        <td>Vacunación y cuidados del recién nacido</td>
                        <td><input type="radio" name="vacunacion" value="SI" required
                                {{ old('vacunacion') == 'SI' ? 'checked' : '' }}></td>
                        <td><input type="radio" name="vacunacion" value="NO" required
                                {{ old('vacunacion') == 'NO' ? 'checked' : '' }}></td>
                    </tr>
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Guardar Consejería</button>
        </form>
    </div>
@endsection
