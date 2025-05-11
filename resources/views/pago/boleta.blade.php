<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Boleta de Pago -  PINKI</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 30px;
        }
        .titulo {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .info, .detalle {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info td {
            padding: 5px;
        }
        .detalle th, .detalle td {
            border: 1px solid #000;
            padding: 8px;
        }
        .firmas {
            margin-top: 60px;
            width: 100%;
            text-align: center;
        }
        .firma {
            width: 45%;
            display: inline-block;
        }
        .linea {
            border-top: 1px solid #000;
            margin-top: 50px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>

    <div class="titulo">BOLETA DE PAGO - Banco PINKI</div>

    <table class="info">
        <tr>
            <td><strong>Empleado:</strong></td>
            <td>{{ $pago->contrato->empleado->nombres }} {{ $pago->contrato->empleado->apePaterno }} {{ $pago->contrato->empleado->apeMaterno }}</td>
        </tr>
        <tr>
            <td><strong>DNI:</strong></td>
            <td>{{ $pago->contrato->empleado->dni }}</td>
        </tr>
        <tr>
            <td><strong>Dirección:</strong></td>
            <td>{{ $pago->contrato->empleado->direccion }}</td>
        </tr>
        <tr>
            <td><strong>Celular:</strong></td>
            <td>{{ $pago->contrato->empleado->numCelular }}</td>
        </tr>
        <tr>
            <td><strong>Correo:</strong></td>
            <td>{{ $pago->contrato->empleado->correo }}</td>
        </tr>
        <tr>
            <td><strong>Area:</strong></td>
            <td>{{ $pago->contrato->area->nomArea }}</td>
        </tr>
        <tr>
            <td><strong>Salario:</strong></td>
            <td>{{ $pago->contrato->area->salario }}</td>
        </tr>
    </table>

    <table class="detalle">
        <thead>
            <tr>
                <th>Fecha de Pago</th>
                <th>Monto</th>
                <th>Gratificación</th>
                <th>Banco</th>
                <th>N° Cuenta</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ \Carbon\Carbon::parse($pago->fechaPago)->format('d/m/Y') }}</td>
                <td>S/. {{ number_format($pago->monto, 2) }}</td>
                <td>S/. {{ number_format($pago->gratificacion ?? 0, 2) }}</td>
                <td>{{ $pago->banco->nomBanco ?? 'N/A' }}</td>
                <td>{{ $pago->numCuenta }}</td>
                <td>{{ $pago->estado }}</td>
            </tr>
        </tbody>
    </table>

    <div class="firmas">
        <div class="firma">
            <div class="linea"></div>
            <p>Firma del Empleador</p>
        </div>
        <div class="firma" style="float: right;">
            <div class="linea"></div>
            <p>Firma del Empleado</p>
        </div>
    </div>

</body>
</html>


