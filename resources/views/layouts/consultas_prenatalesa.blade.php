@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h2 class="text-center">Registro de Consulta Prenatal</h2>

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

    


        <!-- Tipo de Servicio -->
        <div class="form-group">
            <label for="tipo_servicio">Tipo de Servicio</label>
            <select name="tipo_servicio" id="tipo_servicio" class="form-control" required>
                <option value="">Seleccione el tipo de servicio</option>
                <option value="PSF">PSF</option>
                <option value="C/S 'A'">C/S 'A'</option>
                <option value="C/S 'B'">C/S 'B'</option>
                <option value="CENAPA">CENAPA</option>
                <option value="CAP">CAP</option>
                <option value="CAIMI">CAIMI</option>
            </select>
        </div>

         <!-- Fecha de la Consulta -->
         <div class="form-group">
            <label for="fecha_consulta">Fecha de la Consulta</label>
            <input type="date" name="fecha_consulta" id="fecha_consulta" class="form-control" required>
        </div>


        <!-- Área de Salud -->
        <div class="form-group">
            <label for="area_salud">Área de Salud</label>
            <input type="text" name="area_salud" id="area_salud" class="form-control" placeholder="Ingrese el área de salud" required>
        </div>

        <!-- Nombre del Servicio -->
        <div class="form-group">
            <label for="nombre_servicio">Distrito</label>
            <input type="text" name="nombre_servicio" id="nombre_servicio" class="form-control" placeholder="Ingrese el nombre del servicio" required>
        </div>

        <!-- Motivo de Consulta -->
        <div class="form-group">
            <label for="motivo_consulta">Motivo de la Consulta</label>
            <select name="motivo_consulta" id="motivo_consulta" class="form-control" required>
                <option value="">Seleccione el motivo de la consulta</option>
                <option value="Pre Natal">Pre Natal</option>
                <option value="Post Natal">Post Natal</option>
                <option value="Otro">Otro</option>
            </select>
        </div>

        <!-- Historia del Problema -->
        <div class="form-group">
            <label for="historia_problema">Historia del Problema</label>
            <textarea name="historia_problema" id="historia_problema" class="form-control" rows="4" placeholder="Describa el problema o motivo de la consulta" required></textarea>
        </div>

       
        <!-- Botón para Enviar el Formulario -->
        <button type="submit" class="btn btn-success">Registrar Consulta</button>
    </form>
</div>
@endsection
