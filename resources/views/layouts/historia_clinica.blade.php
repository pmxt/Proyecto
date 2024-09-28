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

        <form action="" method="POST">
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
                        <td><input type="checkbox" name="diabetes_a" value="1"></td>
                        <td><input type="checkbox" name="diabetes_b" value="1"></td>
                    </tr>
                    <tr>
                        <td>21</td>
                        <td>Enfermedad renal</td>
                        <td><input type="checkbox" name="renal_a" value="1"></td>
                        <td><input type="checkbox" name="renal_b" value="1"></td>
                    </tr>
                    <tr>
                        <td>22</td>
                        <td>Enfermedad del Corazón</td>
                        <td><input type="checkbox" name="corazon_a" value="1"></td>
                        <td><input type="checkbox" name="corazon_b" value="1"></td>
                    </tr>
                    <tr>
                        <td>23</td>
                        <td>Hipertensión Arterial</td>
                        <td><input type="checkbox" name="hipertension_a" value="1"></td>
                        <td><input type="checkbox" name="hipertension_b" value="1"></td>
                    </tr>
                    <tr>
                        <td>24</td>
                        <td>Consumo de drogas, incluido alcohol/tabaco</td>
                        <td><input type="checkbox" name="drogas_a" value="1"></td>
                        <td><input type="checkbox" name="drogas_b" value="1"></td>
                    </tr>
                    <tr>
                        <td>25</td>
                        <td>Cualquier otra enfermedad o afección médica severa</td>
                        <td><input type="checkbox" name="otra_a" value="1"></td>
                        <td><input type="checkbox" name="otra_b" value="1"></td>
                    </tr>
                </tbody>
            </table>

            <div class="form-group">
                <label for="especificacion">Por favor especifique</label>
                <textarea name="especificacion" id="especificacion" class="form-control"></textarea>
            </div>

            <p>La presencia de alguna de las características anteriores hace necesaria la evaluación de la paciente por un médico, quien tomará las decisiones de referirla o no a otro servicio de mayor complejidad.</p>

            <div class="form-group">
                <label for="referido_a">Si la respuesta es sí, será referido a</label>
                <input type="text" name="referido_a" id="referido_a" class="form-control">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="responsable">Nombre de la persona responsable</label>
                    <input type="text" name="responsable" id="responsable" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-success">Siguiente</button>
        </form>
    </div>
@endsection
