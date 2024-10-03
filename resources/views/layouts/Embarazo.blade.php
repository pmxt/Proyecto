@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Ficha de Registro Obstétrico - Paso 2</h2>

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

        <form action="{{ route('embarazo.guardar') }}" method="POST">
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

            <!-- Sección Embarazo Actual -->
            <h4>Embarazo Actual</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Descripción</th>
                        <th>A</th>
                        <th>B</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>8</td>
                        <td>Diagnóstico o sospecha de embarazo múltiple</td>
                        <td><input type="radio" name="embarazo_multiple" value="Sí"
                                {{ old('embarazo_multiple') == 'Sí' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="embarazo_multiple" value="No"
                                {{ old('embarazo_multiple') == 'No' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Menos de 20 años</td>
                        <td><input type="radio" name="menos_20" value="Sí"
                                {{ old('menos_20') == 'Sí' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="menos_20" value="No"
                                {{ old('menos_20') == 'No' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Paciente Rh (-)</td>
                        <td><input type="radio" name="rh_negativo" value="Sí"
                                {{ old('rh_negativo') == 'Sí' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="rh_negativo" value="No"
                                {{ old('rh_negativo') == 'No' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Más de 35 años</td>
                        <td><input type="radio" name="mas_35" value="Sí"
                                {{ old('mas_35') == 'Sí' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="mas_35" value="No"
                                {{ old('mas_35') == 'No' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Hemorragia vaginal sin importar cantidad</td>
                        <td><input type="radio" name="hemorragia" value="Sí"
                                {{ old('hemorragia') == 'Sí' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="hemorragia" value="No"
                                {{ old('hemorragia') == 'No' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>VIH positivo o sífilis positivo</td>
                        <td><input type="radio" name="vih_sifilis" value="Sí"
                                {{ old('vih_sifilis') == 'Sí' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="vih_sifilis" value="No"
                                {{ old('vih_sifilis') == 'No' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>Presión arterial diastólica de 90 mm hg o más durante el registro de datos</td>
                        <td><input type="radio" name="presion_arterial" value="Sí"
                                {{ old('presion_arterial') == 'Sí' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="presion_arterial" value="No"
                                {{ old('presion_arterial') == 'No' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td>Anemia clínica o de laboratorio</td>
                        <td><input type="radio" name="anemia" value="Sí"
                                {{ old('anemia') == 'Sí' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="anemia" value="No"
                                {{ old('anemia') == 'No' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>16</td>
                        <td>Desnutrición u obesidad</td>
                        <td><input type="radio" name="desnutricion" value="Sí"
                                {{ old('desnutricion') == 'Sí' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="desnutricion" value="No"
                                {{ old('desnutricion') == 'No' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td>Dolor Abdominal</td>
                        <td><input type="radio" name="dolor_abdominal" value="Sí"
                                {{ old('dolor_abdominal') == 'Sí' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="dolor_abdominal" value="No"
                                {{ old('dolor_abdominal') == 'No' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>18</td>
                        <td>Sintomatología Uterina</td>
                        <td><input type="radio" name="sintomatologia_uterina" value="Sí"
                                {{ old('sintomatologia_uterina') == 'Sí' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="sintomatologia_uterina" value="No"
                                {{ old('sintomatologia_uterina') == 'No' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>19</td>
                        <td>Ictericia</td>
                        <td><input type="radio" name="ictericia" value="Sí"
                                {{ old('ictericia') == 'Sí' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="ictericia" value="No"
                                {{ old('ictericia') == 'No' ? 'checked' : '' }} required></td>
                    </tr>
                </tbody>
            </table>

            <button type="submit" class="btn btn-success">Siguiente</button>
        </form>
        <script>
            document.getElementById('fecha_ultima_regla').addEventListener('change', function() {
                const fechaUltimaRegla = new Date(this.value);
                // Sumar 280 días (40 semanas) a la fecha de la última regla
                const fechaProbableParto = new Date(fechaUltimaRegla);
                fechaProbableParto.setDate(fechaProbableParto.getDate() + 281);

                // Formatear la fecha probable de parto al formato YYYY-MM-DD
                const year = fechaProbableParto.getFullYear();
                const month = String(fechaProbableParto.getMonth() + 1).padStart(2, '0'); // Mes comienza en 0
                const day = String(fechaProbableParto.getDate()).padStart(2, '0');
                document.getElementById('fecha_probable_parto').value = `${year}-${month}-${day}`;
            });
        </script>
    </div>
@endsection
