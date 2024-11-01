@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Aseguramos que el gráfico esté centrado */
        .chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 400px;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <h2 class="text-center">Alcance de Embarazos en {{ $anioSeleccionado }}</h2>

    <form action="{{ route('graficaPastel') }}" method="GET" class="mb-4">
        <div class="input-group">
            <select name="anio" class="form-control" onchange="this.form.submit()">
                @foreach($anios as $anio)
                    <option value="{{ $anio }}" {{ $anio == $anioSeleccionado ? 'selected' : '' }}>{{ $anio }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Ver Gráfica</button>
            </div>
        </div>
    </form>

    <div class="chart-container">
        <canvas id="graficoAlcanceEmbarazos" style="max-width: 500px;"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('graficoAlcanceEmbarazos').getContext('2d');
        var graficoAlcanceEmbarazos = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Embarazos Realizados', 'Embarazos Faltantes'],
                datasets: [{
                    data: [{{ $embarazosRealizadosTotal }}, {{ $embarazosFaltantes }}],
                    backgroundColor: ['#4CAF50', '#FF6384'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            padding: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                let label = tooltipItem.label || '';
                                let value = tooltipItem.raw || 0;
                                return `${label}: ${value}`;
                            }
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        formatter: (value, ctx) => {
                            let label = ctx.chart.data.labels[ctx.dataIndex];
                            return `${label}: ${value}`;
                        },
                        font: {
                            weight: 'bold',
                            size: 14
                        }
                    }
                },
                layout: {
                    padding: {
                        top: 20,
                        bottom: 20
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    });
</script>
@endsection
