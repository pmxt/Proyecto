<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Clínica Prenatal y/o Posparto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #ffffff;
        }

        .container {
            width: 100%;
            margin-block-end: 10px;
            background-color: rgb(255, 255, 255);
            padding: 10px;
            border: 1px solid #242424;
        }

        h2 {
            text-align: center;
        }

        .form-section {
            border-bottom: 1px solid #000000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .section-title {
            font-weight: bold;
            background-color: #000000;
            padding: 3px;
            border-bottom: 0px solid #ffffff;
            color: #f4f4f4;
            margin-bottom: 0px;
            font-size: 12px;
            width: 80%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
            font-size: 12px;
        }

        .checkbox-group input {
            margin-right: 5px;
        }

        /* Estilo para borrar bordes de las tablas específicas */
        .no-borders th,
        .no-borders td {
            border: none;
        }

        /* Estilo para las tablas de signos y síntomas, colocadas una al lado de otra */
        .tabla-doble {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .tabla-doble table {
            width: 48%;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Ficha Clínica Prenatal y/o Posparto</h2>
        <table>
            <tr>
                <th>No. expediente</th>
                <td>{{ $paciente->cui ?? 'N/A' }}</td> <!-- Usando el CUI como número de expediente -->
                <th>Fecha</th>
                <td>{{ $consulta->fecha_consulta ?? 'N/A' }}</td> <!-- Fecha de la consulta -->
            </tr>
        </table>
    </div>

    <div class="section-title">I. IDENTIFICACIÓN DEL ESTABLECIMIENTO DE SALUD</div>
    <div class="container">
        <table class="tabla-datos-generales">
            <tr>
                <th>PS</th>
                <td>{{ $consulta->tipo_servicio == 'PS' ? 'X' : '' }}</td>
                <th>PSF</th>
                <td>{{ $consulta->tipo_servicio == 'PSF' ? 'X' : '' }}</td>
                <th>C/S "B"</th>
                <td>{{ $consulta->tipo_servicio == "C/S 'B'" ? 'X' : '' }}</td>
                <th>CENAP</th>
                <td>{{ $consulta->tipo_servicio == 'CENAPA' ? 'X' : '' }}</td>
                <th>C/S "A"</th>
                <td>{{ $consulta->tipo_servicio == 'C/S A' ? 'X' : '' }}</td>
                <th>CAP</th>
                <td>{{ $consulta->tipo_servicio == 'CAP' ? 'X' : '' }}</td>
                <th>CAIMI</th>
                <td>{{ $consulta->tipo_servicio == 'CAIMI' ? 'X' : '' }}</td>
                <th>CUM</th>
                <td>{{ $consulta->tipo_servicio == 'CUM' ? 'X' : '' }}</td>
                <th>HOSPITAL</th>
                <td>{{ $consulta->tipo_servicio == 'HOSPITAL' ? 'X' : '' }}</td>
            </tr>
        </table>
        <div class="field-group">
            <label>Distrito: {{ $consulta->area_salud }}</label>
        </div>
    </div>

    <div class="section-title">II. DATOS GENERALES DEL PACIENTE</div>
    <div class="container">
        <table class="tabla-datos-generales2 no-borders"> <!-- Clase no-borders para quitar líneas -->
            <tr>
                <th>Nombre</th>
                <td>{{ $paciente->name ?? 'N/A' }}</td>
                <th>Edad</th>
                <td>{{ $paciente->edad ?? 'N/A' }}</td>
                <th>Fecha Nacimiento</th>
                <td>{{ $paciente->fecha_nacimiento ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Nombre responsable</th>
                <td colspan="3">{{ $paciente->encargados->nombreEsposo?? 'N/A' }}</td>
                <th>Teléfono</th>
                <td>{{ $paciente->telefono ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Dirección</th>
                <td colspan="4">{{ $paciente->comunidad ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Migrante</th>
                <td>SI <input type="checkbox" {{ $paciente->migrante == 'Sí' ? 'checked' : '' }}> </td>
                <td>NO <input type="checkbox" {{ $paciente->migrante == 'no' ? 'checked' : '' }}></td>
                <th>Ocupación</th>
                <td>{{ $paciente->Ocupacion ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <div class="section-title">III. IDENTIFIQUE Y EVALÚE SIGNOS Y SÍNTOMAS DE PELIGRO</div>
    <div class="container">
        <p>Marque en los cuadros correspondientes de SI o NO lo encontrado en la evaluación:</p>
        <div class="tabla-doble no-borders"> <!-- Clase no-borders aplicada para quitar las líneas -->
            <!-- Primera tabla -->
            <table>
                <tr>
                    <th></th>
                    <th>SI</th>
                    <th>NO</th>
                </tr>
                <tr>
                    <th>Hemorragia vaginal</th>
                    <td><input type="checkbox" {{ $signos->hemorragia_vaginal == 'SI' ? 'checked' : '' }}></td>
                    <td><input type="checkbox" {{ $signos->hemorragia_vaginal == 'NO' ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <th>Dolor de cabeza severo</th>
                    <td><input type="checkbox" {{ $signos->dolor_cabeza_severo == 'SI' ? 'checked' : '' }}></td>
                    <td><input type="checkbox" {{ $signos->dolor_cabeza_severo == 'NO' ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <th>Visión borrosa</th>
                    <td><input type="checkbox" {{ $signos->vision_borrosa == 'SI' ? 'checked' : '' }}></td>
                    <td><input type="checkbox" {{ $signos->vision_borrosa == 'NO' ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <th>Convulsión</th>
                    <td><input type="checkbox" {{ $signos->convulsion == 'SI' ? 'checked' : '' }}></td>
                    <td><input type="checkbox" {{ $signos->convulsion == 'NO' ? 'checked' : '' }}></td>
                </tr>
            </table>

            <!-- Segunda tabla -->
            <table>
                <tr>
                    <th></th>
                    <th>SI</th>
                    <th>NO</th>
                </tr>
                <tr>
                    <th>Dolor abdominal severo</th>
                    <td><input type="checkbox" {{ $signos->dolor_abdominal_severo == 'SI' ? 'checked' : '' }}></td>
                    <td><input type="checkbox" {{ $signos->dolor_abdominal_severo == 'NO' ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <th>Presión arterial alta</th>
                    <td><input type="checkbox" {{ $signos->presion_arterial_alta == 'SI' ? 'checked' : '' }}></td>
                    <td><input type="checkbox" {{ $signos->presion_arterial_alta == 'NO' ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <th>Fiebre</th>
                    <td><input type="checkbox" {{ $signos->fiebre == 'SI' ? 'checked' : '' }}></td>
                    <td><input type="checkbox" {{ $signos->fiebre == 'NO' ? 'checked' : '' }}></td>
                </tr>
                <tr>
                    <th>Presentación fetal anormal</th>
                    <td><input type="checkbox" {{ $signos->presentacion_fetal_anormal == 'SI' ? 'checked' : '' }}></td>
                    <td><input type="checkbox" {{ $signos->presentacion_fetal_anormal == 'NO' ? 'checked' : '' }}></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section-title">IV. SE REFIRIÓ LA PACIENTE, REGISTRE MANEJO Y ESTABILIZACIÓN</div>
    <div class="container">
        <label>_______________________________________________________________</label>
    </div>

    <div class="section-title">V. MOTIVO DE LA CONSULTA</div>
    <div class="container">
        <div class="form-group">
            <label for="motivo">Embarazo</label>
            <input type="checkbox" id="embarazo" {{ $consulta->motivo_consulta == 'Embarazo' ? 'checked' : '' }}>
            <label for="parto">Parto</label>
            <input type="checkbox" id="parto" {{ $consulta->motivo_consulta == 'Parto' ? 'checked' : '' }}>
            <label for="posparto">Posparto</label>
            <input type="checkbox" id="posparto" {{ $consulta->motivo_consulta == 'Posparto' ? 'checked' : '' }}>
            <label for="otro">Otro</label>
            <input type="checkbox" id="otro" {{ $consulta->motivo_consulta == 'Otro' ? 'checked' : '' }}>
        </div>
    </div>

    <div class="section-title">VI. HISTORIA DE LA ENFERMEDAD ACTUAL</div>
    <div class="container">
        <label>_______________________________________________________________</label>
    </div>

</body>

</html>
