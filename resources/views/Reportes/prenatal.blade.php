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
        @if($embarazo)
        <tr><th>Fecha de Última Regla</th><td>{{ $embarazo->fecha_ultima_regla }}</td></tr>
        <tr><th>Fecha Probable de Parto</th><td>{{ $embarazo->fecha_probable_parto }}</td></tr>
    @endif
    </table>

    <!-- Datos de la Consulta Prenatal -->
    @if($consulta)
    <h2>Primera Consulta Prenatal</h2>
    <table>
        <tr><th>Fecha de Consulta</th><td>{{ $consulta->fecha_consulta }}</td></tr>
        <tr><th>Tipo de Servicio</th><td>{{ $consulta->tipo_servicio }}</td></tr>
        <tr><th>Área de Salud</th><td>{{ $consulta->area_salud }}</td></tr>
        <tr><th>Nombre del Servicio</th><td>{{ $consulta->nombre_servicio }}</td></tr>
        <tr><th>Motivo de la Consulta</th><td>{{ $consulta->motivo_consulta }}</td></tr>
        <tr><th>Tipo de Consulta</th><td>{{ $consulta->tipo_consulta }}</td></tr>
    </table>
    @endif
    

</body>
</html>
