@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Control Nutricional - Paso 1</h2>
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
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('pacientes.guardar') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="paciente">Seleccionar Paciente</label>
                <select name="paciente_cui" id="paciente" class="form-control" required>
                    <option value="">-- Selecciona una paciente --</option>
                    @foreach($pacientes as $paciente)
                        <option value="{{ $paciente->cui }}">{{ $paciente->name }} - {{ $paciente->cui }}</option>
                    @endforeach
                </select>
            </div>
           
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Peso (LB)</label>
                    <input type="number" step="0.1" id="peso_lb" name="peso_lb" class="form-control"
                        value="{{ old('peso_lb', $datos['peso_lb'] ?? '') }}" required oninput="convertirPesoKg()">
                </div>
                <div class="form-group col-md-4">
                    <label>Peso (kg)</label>
                    <input type="number" step="0.1" id="peso_kg" name="peso_kg" class="form-control"
                        value="{{ old('peso_kg', $datos['peso_kg'] ?? '') }}" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label>Talla (cm)</label>
                    <input type="number" step="0.1" id="talla" name="talla" class="form-control"
                        value="{{ old('talla', $datos['talla'] ?? '') }}" required oninput="calcularIMC()">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>IMC</label>
                    <input type="number" step="0.1" id="imc" name="imc" class="form-control"
                        value="{{ old('imc', $datos['imc'] ?? '') }}" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label>CMB (Circunferencia de Brazo)</label>
                    <input type="number" step="0.1" name="cmb" class="form-control"
                        value="{{ old('cmb', $datos['cmb'] ?? '') }}" required>
                </div>
            </div>

           
            <h4>Controles Nutricionales</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Control No</th>
                        <th>Fecha de Control</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 10; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>
                            <input type="date" name="control_fecha_{{ $i }}" class="form-control"
                                   value="{{ old('control_fecha_' . $i) }}">
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>

            <button type="submit" class="btn btn-success">Siguiente</button>
        </form>

        <script>
            // Convertir libras a kilogramos y calcular IMC automáticamente
            function convertirPesoKg() {
                const pesoLb = parseFloat(document.getElementById('peso_lb').value);
                if (!isNaN(pesoLb) && pesoLb > 0) {
                    const pesoKg = pesoLb * 0.453592;
                    document.getElementById('peso_kg').value = pesoKg.toFixed(2);
                    calcularIMC();
                } else {
                    document.getElementById('peso_kg').value = '';
                    document.getElementById('imc').value = '';
                }
            }

            function calcularIMC() {
                const pesoKg = parseFloat(document.getElementById('peso_kg').value);
                const tallaCm = parseFloat(document.getElementById('talla').value);
                const tallaM = tallaCm / 100;

                if (!isNaN(pesoKg) && pesoKg > 0 && !isNaN(tallaM) && tallaM > 0) {
                    const imc = pesoKg / (tallaM * tallaM);
                    document.getElementById('imc').value = imc.toFixed(1);
                } else {
                    document.getElementById('imc').value = '';
                }
            }
        </script>
    </div>
@endsection
