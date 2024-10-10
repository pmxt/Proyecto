@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cobertura Acumulada del Primer Control Prenatal</h2>
    
    <!-- Gráfica de cobertura acumulada -->
    <canvas id="graficoCobertura"></canvas>
    
    <!-- Tabla debajo de la gráfica -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Descripción</th>
                @foreach($meses as $mes)
                    <th>{{ $mes }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>No. de embarazadas en primer control</td>
                @foreach($casosReales as $index => $casos)
                    <td><input type="number" class="form-control" id="casos_{{ $index }}" value="{{ $casos }}" onchange="recalcular()"></td>
                @endforeach
            </tr>
            <tr>
                <td>Embarazos esperados por mes</td>
                @foreach($embarazosEsperadosPorMes as $index => $embarazosEsperados)
                    <td><input type="number" class="form-control" id="esperados_{{ $index }}" value="{{ $embarazosEsperados }}" onchange="recalcular()"></td>
                @endforeach
            </tr>
            <tr>
                <td>Resagos del mes</td>
                @foreach($rezagos as $index => $rezago)
                    <td id="resago_{{ $index }}">{{ $rezago }}</td>
                @endforeach
            </tr>
            <tr>
                <td>Cobertura Mensual Alcanzada</td>
                @foreach($coberturaMensual as $index => $cobertura)
                    <td id="coberturaMensual_{{ $index }}">{{ $cobertura }}%</td>
                @endforeach
            </tr>
            <tr>
                <td>Cobertura Acumulada</td>
                @foreach($coberturaAcumulada as $index => $cobertura)
                    <td id="coberturaAcumulada_{{ $index }}">{{ $cobertura }}%</td>
                @endforeach
            </tr>
            <tr>
                <td>Cobertura Ideal Acumulada</td>
                @foreach($coberturaIdeal as $index => $coberturaIdealMes)
                    <td>{{ $coberturaIdealMes }}%</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('graficoCobertura').getContext('2d');
    var graficoCobertura = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($meses),
            datasets: [
                {
                    label: 'Cobertura Acumulada',
                    data: @json($coberturaAcumulada),
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

    function recalcular() {
        var totalCasosAcumulados = 0;
        var embarazosEsperadosAnuales = 98; // Cambiar al valor correcto si lo necesitas.
        
        var casosReales = [];
        var embarazosEsperadosPorMes = [];
        var coberturaMensual = [];
        var coberturaAcumulada = [];
        var coberturaAcumuladaAnterior = 0;

        // Recolectar los valores actualizados
        @foreach ($meses as $index => $mes)
            casosReales.push(parseInt(document.getElementById('casos_{{ $index }}').value) || 0);
            embarazosEsperadosPorMes.push(parseInt(document.getElementById('esperados_{{ $index }}').value) || 0);
        @endforeach

        // Recalcular la cobertura y los rezagos
        for (var i = 0; i < casosReales.length; i++) {
            var resago = embarazosEsperadosPorMes[i] - casosReales[i];
            var coberturaMes = (casosReales[i] / embarazosEsperadosPorMes[i]) * 100 || 0;
            totalCasosAcumulados += casosReales[i];
            var coberturaAcumuladaMes = (totalCasosAcumulados / embarazosEsperadosAnuales) * 100 || 0;

            coberturaMensual.push(coberturaMes.toFixed(2));
            coberturaAcumulada.push(coberturaAcumuladaMes.toFixed(2));

            // Actualizar la tabla con los nuevos valores
            document.getElementById('resago_' + i).innerText = resago;
            document.getElementById('coberturaMensual_' + i).innerText = coberturaMensual[i] + '%';
            document.getElementById('coberturaAcumulada_' + i).innerText = coberturaAcumulada[i] + '%';
        }

        // Actualizar la gráfica
        graficoCobertura.data.datasets[0].data = coberturaAcumulada;
        graficoCobertura.update();
    }
</script>

@endsection
