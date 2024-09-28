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

        <form action="{{ route('registro.storeStep1') }}" method="POST">
            @csrf
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
                    <input type="number" name='num_abortos' class="form-control"
                        value="{{ old('num_abortos', $datos['num_abortos'] ?? '') }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label>No. Hijos nacidos vivos</label>
                    <input type="number" name='num_hijos_vivos' class="form-control"
                        value="{{ old('num_hijos_vivos', $datos['num_hijos_vivos'] ?? '') }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label>No. Hijos nacidos muertos</label>
                    <input type="number" name='num_hijos_muertos' class="form-control"
                        value="{{ old('num_hijos_muertos', $datos['num_hijos_muertos'] ?? '') }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Peso (kg)</label>
                    <input type="number" step="0.1" id="peso" name="peso" class="form-control"
                        value="{{ old('peso', $datos['peso'] ?? '') }}" required oninput="calcularIMC()">
                </div>
                <div class="form-group col-md-4">
                    <label>Talla (cm)</label>
                    <input type="number" step="0.1" id="talla" name="talla" class="form-control"
                        value="{{ old('talla', $datos['talla'] ?? '') }}" required oninput="calcularIMC()">
                </div>
                <div class="form-group col-md-4">
                    <label>IMC</label>
                    <input type="number" step="0.1" id="imc" name="imc" class="form-control"
                        value="{{ old('imc', $datos['imc'] ?? '') }}" readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>CMB (Circunferencia de Brazo)</label>
                    <input type="number" step="0.1" name="cmb" class="form-control"
                        value="{{ old('cmb', $datos['cmb'] ?? '') }}" required>
                </div>
            </div>

            <!-- Sección Embarazo Actual -->
            <h4>Embarazo Actual</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No
                        </th>
                        <th>Descripción</th>
                        <th>A</th>
                        <th>B</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td>8</td>
                        <td>Diagnóstico o sospecha de embarazo múltiple</td>
                        <td><input type="radio" name="embarazo_multiple" value="A" required></td>
                        <td><input type="radio" name="embarazo_multiple" value="B" required></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Menos de 20 años</td>
                        <td><input type="radio" name="menos_20" value="A" required></td>
                        <td><input type="radio" name="menos_20" value="B" required></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Paciente Rh (-)</td>
                        <td><input type="radio" name="rh_negativo" value="A" required></td>
                        <td><input type="radio" name="rh_negativo" value="B" required></td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Más de 35 años</td>
                        <td><input type="radio" name="mas_35" value="A" required></td>
                        <td><input type="radio" name="mas_35" value="B" required></td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Hemorragia vaginal sin importar cantidad</td>
                        <td><input type="radio" name="hemorragia" value="A" required></td>
                        <td><input type="radio" name="hemorragia" value="B" required></td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>VIH positivo o sífilis positivo</td>
                        <td><input type="radio" name="vih_sifilis" value="A" required></td>
                        <td><input type="radio" name="vih_sifilis" value="B" required></td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>Presión arterial diastólica de 90 mm hg o más durante el registro de datos</td>
                        <td><input type="radio" name="presion_arterial" value="A" required></td>
                        <td><input type="radio" name="presion_arterial" value="B" required></td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td>Anemia clínica o de laboratorio</td>
                        <td><input type="radio" name="anemia" value="A" required></td>
                        <td><input type="radio" name="anemia" value="B" required></td>
                    </tr>
                    <tr>
                        <td>16</td>
                        <td>Desnutrición u obesidad</td>
                        <td><input type="radio" name="desnutricion" value="A" required></td>
                        <td><input type="radio" name="desnutricion" value="B" required></td>
                    </tr>
                </tbody>
                
            </table>

            <button type="submit" class="btn btn-success">Siguiente</button>
        </form>

        <script>
            function calcularIMC() {
                const peso = parseFloat(document.getElementById('peso').value);
                const talla = parseFloat(document.getElementById('talla').value) / 100;

                if (peso > 0 && talla > 0) {
                    const imc = peso / (talla * talla);
                    document.getElementById('imc').value = imc.toFixed(1);
                } else {
                    document.getElementById('imc').value = '';
                }
            }

            document.getElementById('fecha_ultima_regla').addEventListener('change', function() {
                const fechaUltimaRegla = new Date(this.value);
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
