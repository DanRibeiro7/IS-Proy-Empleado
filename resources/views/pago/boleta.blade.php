<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta de Pago</title>
</head>
<body>
    <h1>Boleta de Pago</h1>
    <p><strong>Código de Pago:</strong> {{ $pago->idPago }}</p>
    <p><strong>Código de Contrato:</strong> {{ $pago->idContrato }}</p>
    <p><strong>Monto:</strong> {{ $pago->monto }}</p>
    <p><strong>Fecha de Pago:</strong> {{ $pago->fechaPago }}</p>
    <!-- Aquí puedes agregar más detalles que desees incluir en la boleta -->
</body>
</html>
