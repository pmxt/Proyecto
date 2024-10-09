@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Identificación de Signos y Síntomas de Peligro</h2>

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
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('signos.guardar', ['examenFisicoId' => $examenFisicoId]) }}" method="POST">
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Signos y Síntomas de Peligro</th>
                        <th>Sí</th>
                        <th>No</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Hemorragia vaginal</td>
                        <td><input type="radio" name="hemorragia_vaginal" value="SI" required></td>
                        <td><input type="radio" name="hemorragia_vaginal" value="NO" required></td>
                    </tr>
                    <tr>
                        <td>Dolor de cabeza severo</td>
                        <td><input type="radio" name="dolor_cabeza_severo" value="SI" required></td>
                        <td><input type="radio" name="dolor_cabeza_severo" value="NO" required></td>
                    </tr>
                    <tr>
                        <td>Visión borrosa</td>
                        <td><input type="radio" name="vision_borrosa" value="SI" required></td>
                        <td><input type="radio" name="vision_borrosa" value="NO" required></td>
                    </tr>
                    <tr>
                        <td>Convulsión</td>
                        <td><input type="radio" name="convulsion" value="SI" required></td>
                        <td><input type="radio" name="convulsion" value="NO" required></td>
                    </tr>
                    <tr>
                        <td>Dolor abdominal severo (epigastralgia)</td>
                        <td><input type="radio" name="dolor_abdominal_severo" value="SI" required></td>
                        <td><input type="radio" name="dolor_abdominal_severo" value="NO" required></td>
                    </tr>
                    <tr>
                        <td>Presión arterial alta</td>
                        <td><input type="radio" name="presion_arterial_alta" value="SI" required></td>
                        <td><input type="radio" name="presion_arterial_alta" value="NO" required></td>
                    </tr>
                    <tr>
                        <td>Fiebre</td>
                        <td><input type="radio" name="fiebre" value="SI" required></td>
                        <td><input type="radio" name="fiebre" value="NO" required></td>
                    </tr>
                    <tr>
                        <td>Presentaciones fetales anormales</td>
                        <td><input type="radio" name="presentacion_fetal_anormal" value="SI" required></td>
                        <td><input type="radio" name="presentacion_fetal_anormal" value="NO" required></td>
                    </tr>
                </tbody>
            </table>

            <!-- Botón para enviar -->
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
