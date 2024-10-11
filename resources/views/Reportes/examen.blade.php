<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Examen Físico</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1, h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
    </style>
</head>
<body>

    <h1>Reporte de Examen Físico</h1>

    <!-- Datos de la Paciente -->
    <h2>Datos de la Paciente</h2>
    <table>
        <tr><th>Nombre</th><td>{{ $paciente->name }}</td></tr>
        <tr><th>CUI</th><td>{{ $paciente->cui }}</td></tr>
        <tr><th>Fecha de Nacimiento</th><td>{{ $paciente->fecha_nacimiento }}</td></tr>
        <tr><th>Edad</th><td>{{ $paciente->edad }}</td></tr>
    </table>

    <!-- Datos de la Consulta Prenatal -->
    <h2>Consulta Prenatal</h2>
    <table>
        <tr><th>Fecha de Consulta</th><td>{{ $consulta->fecha_consulta }}</td></tr>
        <tr><th>Motivo de la Consulta</th><td>{{ $consulta->motivo_consulta }}</td></tr>
    </table>

    <!-- Datos del Examen Físico -->
       <!-- Datos del Examen Físico -->
       <h2>Examen Físico</h2>
       @if($examenFisico)
       <table>
           <tr><th>Presión Arterial</th><td>{{ $examenFisico->presion_arterial }}</td></tr>
           <tr><th>Temperatura Corporal</th><td>{{ $examenFisico->temperatura_corporal }}</td></tr>
           <tr><th>Peso</th><td>{{ $examenFisico->peso }}</td></tr>
           <tr><th>Frecuencia Respiratoria</th><td>{{ $examenFisico->frecuencia_respiratoria }}</td></tr>
           <tr><th>Frecuencia Cardíaca Materna</th><td>{{ $examenFisico->frecuencia_cardiaca_materna }}</td></tr>
           <tr><th>Estado General</th><td>{{ $examenFisico->estado_general }}</td></tr>
           <tr><th>Examen Bucal</th><td>{{ $examenFisico->examen_bucal }}</td></tr>
           <tr><th>Altura Uterina</th><td>{{ $examenFisico->altura_uterina }}</td></tr>
           <tr><th>Movimientos Fetales</th><td>{{ $examenFisico->movimientos_fetales }}</td></tr>
           <tr><th>Frecuencia Cardíaca Fetal</th><td>{{ $examenFisico->frecuencia_cardiaca_fetal }}</td></tr>
           <tr><th>Leopoldo</th><td>{{ $examenFisico->leopoldo }}</td></tr>
           <tr><th>Trazas de Sangre</th><td>{{ $examenFisico->trazas_sangre }}</td></tr>
           <tr><th>Verrugas</th><td>{{ $examenFisico->verrugas }}</td></tr>
           <tr><th>Flujo Vaginal</th><td>{{ $examenFisico->flujo_vaginal }}</td></tr>
           <tr><th>Hemoglobina</th><td>{{ $examenFisico->hemoglobina }}</td></tr>
           <tr><th>Grupo RH</th><td>{{ $examenFisico->grupo_rh }}</td></tr>
           <tr><th>Orina</th><td>{{ $examenFisico->orina }}</td></tr>
           <tr><th>Glicemia</th><td>{{ $examenFisico->glicemia }}</td></tr>
           <tr><th>VDRL</th><td>{{ $examenFisico->vdrl }}</td></tr>
           <tr><th>VIH</th><td>{{ $examenFisico->vih }}</td></tr>
           <tr><th>Papanicolau</th><td>{{ $examenFisico->papanicolau }}</td></tr>
           <tr><th>Infecciones</th><td>{{ $examenFisico->infecciones }}</td></tr>
           <tr><th>Semanas de Embarazo</th><td>{{ $examenFisico->semanas_embarazo }}</td></tr>
           <tr><th>Problemas Detectados</th><td>{{ $examenFisico->problemas_detectados }}</td></tr>
       </table>
       @endif

    <!-- Signos y Síntomas de Peligro -->
   <!-- Signos y Síntomas de Peligro -->
   <h2>Signos y Síntomas de Peligro</h2>
   @if($signosPeligro)
   <table>
       <tr><th>Hemorragia Vaginal</th><td>{{ $signosPeligro->hemorragia_vaginal }}</td></tr>
       <tr><th>Dolor de Cabeza Severo</th><td>{{ $signosPeligro->dolor_cabeza_severo }}</td></tr>
       <tr><th>Visión Borrosa</th><td>{{ $signosPeligro->vision_borrosa }}</td></tr>
       <tr><th>Convulsión</th><td>{{ $signosPeligro->convulsion }}</td></tr>
       <tr><th>Dolor Abdominal Severo</th><td>{{ $signosPeligro->dolor_abdominal_severo }}</td></tr>
       <tr><th>Presión Arterial Alta</th><td>{{ $signosPeligro->presion_arterial_alta }}</td></tr>
       <tr><th>Fiebre</th><td>{{ $signosPeligro->fiebre }}</td></tr>
       <tr><th>Presentación Fetal Anormal</th><td>{{ $signosPeligro->presentacion_fetal_anormal }}</td></tr>
   </table>
   @endif

     <!-- Consejería -->
     <h2>Consejería</h2>
     @if($consejeria)
     <table>
         <tr><th>Alimentación</th><td>{{ $consejeria->alimentacion }}</td></tr>
         <tr><th>Señales de Peligro durante el Embarazo</th><td>{{ $consejeria->senales_peligro_embarazo }}</td></tr>
         <tr><th>Consejería sobre VIH</th><td>{{ $consejeria->consejeria_vih }}</td></tr>
         <tr><th>Plan de Parto</th><td>{{ $consejeria->plan_parto }}</td></tr>
         <tr><th>Plan de Emergencia</th><td>{{ $consejeria->plan_emergencia }}</td></tr>
         <tr><th>Lactancia Materna</th><td>{{ $consejeria->lactancia_materna }}</td></tr>
         <tr><th>Métodos de Planificación</th><td>{{ $consejeria->metodos_planificacion }}</td></tr>
         <tr><th>Control Posparto</th><td>{{ $consejeria->control_posparto }}</td></tr>
         <tr><th>Vacunación</th><td>{{ $consejeria->vacunacion }}</td></tr>
     </table>
     @endif

    <!-- Medicamentos Asignados -->
    <h2>Medicamentos Asignados</h2>
    @if($medicamentosAsignados)
    <table>
        <thead>
            <tr><th>Medicamento</th><th>Cantidad Asignada</th></tr>
        </thead>
        <tbody>
            @foreach($medicamentosAsignados as $medicamento)
                <tr>
                    <td>{{ $medicamento->medicamento->nombre }}</td>
                    <td>{{ $medicamento->cantidad_asignada }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

</body>
</html>