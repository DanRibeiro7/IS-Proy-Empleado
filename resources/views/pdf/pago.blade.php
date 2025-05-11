<!-- resources/views/pdf/pago.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            margin-top: 20px;
        }
        .content p {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="header">Comprobante de Pago</div>
    <div class="content">
        <p><strong>Empleado:</strong> {{ $empleado->nombre }} (DNI: {{ $empleado->dni }})</p>
        <p><strong>Contrato:</strong> {{ $contrato->modalidad->nombre }} - {{ $contrato->jornada->nombre }}</p>
        <p><strong>Fecha de Pago:</strong> {{ $pago->fechaPago }}</p>
        <p><strong>Monto de Pago:</strong> ${{ number_format($pago->monto, 2) }}</p>
    </div>
</body>
</html>