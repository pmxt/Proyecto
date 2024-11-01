@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table td, .table th { font-size: 0.8rem; }
        .table input { font-size: 0.8rem; padding: 0.25rem; }
        .card { padding: 1.5rem; }
        .form-control { font-size: 0.9rem; }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="mb-4">
            <a href="{{ route('home') }}" class="btn btn-primary">Volver</a>
        </div>
        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('medicos.ingresarAnio') }}" class="btn btn-info">Ingresar Año</a>
            <a href="{{ route('medicos.ingresarMes', ['anio' => $anioSeleccionado]) }}" class="btn btn-info">Ingresar Mes</a>
        </div>
        <form method="GET" action="{{ route('medicos.grafica') }}">
            <label for="anio">Seleccionar Año:</label>
            <select name="anio" id="anio" onchange="this.form.submit()">
                @foreach ($anios as $anio)
                    <option value="{{ $anio }}" {{ $anioSeleccionado == $anio ? 'selected' : '' }}>{{ $anio }}</option>
                @endforeach
            </select>
        </form>

        <h2 class="text-center">Gráfica de Partos Atendidos por Médicos</h2>

        <form action="" method="POST">
            @csrf
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="servicio_salud" class="form-label">Servicio de Salud:</label>
                    <input type="text" id="servicio_salud" class="form-control" name="servicio_salud" value="{{ $servicioSalud }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="distrito_salud" class="form-label">Distrito de Salud:</label>
                    <input type="text" id="distrito_salud" class="form-control" name="distrito_salud" value="{{ $distritoSalud }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="area_salud" class="form-label">Área de Salud:</label>
                    <input type="text" id="area_salud" class="form-control" name="area_salud" value="{{ $areaSalud }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="anio" class="form-label">Año:</label>
                    <input type="number" id="anio" class="form-control" name="anio" value="{{ $anioSeleccionado }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="poblacion_meta" class="form-label">Población Meta:</label>
                    <input type="number" id="poblacion_meta" class="form-control" name="poblacion_meta" value="{{ $poblacionMeta }}" readonly>
                </div>
            </div>

            <div class="mb-4">
                <canvas id="graficoCobertura" width="400" height="300"></canvas>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            @foreach ($meses as $mes)
                                <th>{{ $mes }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>No. Partos Atendidos por Médico</td>
                            @foreach ($cobertura as $dato)
                                <td><input type="number" class="form-control" id="partos_{{ $loop->index }}" name="partos[]" value="{{ $dato->partos_atendidos ?? 0 }}" onchange="actualizarCobertura()"></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Cobertura Mensual Alcanzada</td>
                            @foreach ($cobertura as $dato)
                                <td id="coberturaMensual_{{ $loop->index }}">{{ $dato->cobertura_mensual ?? 0 }}%</td>
                                <input type="hidden" name="cobertura_mensual[]" id="inputCoberturaMensual_{{ $loop->index }}" value="{{ $dato->cobertura_mensual ?? 0 }}">
                            @endforeach
                        </tr>
                        <tr>
                            <td>Cobertura Acumulada</td>
                            @foreach ($cobertura as $dato)
                                <td id="coberturaAcumulada_{{ $loop->index }}">{{ $dato->cobertura_acumulada ?? 0 }}%</td>
                                <input type="hidden" name="cobertura_acumulada[]" id="inputCoberturaAcumulada_{{ $loop->index }}" value="{{ $dato->cobertura_acumulada ?? 0 }}">
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-success">Guardar Datos</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var graficoCobertura;
        var poblacionMeta = {{ $poblacionMeta }};
        var coberturasAcumuladas = @json($cobertura->pluck('cobertura_acumulada'));

        function inicializarGrafico() {
            var ctx = document.getElementById('graficoCobertura').getContext('2d');
            graficoCobertura = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($meses),
                    datasets: [{
                            label: 'Cobertura Acumulada Alcanzada',
                            data: coberturasAcumuladas,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            fill: true,
                        },
                        {
                            label: 'Cobertura Ideal',
                            data: Array(12).fill(100),
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderWidth: 2,
                            fill: false,
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                stepSize: 20,
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        }
                    },
                    responsive: true,
                    plugins: {
                        legend: { display: true }
                    }
                }
            });
        }

        function actualizarCobertura() {
            let coberturaAcumulada = 0;

            for (let i = 0; i < 12; i++) {
                const partosAtendidos = parseInt(document.getElementById('partos_' + i).value) || 0;
                const coberturaMensual = ((partosAtendidos / poblacionMeta) * 100).toFixed(2);

                document.getElementById('coberturaMensual_' + i).innerText = coberturaMensual + '%';
                document.getElementById('inputCoberturaMensual_' + i).value = coberturaMensual;

                coberturaAcumulada += parseFloat(coberturaMensual);
                document.getElementById('coberturaAcumulada_' + i).innerText = coberturaAcumulada.toFixed(2) + '%';
                document.getElementById('inputCoberturaAcumulada_' + i).value = coberturaAcumulada;

                graficoCobertura.data.datasets[0].data[i] = coberturaAcumulada;
            }

            graficoCobertura.update();
        }

        window.onload = function() {
            inicializarGrafico();
        }
    </script>
@endsection
