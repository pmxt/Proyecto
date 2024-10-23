<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Atención a la Embarazada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }


        .header {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .logo {
            width: 100px;
            height: 100px;
            position: absolute;
        }

        .logo-left {
            top: -4%;
            left: -4%;
        }

        .logo-right {
            top: -4%;
            right: -4%;
        }

        .title-section {
            display: inline-block;
            text-align: center;
            width: calc(100% - 200px);
            vertical-align: top;
        }

        .section-title {
            font-weight: bold;
            font-size: 12px;
            margin: 0;
        }

        .table-container {
            margin-top: 20px;
            font-size: 12px;
        }

        .tabla-datos-generales {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla-datos-generales th,
        .tabla-datos-generales td {
            padding: 5px;
            text-align: left;
            font-size: 12px;
        }

        .valoracion-nutricional-container {
            display: flex;
            justify-content: space-between;


            align-items: flex-start;

            font-size: 12px;
        }

        .Peso-esperado-container {
            display: flex;
            justify-content: space-between;


            align-items: flex-start;

            font-size: 12px;
        }


        .tabla-valoracion-nutricional {
            width: 78%;
            border-collapse: collapse;
        }

        .tabla-valoracion-nutricional th,
        .tabla-valoracion-nutricional td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
            float: left;
            font-size: 12px;
        }

        .tabla-peso {
            width: 49%;
            border-collapse: collapse;

        }

        .tabla-peso th,
        .tabla-peso td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
            float: left;
            font-size: 12px;

        }


        .highlight {
            background-color: rgb(243, 243, 243);
        }

        .small-cell {
            width: 79%;
        }

        .medium-cell {
            width: 79px;
        }

        .large-cell {
            width: 79px;
        }

        .cuadro-texto {
            width: 20%;
            border: 1px solid black;
            padding: 5px;
            font-size: 12px;
            text-align: center;
            float: right;
            margin-left: 10px;
            margin-top: -220px;

        }

        .img-grafico {
            width: 50%;
            margin-left: 10px;
            text-align: center;
            float: right;
        }

        .img-grafico img {
            width: 100%;
            margin-top: -300px;
          
            height: auto;
            
        }
    </style>

</head>

<body>
    <div class="header">
        <div><img src="imagenes/MPS.jpg" alt="logo1" class="logo logo-left">
            <img src="imagenes/muni.png" alt="logo2" class="logo logo-right">
        </div>

        <div class="title-section">
            <h1 class="section-title">DIRECCIÓN DE ÁREA DE SALUD DE TOTONICAPÁN</h1>
            <h1 class="section-title">UNIDAD DE NUTRICIÓN</h1>
            <h1 class="section-title">ANEXO DE FICHA DE ATENCIÓN A LA EMBARAZADA</h1>
        </div>

    </div>

    <div class="table-container">
        <h2>1. Datos Generales</h2>
        <table class="tabla-datos-generales">
            <tr>
                <th>Nombre:</th>
                <td colspan="5"> {{ $paciente->name }} </td>
                <th>Registro</th>
                <td colspan="2">{{ $paciente->cui }}</td>
                <th>Edad en años</th>
                <td>{{ $paciente->edad }}</td>
            </tr>
            @foreach ($controles as $control)
            <tr>
                <th>Peso lb.</th>
                <td>{{ $control->peso_libras }}</td>
                <th>Peso kg.</th>
                <td> {{ $control->peso_kg }} </td>
                <th>Talla cm</th>
                <td>{{ $control->talla }}</td>
                <th>IMC</th>
                <td>{{ $control->imc }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="valoracion-nutricional-container">
        <div>
            <h2>2. Valoración Nutricional</h2>
            <table class="tabla-valoracion-nutricional">
                <tr class="highlight">
                    <th class="small-cell">No. de control</th>
                    <th class="small-cell">Fecha</th>
                    <th class="small-cell">Peso kg</th>
                    <th class="small-cell">Semanas de gestación</th>
                    <th class="medium-cell">Diagnóstico Nutricional</th>
                    <th class="small-cell">Ganancia de peso</th>
                    <th class="large-cell">Nombre de quien brindó la consulta</th>
                </tr>
                @php
                $totalControles = 9; 
                $controlesMostrados = 0;
            @endphp
            
         
            @foreach ($controles as $control)
                <tr>
                    <td>{{ $control->numero_control }}</td>
                    <td>{{ $control->fecha_control }}</td>
                    <td>{{ $control->peso_kg }}</td>
                    <td>{{ $control->semanas_gestacion }}</td>
                    <td>{{ $control->diagnostico }}</td>
                    <td>{{ $control->ganancia_peso }}</td>
                    <td>{{ $control->responsable }}</td>
                </tr>
                @php
                    $controlesMostrados++;
                @endphp
            @endforeach
            
     
            @for ($i = $controlesMostrados + 1; $i <= $totalControles; $i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endfor

            </table>
            <div class="cuadro-texto">
                <p>Recuerde: la ganancia de peso se realiza con base en el primer control si fue CMB o IMC</p>
            </div>

        </div>

    </div>
    <div class="Peso-esperado-container">
        <div>
            <p style="text-align: center;">tabla de ganancia de peso minimo esperado en
                embarazadas utilizando circunferencia de brazo
                media en el primer trimestre
            </p>


            <table class="tabla-peso">
                <tr class="highlight">
                    <th class="small-cell">Mes de embarazo</th>
                    <th class="small-cell">Libras que debe aumentar las mujeres con circunferencia de brtazo igual o
                        mayor de 23 cm</th>
                    <th class="small-cell">libras que debe aumentar las mujeres con circunferencia de brrazo menor de 25
                        cm</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2.0 kg</td>
                    <td>2.5 kg</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>3.0 kg</td>
                    <td>4.0 kg</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>3.0 kg</td>
                    <td>4.0 kg</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>3.0 kg</td>
                    <td>4.0 kg</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>3.0 kg</td>
                    <td>4.0 kg</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>3.0 kg</td>
                    <td>4.0 kg</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>3.0 kg</td>
                    <td>4.0 kg</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>3.0 kg</td>
                    <td>4.0 kg</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>3.0 kg</td>
                    <td>4.0 kg</td>
                </tr>

            </table>
        </div>
        <div class="img-grafico">
            <img src="imagenes/indice.jpg" alt="img3">
        </div>
</body>
</html>
