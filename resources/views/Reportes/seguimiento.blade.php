<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Seguimiento Prenatal</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1, h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
    </style>
</head>
<body>

    <h1>Reporte de Seguimiento Prenatal</h1>

    <!-- Datos de la Paciente -->
    <h2>Datos de la Paciente</h2>
    <table>
        <tr><th>Nombre</th><td>{{ $paciente->name }}</td></tr>
        <tr><th>CUI</th><td>{{ $paciente->cui }}</td></tr>
        <tr><th>Fecha de Nacimiento</th><td>{{ $paciente->fecha_nacimiento }}</td></tr>
        <tr><th>Edad</th><td>{{ $paciente->edad }}</td></tr>
    </table>

    <!-- Datos de Seguimiento -->
    <h2>Controles Prenatales</h2>
    <table>
        <thead>
            <tr>
                <th>Número de Control</th>
                <th>Fecha del Control</th>
                <th>Peso (libras)</th>
                <th>Peso (kg)</th>
                <th>IMC</th>
                <th>Talla (cm)</th>
                <th>Semanas de Gestación</th>
                <th>Ganancia de Peso (kg)</th>
                <th>Diagnóstico</th>
                <th>Responsable</th>
            </tr>
        </thead>
        <tbody>
            @foreach($controles as $control)
            <tr>
                <td>{{ $control->numero_control }}</td>
                <td>{{ $control->fecha_control }}</td>
                <td>{{ $control->peso_libras }}</td>
                <td>{{ $control->peso_kg }}</td>
                <td>{{ $control->imc }}</td>
                <td>{{ $control->talla }}</td>
                <td>{{ $control->semanas_gestacion }}</td>
                <td>{{ $control->ganancia_peso }}</td>
                <td>{{ $control->diagnostico }}</td>
                <td>{{ $control->responsable }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
