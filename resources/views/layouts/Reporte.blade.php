<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Todos los Pacientes</title>
</head>

<body>
    <h1>Reporte de Todos los Pacientes del puesto de salud canton chotacaj totonicapan</h1>

    @foreach ($pacientes as $paciente)
        <h2>Datos del Paciente</h2>
        <p><strong>CUI:</strong> {{ $paciente->cui }}</p>
        <p><strong>Nombre:</strong> {{ $paciente->name }}</p>
        <p><strong>Edad:</strong> {{ $paciente->edad }}</p>
        <p><strong>Comunidad:</strong> {{ $paciente->comunidad }}</p>
        <p><strong>Escolaridd:</strong> {{ $paciente->Escolaridad }}</p>
        <p><strong>migrante:</strong> {{ $paciente->migrante }}</p>
        <p><strong>Telefono :</strong> {{ $paciente->telefono }}</p>





        @if ($paciente->encargados->isNotEmpty())
            <h3>Encargados</h3>
            @foreach ($paciente->encargados as $encargado)
                <p><strong>Nombre del Encargado (Esposo):</strong> {{ $encargado->nombreEsposo }}</p>
                <p><strong>Edad del Encargado:</strong> {{ $encargado->edad }}</p>
                <p><strong>Ocupación del Encargado:</strong> {{ $encargado->Ocupacion }}</p>
            @endforeach
        @else
            <p>Este paciente no tiene encargados registrados.</p>
        @endif

        <hr> <!-- Línea separadora entre pacientes -->
    @endforeach
    @if ($paciente->historial)
        <h3>Historial Médico</h3>
        <p><strong>Diabetes:</strong> {{ $paciente->historial->diabetes_a ? 'Sí' : 'No' }}</p>
        <p><strong>Hipertensión:</strong> {{ $paciente->historial->hipertension_a ? 'Sí' : 'No' }}</p>
        <p><strong>Enfermedad del Corazón:</strong> {{ $paciente->historial->corazon_a ? 'Sí' : 'No' }}</p>
        <p><strong>Renal:</strong> {{ $paciente->historial->renal_a ? 'Sí' : 'No' }}</p>
        <p><strong>Drogas:</strong> {{ $paciente->historial->drogas_a ? 'Sí' : 'No' }}</p>
        <p><strong>Otra Condición:</strong> {{ $paciente->historial->otra_a ? 'Sí' : 'No' }}</p>
        @if ($paciente->historial->especificacion)
            <p><strong>Especificación de otra condición:</strong> {{ $paciente->historial->especificacion }}</p>
        @endif
        <p><strong>Fecha del Historial:</strong> {{ $paciente->historial->fecha }}</p>
        <p><strong>Responsable:</strong> {{ $paciente->historial->responsable }}</p>
    @else
        <p>No se ha registrado un historial médico para este paciente.</p>
    @endif




</body>

</html>
