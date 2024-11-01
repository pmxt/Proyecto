@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table td,
        .table th {
            font-size: 0.8rem;
            
        }

        .table input {
            font-size: 0.8rem;
         
            padding: 0.25rem;
           
        }

        .card {
            padding: 1.5rem;
        }

        .form-control {
            font-size: 0.9rem;
            
        }
    </style>
@endsection

@section('content')
    <div class="container">
    
        <div class="mb-4">
            <a href="{{ route('home') }}" class="btn btn-primary">Volver</a>
        </div>
    
        
            <h2 class="text-center">Cobertura Acumulada del Primer Control Prenatal</h2>
           
            <div class="mb-3 d-flex flex-column flex-md-row justify-content-center">
                <a href="{{ route('ingresarMes', ['anio' => $anioSeleccionado]) }}" class="btn btn-secondary mr-md-2 mb-2 mb-md-0">Ingresar Datos de Mes</a>
                <a href="{{ route('ingresarAnio') }}" class="btn btn-secondary">Agregar Nuevo Año</a>
            </div>
          
            <form method="GET" action="{{ route('grafica1') }}">
                <label for="anio">Seleccionar Año:</label>
                <select name="anio" id="anio" onchange="this.form.submit()">
                    @foreach ($anios as $anio)
                        <option value="{{ $anio }}" {{ $anioSeleccionado == $anio ? 'selected' : '' }}>
                            {{ $anio }}
                        </option>
                    @endforeach
                </select>
            </form>

         
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="servicio_salud" class="form-label">Servicio de Salud:</label>
                    <input type="text" id="servicio_salud" class="form-control" value="{{ $servicioSalud }}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="distrito_salud" class="form-label">Distrito de Salud:</label>
                    <input type="text" id="distrito_salud" class="form-control" value="{{ $distritoSalud }}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="area_salud" class="form-label">Área de Salud:</label>
                    <input type="text" id="area_salud" class="form-control" value="{{ $areaSalud }}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="anio" class="form-label">Año:</label>
                    <input type="number" id="anio" class="form-control" value="{{ $anioSeleccionado }}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="poblacion_meta" class="form-label">Población Meta:</label>
                    <input type="number" id="poblacion_meta" class="form-control" value="{{ $poblacionMeta }}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="embarazos_esperados" class="form-label">Total de Embarazos Esperados:</label>
                    <input type="number" id="embarazos_esperados" class="form-control" value="{{ $embarazosEsperados }}" disabled>
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
                            <td>No. de embarazadas en primer control</td>
                            @foreach ($casosReales as $index => $casos)
                                <td><input type="number" class="form-control" id="casos_{{ $index }}"
                                        value="{{ $casos }}" onchange="recalcular()" disabled></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Embarazos esperados por mes</td>
                            @foreach ($embarazosEsperadosPorMes as $index => $embarazosEsperados)
                                <td><input type="number" class="form-control" id="esperados_{{ $index }}"
                                        value="{{ $embarazosEsperados }}" onchange="recalcular()" disabled></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Resagos del mes</td>
                            @foreach ($rezagos as $index => $rezago)
                                <td id="resago_{{ $index }}">{{ $rezago }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Cobertura Mensual Alcanzada</td>
                            @foreach ($coberturaMensual as $index => $cobertura)
                                <td id="coberturaMensual_{{ $index }}">{{ $cobertura }}%</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Cobertura Acumulada</td>
                            @foreach ($coberturaAcumulada as $index => $cobertura)
                                <td id="coberturaAcumulada_{{ $index }}">{{ $cobertura }}%</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Cobertura Ideal Acumulada</td>
                            @foreach ($coberturaIdeal as $index => $coberturaIdealMes)
                                <td>{{ $coberturaIdealMes }}%</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var graficoCobertura; // Definimos la variable globalmente

        // Inicializar el gráfico solo una vez
        function inicializarGrafico() {
            var ctx = document.getElementById('graficoCobertura').getContext('2d');

            graficoCobertura = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($meses),
                    datasets: [{
                            label: 'Cobertura Acumulada',
                            data: @json($coberturaAcumulada), // Datos iniciales
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            fill: true,
                        },
                        {
                            label: 'Cobertura Ideal',
                            data: @json($coberturaIdeal),
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
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        }
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        }
                    }
                }
            });
        }

        // Función para recalcular y actualizar la gráfica
        function recalcular() {
            let totalMuestra = 98;
            let coberturaAcumulada = 0;
            let resagoAnterior = 0;

            let meses = @json($meses);
            let embarazosRealizados = [];
            let embarazosEsperados = [];

            meses.forEach((mes, index) => {
                let casos = parseInt(document.getElementById('casos_' + index).value) || 0;
                let esperados = parseInt(document.getElementById('esperados_' + index).value) || 0;
                embarazosRealizados.push(casos);
                embarazosEsperados.push(esperados);
            });

            let coberturasAcumuladas = [];
            let resagos = [];
            let coberturasMensuales = [];
            coberturaAcumulada = 0;
            resagoAnterior = 0;

            for (let i = 0; i < meses.length; i++) {
                let resagoMes = embarazosEsperados[i] - embarazosRealizados[i];
                if (resagoMes > 0) {
                    resagoMes += resagoAnterior; // Acumulamos el rezago del mes anterior
                } else {
                    resagoMes = resagoAnterior;
                }

                document.getElementById('resago_' + i).innerText = resagoMes;
                resagos.push(resagoMes);

                resagoAnterior = resagoMes;

                let coberturaMes = (embarazosRealizados[i] / totalMuestra) * 100;
                coberturaMes = parseFloat(coberturaMes.toFixed(2));
                document.getElementById('coberturaMensual_' + i).innerText = coberturaMes + '%';
                coberturasMensuales.push(coberturaMes);

                coberturaAcumulada += coberturaMes;
                document.getElementById('coberturaAcumulada_' + i).innerText = coberturaAcumulada.toFixed(2) + '%';
                coberturasAcumuladas.push(coberturaAcumulada.toFixed(2));
            }

            graficoCobertura.data.datasets[0].data = coberturasAcumuladas;
            graficoCobertura.update();
        }

        window.onload = function() {
            inicializarGrafico();
        }

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('change', recalcular);
        });
    </script>
@endsection