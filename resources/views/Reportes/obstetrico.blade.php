<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Ficha Obstétrica</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1, h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
    </style>
</head>
<body>

    <h1>Ficha Obstétrica</h1>

    <!-- Datos de la Paciente -->
    <h2>Datos de la Paciente</h2>
    <table>
        <tr><th>Nombre</th><td>{{ $paciente->name }}</td></tr>
        <tr><th>CUI</th><td>{{ $paciente->cui }}</td></tr>
        <tr><th>Fecha de Nacimiento</th><td>{{ $paciente->fecha_nacimiento }}</td></tr>
        <tr><th>Edad</th><td>{{ $paciente->edad }}</td></tr>
        <tr><th>Migrante</th><td>{{ $paciente->migrante }}</td></tr>
        <tr><th>Pueblo</th><td>{{ $paciente->pueblos }}</td></tr>
        <tr><th>Escolaridad</th><td>{{ $paciente->Escolaridad }}</td></tr>
        <tr><th>Ocupación</th><td>{{ $paciente->Ocupacion }}</td></tr>
        <tr><th>Comunidad</th><td>{{ $paciente->comunidad }}</td></tr>
        <tr><th>Teléfono</th><td>{{ $paciente->telefono }}</td></tr>

        @if($embarazo)
            <tr><th>Fecha de Última Regla</th><td>{{ $embarazo->fecha_ultima_regla }}</td></tr>
            <tr><th>Fecha Probable de Parto</th><td>{{ $embarazo->fecha_probable_parto }}</td></tr>
        @endif
    </table>

    <!-- Datos del Encargado -->
    @if($encargado)
    <h2>Datos del Encargado</h2>
    <table>
        <tr><th>Nombre del Encargado</th><td>{{ $encargado->nombreEsposo }}</td></tr>
        <tr><th>CUI</th><td>{{ $encargado->cui }}</td></tr>
        <tr><th>Fecha de Nacimiento</th><td>{{ $encargado->fecha_nacimiento }}</td></tr>
        <tr><th>Edad</th><td>{{ $encargado->edad }}</td></tr>
        <tr><th>Pueblo</th><td>{{ $encargado->pueblos }}</td></tr>
        <tr><th>Escolaridad</th><td>{{ $encargado->Escolaridad }}</td></tr>
        <tr><th>Ocupación</th><td>{{ $encargado->Ocupacion }}</td></tr>
        <tr><th>Estado Civil</th><td>{{ $encargado->estado_civil }}</td></tr>
    </table>
    @endif

    <!-- Antecedentes Obstétricos -->
    @if($antecedentesObstetricos)
    <h2>Antecedentes Obstétricos</h2>
    <table>
        <tr><th>Número de Embarazos</th><td>{{ $antecedentesObstetricos->num_embarazos }}</td></tr>
        <tr><th>Número de Partos</th><td>{{ $antecedentesObstetricos->num_partos }}</td></tr>
        <tr><th>Número de Cesáreas</th><td>{{ $antecedentesObstetricos->num_cesarias }}</td></tr>
        <tr><th>Número de Abortos</th><td>{{ $antecedentesObstetricos->num_abortos }}</td></tr>
        <tr><th>Hijos Nacidos Vivos</th><td>{{ $antecedentesObstetricos->num_hijos_nacidos_vivos }}</td></tr>
        <tr><th>Hijos Nacidos Muertos</th><td>{{ $antecedentesObstetricos->num_hijos_nacidos_muertos }}</td></tr>
        <tr><th>Hijos Vivos</th><td>{{ $antecedentesObstetricos->num_hijos_vivos }}</td></tr>
        <tr><th>Hijos Fallecidos</th><td>{{ $antecedentesObstetricos->num_hijos_fallecidos }}</td></tr>
        <tr><th>Muerte Fetal</th><td>{{ $antecedentesObstetricos->muerte_fetal }}</td></tr>
        <tr><th>Abortos Consecutivos</th><td>{{ $antecedentesObstetricos->abortos_consecutivos }}</td></tr>
        <tr><th>Peso del Bebé Menor a 2500g</th><td>{{ $antecedentesObstetricos->peso_bebe_2500g }}</td></tr>
        <tr><th>Peso del Bebé Mayor a 4500g</th><td>{{ $antecedentesObstetricos->peso_bebe_4500g }}</td></tr>
        <tr><th>Hipertensión</th><td>{{ $antecedentesObstetricos->hipertension }}</td></tr>
        <tr><th>Cirugías Reproductoras</th><td>{{ $antecedentesObstetricos->cirugias_reproductor }}</td></tr>
    </table>
    @endif

    <!-- Otros Datos del Embarazo -->
    @if($embarazo)
    <h2>Datos del Embarazo</h2>
    <table>
        <tr><th>Embarazo Múltiple</th><td>{{ $embarazo->embarazo_multiple }}</td></tr>
        <tr><th>Menos de 20 Años</th><td>{{ $embarazo->menos_20 }}</td></tr>
        <tr><th>RH Negativo</th><td>{{ $embarazo->rh_negativo }}</td></tr>
        <tr><th>Más de 35 Años</th><td>{{ $embarazo->mas_35 }}</td></tr>
        <tr><th>Hemorragia</th><td>{{ $embarazo->hemorragia }}</td></tr>
        <tr><th>VIH o Sífilis</th><td>{{ $embarazo->vih_sifilis }}</td></tr>
        <tr><th>Presión Arterial</th><td>{{ $embarazo->presion_arterial }}</td></tr>
        <tr><th>Anemia</th><td>{{ $embarazo->anemia }}</td></tr>
        <tr><th>Desnutrición</th><td>{{ $embarazo->desnutricion }}</td></tr>
        <tr><th>Dolor Abdominal</th><td>{{ $embarazo->dolor_abdominal }}</td></tr>
        <tr><th>Sintomatología Uterina</th><td>{{ $embarazo->sintomatologia_uterina }}</td></tr>
        <tr><th>Ictericia</th><td>{{ $embarazo->ictericia }}</td></tr>
    </table>
    @endif

    <!-- Historial Clínico -->
    @if($historialClinico)
    <h2>Historial Clínico</h2>
    <table>
        <tr><th>Diabetes Tipo A</th><td>{{ $historialClinico->diabetes_a ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Diabetes Tipo B</th><td>{{ $historialClinico->diabetes_b ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Enfermedad Renal Tipo A</th><td>{{ $historialClinico->renal_a ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Enfermedad Renal Tipo B</th><td>{{ $historialClinico->renal_b ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Problemas del Corazón Tipo A</th><td>{{ $historialClinico->corazon_a ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Problemas del Corazón Tipo B</th><td>{{ $historialClinico->corazon_b ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Hipertensión Tipo A</th><td>{{ $historialClinico->hipertension_a ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Hipertensión Tipo B</th><td>{{ $historialClinico->hipertension_b ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Consumo de Drogas Tipo A</th><td>{{ $historialClinico->drogas_a ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Consumo de Drogas Tipo B</th><td>{{ $historialClinico->drogas_b ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Otras Enfermedades Tipo A</th><td>{{ $historialClinico->otra_a ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Otras Enfermedades Tipo B</th><td>{{ $historialClinico->otra_b ? 'Sí' : 'No' }}</td></tr>
        <tr><th>Especificación</th><td>{{ $historialClinico->especificacion }}</td></tr>
        <tr><th>Referido a</th><td>{{ $historialClinico->referido_a }}</td></tr>
        <tr><th>Fecha</th><td>{{ $historialClinico->fecha }}</td></tr>
        <tr><th>Responsable</th><td>{{ $historialClinico->responsable }}</td></tr>
    </table>
    @endif

</body>
</html>
