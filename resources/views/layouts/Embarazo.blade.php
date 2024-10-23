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

        <form action="{{ route('embarazo.guardar') }}" method="POST">
            @csrf
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
                        <td><input type="radio" name="embarazo_multiple" value="si" {{ old('embarazo_multiple') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="embarazo_multiple" value="no" {{ old('embarazo_multiple') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Menos de 20 años</td>
                        <td><input type="radio" name="menos_20" value="si" {{ old('menos_20') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="menos_20" value="no" {{ old('menos_20') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Paciente Rh (-)</td>
                        <td><input type="radio" name="rh_negativo" value="si" {{ old('rh_negativo') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="rh_negativo" value="no" {{ old('rh_negativo') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Más de 35 años</td>
                        <td><input type="radio" name="mas_35" value="si" {{ old('mas_35') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="mas_35" value="no" {{ old('mas_35') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Hemorragia vaginal sin importar cantidad</td>
                        <td><input type="radio" name="hemorragia" value="si" {{ old('hemorragia') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="hemorragia" value="no" {{ old('hemorragia') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>VIH positivo o sífilis positivo</td>
                        <td><input type="radio" name="vih_sifilis" value="si" {{ old('vih_sifilis') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="vih_sifilis" value="no" {{ old('vih_sifilis') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>Presión arterial diastólica de 90 mm hg o más durante el registro de datos</td>
                        <td><input type="radio" name="presion_arterial" value="si" {{ old('presion_arterial') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="presion_arterial" value="no" {{ old('presion_arterial') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td>Anemia clínica o de laboratorio</td>
                        <td><input type="radio" name="anemia" value="si" {{ old('anemia') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="anemia" value="no" {{ old('anemia') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>16</td>
                        <td>Desnutrición u obesidad</td>
                        <td><input type="radio" name="desnutricion" value="si" {{ old('desnutricion') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="desnutricion" value="no" {{ old('desnutricion') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td>Dolor Abdominal</td>
                        <td><input type="radio" name="dolor_abdominal" value="si" {{ old('dolor_abdominal') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="dolor_abdominal" value="no" {{ old('dolor_abdominal') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>18</td>
                        <td>Sintomatología Uterina</td>
                        <td><input type="radio" name="sintomatologia_uterina" value="si" {{ old('sintomatologia_uterina') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="sintomatologia_uterina" value="no" {{ old('sintomatologia_uterina') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                    <tr>
                        <td>19</td>
                        <td>Ictericia</td>
                        <td><input type="radio" name="ictericia" value="si" {{ old('ictericia') == 'si' ? 'checked' : '' }} required></td>
                        <td><input type="radio" name="ictericia" value="no" {{ old('ictericia') == 'no' ? 'checked' : '' }} required></td>
                    </tr>
                </tbody>
            </table>

            <button type="submit" class="btn btn-success">Siguiente</button>
        </form>

    </div>
@endsection
