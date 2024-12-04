<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 20px;
            margin: 0;
        }

        .header p {
            margin: 5px 0;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .totals {
            margin-top: 20px;
        }

        .totals .total-row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }

        .totals .total-row strong {
            font-size: 14px;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Factura</h1>
            <p>Razón Social: CINCO ESTRELLAS S.R.L.</p>
            <p>CUIT: 30-70932639-9</p>
            <p>IVA: Responsable Inscripto</p>
            <p>Dirección: 9 de Julio 128, Ushuaia, Tierra del Fuego</p>
            <p>Fecha: {{ $fecha }}</p>
        </div>

        <h3>Cliente</h3>
        <p>Nombre: {{ $nombre }}</p>
        <p>Número de Reserva: {{ $id }}</p>

        <h3>Detalle</h3>
        <table>
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice_lines as $line)
                    <tr>
                        <td>{{ $line['descripcion'] }}</td>
                        <td>${{ number_format($line['precio'], 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <div class="total-row">
                <span>Subtotal:</span>
                <strong>${{ number_format($total_price, 2, ',', '.') }}</strong>
            </div>
            <div class="total-row">
                <span>Total (después de descuentos):</span>
                <strong>${{ number_format($price_after_discounts, 2, ',', '.') }}</strong>
            </div>
        </div>

        <div class="footer">
            <p>Gracias por su compra</p>
            <p>Emitido el {{ $fecha }}</p>
        </div>

        <p style="font-size: 10px;"><strong>Este documento no es un comprobante fiscal válido. Es solo una referencia para el cliente.</strong> </p>
    </div>
</body>
</html>
