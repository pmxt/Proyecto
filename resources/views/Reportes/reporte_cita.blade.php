<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Cita Prenatal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .header {
            width: 100%;
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .logo {
            width: 100px;
            height: 100px;
            position: absolute;
        }

        .logo-left {
            top: 0;
            left: 0;
        }

        .logo-right {
            top: 0;
            right: 0;
        }

        .title-section {
            display: inline-block;
            text-align: center;
            width: calc(100% - 200px);
            vertical-align: top;
        }

        .section-title {
            font-weight: bold;
            font-size: 18px;
        }

        .table-container {
            margin-top: 20px;
        }

        .section-content {
            margin-bottom: 20px;
        }

        .highlight {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: gray;
        }
        .td{

        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="imagenes/MPS.jpg" alt="logo1" class="logo logo-left">
            <div class="title-section">
                <h1 class="section-title">DIRECCIÓN DE ÁREA DE SALUD DE TOTONICAPÁN</h1>
                <h2 class="section-title">UNIDAD DE SALUD PRENATAL</h2>
                <h3 class="section-title">REPORTE DE CITA PRENATAL</h3>
            </div>
        </div>

        <div class="section-content">
            <h2>Detalles de la Próxima Cita</h2>
            <div class="highlight">
                <p><strong>Paciente:</strong> {{ $paciente->name }}</p>
                <p><strong>Fecha de la Próxima Cita:</strong> {{ $proximaFechaCita }}</p>
                <p><strong>Motivo de Consulta:</strong> {{ $motivo_consulta }}</p>
                <p><strong>Área de Salud:</strong> {{ $area_salud }}</p>
                <p><strong>Servicio:</strong> {{ $nombre_servicio }}</p>
            </div>
        </div>

        <div class="table-container">
            <h2>Resumen General</h2>
            <table class="table table-striped">
                
                <tbody>
                    <p><strong>Paciente:</strong> {{ $paciente->name }}</p>
                    <p><strong>Edad en Años:</strong> {{ $paciente->edad }}</p>
                    <p><strong>Fecha de la Última Regla:</strong> {{ $fecha_ultima_regla }}</p>
                    <p><strong>Fecha Probable de Parto:</strong> {{ $fecha_probable_parto }}</p>

                </tbody>
            </table>
        </div>

        <div class="footer">
            <p>Reporte generado automáticamente por el sistema de control prenatal. Cantón chotacaj Totonicapán</p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
