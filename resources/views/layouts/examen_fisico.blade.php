@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Examen Físico de la Embarazada</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="" method="POST">
            @csrf

            <!-- Signos Vitales -->
            <h4>Signos Vitales</h4>
            <div class="form-group">
                <label for="presion_arterial">Presión Arterial</label>
                <input type="text" name="presion_arterial" id="presion_arterial" class="form-control" placeholder="mmHg" required>
            </div>
            <div class="form-group">
                <label for="temperatura_corporal">Temperatura Corporal</label>
                <input type="text" name="temperatura_corporal" id="temperatura_corporal" class="form-control" placeholder="°C" required>
            </div>
            <div class="form-group">
                <label for="peso">Peso (libras)</label>
                <input type="number" name="peso" id="peso" class="form-control" placeholder="Ingrese el peso en libras" required>
            </div>
            <div class="form-group">
                <label for="frecuencia_respiratoria">Frecuencia Respiratoria</label>
                <input type="number" name="frecuencia_respiratoria" id="frecuencia_respiratoria" class="form-control" placeholder="Respiraciones por minuto" required>
            </div>
            <div class="form-group">
                <label for="frecuencia_cardiaca_materna">Frecuencia Cardiaca Materna</label>
                <input type="number" name="frecuencia_cardiaca_materna" id="frecuencia_cardiaca_materna" class="form-control" placeholder="Latidos por minuto" required>
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
                                <input type="radio" name="estado_general" id="palidez_si" value="si">
                                <label for="palidez_no">No</label>
                                <input type="radio" name="estado_general" id="palidez_no" value="no">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <label for="examen_bucal">Examen Bucal/Dental</label>
                <input type="text" name="examen_bucal" id="examen_bucal" class="form-control" placeholder="Ingrese hallazgos dentales" required>
            </div>

            <!-- Examen Obstétrico -->
            <h4>Examen Obstétrico</h4>
            <div class="form-group">
                <label for="altura_uterina">Altura Uterina</label>
                <input type="text" name="altura_uterina" id="altura_uterina" class="form-control" placeholder="Ingrese la altura uterina" required>
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
                                <input type="radio" name="movimientos_fetales" id="movimientos_fetales_si" value="si">
                                <label for="movimientos_fetales_no">No</label>
                                <input type="radio" name="movimientos_fetales" id="movimientos_fetales_no" value="no">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <label for="frecuencia_cardiaca_fetal">Frecuencia Cardiaca Fetal (si procede)</label>
                <input type="text" name="frecuencia_cardiaca_fetal" id="frecuencia_cardiaca_fetal" class="form-control" placeholder="Ingrese la frecuencia cardiaca fetal" required>
            </div>
            <div class="form-group">
                <label for="leopoldo">Presentación por Leopoldo</label>
                <input type="text" name="leopoldo" id="leopoldo" class="form-control" placeholder="Ingrese la presentación por Leopoldo" required>
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
                                <input type="radio" name="trazas_sangre" id="trazas_sangre_si" value="si">
                                <label for="trazas_sangre_no">No</label>
                                <input type="radio" name="trazas_sangre" id="trazas_sangre_no" value="no">
                            </td>
                        </tr>
                        <tr>
                            <td>Verrugas, herpes, papiloma, ulceras</td>
                            <td>
                                <label for="verrugas_si">Sí</label>
                                <input type="radio" name="verrugas" id="verrugas_si" value="si">
                                <label for="verrugas_no">No</label>
                                <input type="radio" name="verrugas" id="verrugas_no" value="no">
                            </td>
                        </tr>
                        <tr>
                            <td>Flujo Vaginal</td>
                            <td>
                                <label for="flujo_vaginal_si">Sí</label>
                                <input type="radio" name="flujo_vaginal" id="flujo_vaginal_si" value="si">
                                <label for="flujo_vaginal_no">No</label>
                                <input type="radio" name="flujo_vaginal" id="flujo_vaginal_no" value="no">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Exámenes de Laboratorio -->
            <h4>Exámenes de Laboratorio</h4>
            <div class="form-group">
                <label for="hemoglobina">Hemoglobina y Hematocrito</label>
                <input type="text" name="hemoglobina" id="hemoglobina" class="form-control" placeholder="Ingrese los niveles de hemoglobina" required>
            </div>
            <div class="form-group">
                <label for="grupo_rh">Grupo y RH</label>
                <input type="text" name="grupo_rh" id="grupo_rh" class="form-control" placeholder="Ingrese el grupo y RH" required>
            </div>
            <div class="form-group">
                <label for="orina">Orina (proteínas, glucosa, cetonas)</label>
                <input type="text" name="orina" id="orina" class="form-control" placeholder="Ingrese los resultados de la orina" required>
            </div>
            <div class="form-group">
                <label for="glicemia">Glicemia</label>
                <input type="text" name="glicemia" id="glicemia" class="form-control" placeholder="Ingrese los niveles de glicemia" required>
            </div>
            <div class="form-group">
                <label for="vdrl">VDRL</label>
                <input type="text" name="vdrl" id="vdrl" class="form-control" placeholder="Ingrese los resultados de VDRL" required>
            </div>
            <div class="form-group">
                <label for="vih">VIH</label>
                <input type="text" name="vih" id="vih" class="form-control" placeholder="Ingrese los resultados de VIH" required>
            </div>
            <div class="form-group">
                <label for="papanicolau">Papanicolau</label>
                <input type="text" name="papanicolau" id="papanicolau" class="form-control" placeholder="Ingrese los resultados del Papanicolau" required>
            </div>
            <div class="form-group">
                <label for="infecciones">Infecciones</label>
                <input type="text" name="infecciones" id="infecciones" class="form-control" placeholder="Ingrese las infecciones detectadas" required>
            </div>

            <!-- Clasificación -->
            <h4>Clasificación</h4>
            <div class="form-group">
                <label for="semanas_embarazo">Semanas de embarazo</label>
                <input type="text" name="semanas_embarazo" id="semanas_embarazo" class="form-control" placeholder="Ingrese las semanas de embarazo" required>
            </div>
            <div class="form-group">
                <label for="problemas_detectados">Problemas detectados</label>
                <input type="text" name="problemas_detectados" id="problemas_detectados" class="form-control" placeholder="Ingrese los problemas detectados" required>
            </div>

            <!-- Botón para Enviar el Formulario -->
            <button type="submit" class="btn btn-success">Guardar Examen Físico</button>
        </form>
    </div>
@endsection

