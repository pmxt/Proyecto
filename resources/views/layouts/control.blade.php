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
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario para seleccionar el paciente -->
        <form action="{{ route('nutricion.Obtener') }}" method="GET">
            @csrf
            <div class="form-group">
                <label for="paciente">Seleccionar Paciente</label>
                <select name="paciente_cui" id="paciente" class="form-control" required onchange="this.form.submit()">
                    <option value="">-- Selecciona un paciente --</option>
                    @foreach ($pacientes as $paciente)
                        <option value="{{ $paciente->cui }}"
                            {{ request('paciente_cui') == $paciente->cui ? 'selected' : '' }}>
                            {{ $paciente->name }} - {{ $paciente->cui }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- Mostrar los embarazos si se seleccionó un paciente -->
        @if (!empty($embarazos))
            <form action="{{ route('nutricion.Obtener') }}" method="GET">
                @csrf
                <input type="hidden" name="paciente_cui" value="{{ request('paciente_cui') }}">
                <div class="form-group">
                    <label for="embarazo_id">Seleccionar Embarazo:</label>
                    <select id="embarazo_id" name="embarazo_id" class="form-control" required onchange="this.form.submit()">
                        <option value="">-- Seleccionar Embarazo --</option>
                        @foreach ($embarazos as $embarazo)
                            <option value="{{ $embarazo->id }}"
                                {{ request('embarazo_id') == $embarazo->id ? 'selected' : '' }}>
                                Embarazo {{ $embarazo->id }} - FPP: {{ $embarazo->fecha_probable_parto }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        @endif

        <!-- Mostrar controles nutricionales si se seleccionó un embarazo -->
        @if (!empty($controlesNutricionales))
            <h3>Controles Nutricionales</h3>
            <ul>
                @foreach ($controlesNutricionales as $control)
                    <li>Control {{ $control->numero_control }} - Fecha: {{ $control->fecha_control }}</li>
                @endforeach
            </ul>
        @endif

        @if (request('embarazo_id'))
            <form action="{{ route('nutricion.guardar') }}" method="POST">
                @csrf
                <!-- Asegúrate de que el campo embarazo_id esté incluido -->
                <input type="hidden" name="embarazo_id" value="{{ request('embarazo_id') }}">




                <div class="form-group">
                    <label for="numero_control">Número de Control</label>
                    <input type="number" id="numero_control" name="numero_control" class="form-control" min="1"
                        max="10" required>
                </div>

                <div class="form-group">
                    <label for="fecha_control">Fecha de Control</label>
                    <input type="date" id="fecha_control" name="fecha_control" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="peso_libras">Peso (lb)</label>
                    <input type="number" step="0.1" id="peso_libras" name="peso_libras" class="form-control"
                        placeholder="Ingresa el peso en libras" required>
                </div>

                <div class="form-group">
                    <label for="peso_kg">Peso (kg)</label>
                    <input type="text" id="peso_kg" name="peso_kg" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="talla">Talla (cm)</label>
                    <input type="number" step="0.1" id="talla" name="talla" class="form-control"
                        placeholder="Ingresa la talla en cm" required>
                </div>

                <div class="form-group">
                    <label for="semanas_gestacion">Semanas de gestación</label>
                    <input type="number" id="semanas_gestacion" name="semanas_gestacion" class="form-control"
                        placeholder="Ingresa las semanas de gestación" required>
                </div>

                <div class="mt-3">
                    <p><strong>IMC Calculado:</strong> <span id="imc_result">--</span></p>
                    <p><strong>Diagnóstico:</strong> <span id="diagnostico_result">--</span></p>
                </div>

                <div class="form-group">
                    <label for="ganancia_peso">Ganancia de peso (kg)</label>
                    <input type="number" step="0.1" id="ganancia_peso" name="ganancia_peso" class="form-control"
                        placeholder="Ingresa la ganancia de peso" required>
                </div>

                <div class="form-group">
                    <label for="responsable">Nombre del Responsable</label>
                    <input type="text" id="responsable" name="responsable" class="form-control"
                        placeholder="Ingresa el nombre de quien brindó la consulta" required>
                </div>


                <!-- Campos ocultos para enviar IMC y Diagnóstico -->
                <input type="hidden" name="imc" id="imc_hidden">
                <input type="hidden" name="diagnostico" id="diagnostico_hidden">

                <button type="submit" class="btn btn-primary">Guardar Diagnóstico</button>
        @endif
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
                            data: [{
                                x: 10,
                                y: 20
                            }, {
                                x: 15,
                                y: 21
                            }, {
                                x: 20,
                                y: 22
                            }, {
                                x: 25,
                                y: 23
                            }, {
                                x: 30,
                                y: 23.5
                            }, {
                                x: 35,
                                y: 24.5
                            }, {
                                x: 40,
                                y: 25
                            }],
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Normopeso (N)',
                            data: [{
                                x: 10,
                                y: 25.5
                            }, {
                                x: 15,
                                y: 26
                            }, {
                                x: 20,
                                y: 26.1
                            }, {
                                x: 25,
                                y: 26.5
                            }, {
                                x: 30,
                                y: 27
                            }, {
                                x: 35,
                                y: 28
                            }, {
                                x: 40,
                                y: 29
                            }],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Sobrepeso (S)',
                            data: [{
                                x: 10,
                                y: 30
                            }, {
                                x: 15,
                                y: 31
                            }, {
                                x: 20,
                                y: 31.5
                            }, {
                                x: 25,
                                y: 32
                            }, {
                                x: 30,
                                y: 32.5
                            }, {
                                x: 35,
                                y: 33
                            }, {
                                x: 40,
                                y: 33
                            }],
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Obesidad (O)',
                            data: [{
                                x: 10,
                                y: 39.9
                            }, {
                                x: 15,
                                y: 39.9
                            }, {
                                x: 20,
                                y: 39.9
                            }, {
                                x: 25,
                                y: 39.9
                            }, {
                                x: 30,
                                y: 39.9
                            }, {
                                x: 35,
                                y: 39.9
                            }, {
                                x: 40,
                                y: 39.9
                            }],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }
                    ]
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
                const pesoKg = parseFloat(document.getElementById('peso_kg').value);
                const talla = parseFloat(document.getElementById('talla').value) / 100; // Convertir a metros
                const semanas = parseInt(document.getElementById('semanas_gestacion').value);

                if (!isNaN(pesoKg) && pesoKg > 0 && !isNaN(talla) && talla > 0 && !isNaN(semanas) && semanas > 0 && semanas <=
                    40) {
                    const imc = pesoKg / (talla * talla); // Cálculo del IMC
                    document.getElementById('imc_result').textContent = imc.toFixed(1); // Mostrar el IMC con 1 decimal
                    document.getElementById('imc_hidden').value = imc.toFixed(1);
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
                    document.getElementById('diagnostico_hidden').value = diagnostico;
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
                    data: [{
                        x: semanas,
                        y: imc
                    }], // Utiliza la semana en el eje X y el IMC en el eje Y
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

            // Programar la próxima cita automáticamente
            document.getElementById('fecha_control').addEventListener('change', function() {
                const fechaControl = new Date(this.value);
                if (fechaControl) {
                    const proximaFecha = new Date(fechaControl);
                    proximaFecha.setMonth(proximaFecha.getMonth() + 1); // Sumar 1 mes para la próxima cita
                    alert('La próxima cita está programada para: ' + proximaFecha.toLocaleDateString());
                }
            });

            // Convertir peso en libras a kilogramos automáticamente
            document.getElementById('peso_libras').addEventListener('input', function() {
                const pesoLb = parseFloat(this.value);
                if (!isNaN(pesoLb)) {
                    const pesoKg = pesoLb * 0.453592;
                    document.getElementById('peso_kg').value = pesoKg.toFixed(
                        2); // Mostrar el peso en kg con 2 decimales
                    calcularIMC(); // Actualizar el IMC cada vez que cambie el peso
                } else {
                    document.getElementById('peso_kg').value = '';
                    document.getElementById('imc_result').textContent = '--';
                }
            });

            // Event listeners para recalcular el IMC y actualizar la gráfica en tiempo real
            document.getElementById('talla').addEventListener('input', calcularIMC);
            document.getElementById('semanas_gestacion').addEventListener('input', calcularIMC);
        </script>
    </div>
@endsection
