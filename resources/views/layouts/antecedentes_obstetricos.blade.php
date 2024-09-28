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
                        <td>1</td>
                        <td>Muerte fetal o neonatal previa</td>
                        <td><input type="radio" name="muerte_fetal" value="A" required></td>
                        <td><input type="radio" name="muerte_fetal" value="B" required></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Antecedentes de 3 o más abortos espontáneos consecutivos</td>
                        <td><input type="radio" name="abortos_consecutivos" value="A" required></td>
                        <td><input type="radio" name="abortos_consecutivos" value="B" required></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Antecedentes de 3 o más gestas</td>
                        <td><input type="radio" name="gestas" value="A" required></td>
                        <td><input type="radio" name="gestas" value="B" required></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Peso al nacer del último bebé < 2500g (5 lbs 8 onzas)</td>
                        <td><input type="radio" name="peso_bebe_2500g" value="A" required></td>
                        <td><input type="radio" name="peso_bebe_2500g" value="B" required></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Peso al nacer del último bebé > 4500g (9 lbs 9 onzas)</td>
                        <td><input type="radio" name="peso_bebe_4500g" value="A" required></td>
                        <td><input type="radio" name="peso_bebe_4500g" value="B" required></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Antecedentes de hipertensión o preeclampsia/eclampsia</td>
                        <td><input type="radio" name="hipertension" value="A" required></td>
                        <td><input type="radio" name="hipertension" value="B" required></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Cirugías previas en el tracto reproductor (miomectomía, conización, cesárea o cerclaje cervical)</td>
                        <td><input type="radio" name="cirugias_reproductor" value="A" required></td>
                        <td><input type="radio" name="cirugias_reproductor" value="B" required></td>
                    </tr>
                </tbody>
            </table>

            
          

            <button type="submit" class="btn btn-success">Siguiente</button>
        </form>
    </div>
@endsection
