@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estilosU.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Diagnóstico Nutricional - Embarazo</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario para ingresar datos de peso, talla y semanas de gestación --}}
        <form>
            <div class="form-group">
                <label for="peso">Peso (kg)</label>
                <input type="number" step="0.1" id="peso" class="form-control" placeholder="Ingresa el peso en kg" required>
            </div>

            <div class="form-group">
                <label for="talla">Talla (cm)</label>
                <input type="number" step="0.1" id="talla" class="form-control" placeholder="Ingresa la talla en cm" required>
            </div>

            <div class="form-group">
                <label for="semanas_gestacion">Semanas de gestación</label>
                <input type="number" id="semanas_gestacion" class="form-control" placeholder="Ingresa las semanas de gestación" required>
            </div>

            {{-- Mostrar resultados del IMC y diagnóstico --}}
            <div class="mt-3">
                <p><strong>IMC Calculado:</strong> <span id="imc_result">--</span></p>
                <p><strong>Diagnóstico:</strong> <span id="diagnostico_result">--</span></p>
            </div>
        </form>

        {{-- Añadimos el canvas para la gráfica de Chart.js --}}
        <div class="mt-5">
            <canvas id="imcChart" width="50" height="50"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('imcChart').getContext('2d');
            var imcChart = new Chart(ctx, {
                type: 'line', // Tipo de gráfico
                data: {
                    datasets: [{
                        label: 'Bajo Peso (E)',
                        data: [{x: 10, y: 20}, {x: 15, y: 21}, {x: 20, y: 22}, {x: 25, y: 23}, {x: 30, y: 23.5}, {x: 35, y: 24.5}, {x: 40, y: 25}], 
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Normopeso (N)',
                        data: [{x: 10, y: 25.5}, {x: 15, y: 26}, {x: 20, y: 26.1}, {x: 25, y: 26.5}, {x: 30, y: 27}, {x: 35, y: 28}, {x: 40, y: 29}], 
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Sobrepeso (S)',
                        data: [{x: 10, y: 30}, {x: 15, y: 31}, {x: 20, y: 31.5}, {x: 25, y: 32}, {x: 30, y: 32.5}, {x: 35, y: 33}, {x: 40, y: 33}], 
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Obesidad (O)',
                        data: [{x: 10, y: 39.9}, {x: 15, y: 39.9}, {x: 20, y: 39.9}, {x: 25, y: 39.9}, {x: 30, y: 39.9}, {x: 35, y: 39.9}, {x: 40, y: 39.9}], 
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'linear', // Cambiar el eje X a un eje numérico
                            beginAtZero: false,
                            min: 10,
                            max: 40,
                            ticks: {
                                stepSize: 5
                            },
                            title: {
                                display: true,
                                text: 'Semanas de gestación'
                            }
                        },
                        y: {
                            beginAtZero: false,
                            max: 40,
                            min: 15,
                            title: {
                                display: true,
                                text: 'IMC'
                            }
                        }
                    }
                }
            });

            // Función para calcular el IMC y mostrar el diagnóstico
            function calcularIMC() {
                const peso = parseFloat(document.getElementById('peso').value);
                const talla = parseFloat(document.getElementById('talla').value) / 100; // Convertir a metros
                const semanas = parseInt(document.getElementById('semanas_gestacion').value);

                if (!isNaN(peso) && peso > 0 && !isNaN(talla) && talla > 0 && !isNaN(semanas) && semanas > 0 && semanas <= 40) {
                    const imc = peso / (talla * talla); // Cálculo del IMC
                    document.getElementById('imc_result').textContent = imc.toFixed(1); // Mostrar el IMC con 1 decimal

                    // Diagnóstico según el valor de IMC
                    let diagnostico = '';
                    if (imc < 20) {
                        diagnostico = 'Bajo peso';
                    } else if (imc >= 20 && imc < 29) {
                        diagnostico = 'Peso normal';
                    } else if (imc >= 30 && imc < 39) {
                        diagnostico = 'Sobrepeso';
                    } else {
                        diagnostico = 'Obesidad';
                    }
                    document.getElementById('diagnostico_result').textContent = diagnostico; // Mostrar el diagnóstico

                    // Actualizar la gráfica con el IMC del paciente
                    actualizarGrafica(imc, semanas);
                } else {
                    document.getElementById('imc_result').textContent = '--'; // Reiniciar si hay errores
                    document.getElementById('diagnostico_result').textContent = '--'; // Reiniciar diagnóstico
                }
            }

            // Función para actualizar la gráfica de Chart.js con el IMC calculado
            function actualizarGrafica(imc, semanas) {
                // Eliminar los datos anteriores del IMC en la gráfica (si existen)
                imcChart.data.datasets = imcChart.data.datasets.filter((dataset) => dataset.label !== 'IMC Paciente');

                // Añadir los nuevos datos del IMC del paciente a la gráfica con las semanas y el IMC correctos
                imcChart.data.datasets.push({
                    label: 'IMC Paciente',
                    data: [{ x: semanas, y: imc }], // Utiliza la semana en el eje X y el IMC en el eje Y
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderWidth: 2,
                    pointRadius: 6, // Para resaltar el punto
                    pointBackgroundColor: 'rgba(153, 102, 255, 1)',
                    fill: false
                });

                // Actualizar la gráfica
                imcChart.update();
            }

            // Event listeners para recalcular el IMC y actualizar la gráfica en tiempo real
            document.getElementById('peso').addEventListener('input', calcularIMC);
            document.getElementById('talla').addEventListener('input', calcularIMC);
            document.getElementById('semanas_gestacion').addEventListener('input', calcularIMC);
        </script>
    </div>
@endsection
