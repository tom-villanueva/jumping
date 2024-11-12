<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmación de reserva - Jumping Ski Rental</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      color: #333;
      line-height: 1.6;
      margin: 0;
      padding: 20px;
      background-color: #f4f4f4;
    }

    .container {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 800px;
      margin: 0 auto;
    }

    .header {
      text-align: center;
      margin-bottom: 40px;
    }

    .header img {
      max-width: 200px;
    }

    h1 {
      color: #4684d8;
    }

    .contract {
      font-size: 14px;
    }

    .section-title {
      font-size: 16px;
      font-weight: bold;
      margin-top: 20px;
      color: #4684d8;
    }

    .footer {
      text-align: center;
      margin-top: 40px;
      font-size: 12px;
      color: #888;
    }

    .bold {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <img width="100px" src="{{ $message->embed($pathToImage) }}" alt="Jumping Ski Rental Logo">
      <h1>Confirmación de reserva</h1>
    </div>

    <p>Estimado/a <strong>{{ $nombre }}</strong>,</p>

    <p>Nos complace confirmar su reserva con los siguientes detalles:</p>

    <div class="contract">
        <p class="section-title">Detalles de la Reserva</p>
        <p><span class="bold">Nro de Reserva:</span> {{ $reservaId }}</p>
        <p><span class="bold">Fecha de inicio:</span> {{ $fecha_desde }}</p>
        <p><span class="bold">Fecha de finalización:</span> {{ $fecha_hasta }}</p>

        <!-- Table for Equipos -->
        <p class="section-title">Equipos Reservados</p>
        <table width="100%" cellspacing="0" cellpadding="8" border="1" style="border-collapse: collapse;">
            <thead>
            <tr>
                <th>Equipo</th>
                <th>Precio Diario</th>
                <th>Descuento (%)</th>
                <th>Días</th>
                <th>Precio con Descuento</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($equipos as $reservaEquipo)
            <tr>
                <td>{{ $reservaEquipo['descripcion'] }}</td>
                <td>${{ number_format($reservaEquipo['precio_por_dia'], 2) }}</td>
                <td>{{ $reservaEquipo['descuento'] }}%</td>
                <td>{{ $reservaEquipo['dias'] }}</td>
                <td>${{ number_format($reservaEquipo['precio_con_descuento'], 2) }}</td>
                <td>${{ number_format($reservaEquipo['total'], 2) }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Table for Traslados -->
        <p class="section-title">Traslados</p>
        <table width="100%" cellspacing="0" cellpadding="8" border="1" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Dirección</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Finalización</th>
                    <th>Días</th>
                    <th>Precio Diario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($traslados as $traslado)
                <tr>
                    <td>{{ $traslado['direccion'] }}</td>
                    <td>{{ $traslado['fecha_inicio'] }}</td>
                    <td>{{ $traslado['fecha_fin'] }}</td>
                    <td>{{ $traslado['dias'] }}</td>
                    <td>${{ number_format($traslado['precio_diario'], 2) }}</td>
                    <td>${{ number_format($traslado['total'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

      <p class="section-title">Total de la Reserva</p>
      <p><span class="bold">Total:</span> ${{ number_format($total, 2) }}</p>
    </div>

    <div class="footer">
      <p>Gracias por elegir Jumping Ski Rental. ¡Esperamos que disfrute de su experiencia!</p>
      <p>Si tiene alguna pregunta, no dude en contactarnos.</p>
      <p>Atentamente,<br>El equipo de Jumping Ski Rental</p>
    </div>
  </div>
</body>

</html>