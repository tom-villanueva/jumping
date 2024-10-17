<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de Alquiler - Jumping Ski Rental</title>
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
            <h1>Contrato de Alquiler</h1>
        </div>

        <p>Estimado/a <strong>{{ $nombre }}</strong>,</p>
        <p>Adjunto encontrará los términos y condiciones de su contrato de alquiler. Este contrato está vinculado a la reserva <strong>Nro: {{ $reservaId }}</strong>, válida desde el <strong>{{ $fecha_desde }}</strong> hasta el <strong>{{ $fecha_hasta }}</strong>.</p>

        <div class="contract">
            <p>El locatario autoriza a Jumping Ski Rental a descontar de su tarjeta de crédito lo emergente al presente contrato. (Requiere contrato firmado) Este contrato vence indefectiblemente en la fecha <strong>{{ $fecha_hasta }}</strong>. Las condiciones generales que rigen el presente son las siguientes:</p>

            <p class="section-title">1 - Partes contratantes</p>
            <p><span class="bold">1.1</span> - Jumping Rental Ski, con domicilio comercial en 9 de Julio 146, Ushuaia, Tierra del Fuego, Argentina, en adelante denominado "El Locador".</p>
            <p><span class="bold">1.2</span> - Persona física o jurídica firmante y correctamente identificada en este contrato de alquiler de Equipos, en adelante denominado "El Locatario".</p>

            <p class="section-title">2 - Equipo alquilado</p>
            <p><span class="bold">2.1</span> - El equipo alquilado que está siendo entregado en este acto de contratación, está debidamente caracterizado en el presente y se encuentra en perfectas condiciones de uso, conservación y funcionamiento.</p>
            <p><span class="bold">2.2</span> - El Locatario se hace responsable íntegramente de la custodia de los equipos e indumentaria, hasta la efectiva devolución del mismo a la locadora, la que se efectivizará en las mismas condiciones en que fue entregado. En el caso de existir faltantes, El Locatario deberá hacerse cargo del precio que fije El Locador por los mismos.</p>
            <p><span class="bold">2.3</span> - El Locador cede por este intermedio la guarda de los equipos dados en locación, quedando eximido de cualquier tipo de responsabilidad emergente del uso de los equipos durante la vigencia del presente.</p>

            <p class="section-title">3 - Otras condiciones de alquiler</p>
            <p><span class="bold">3.1</span> - Este contrato es personal e intransferible.</p>

            <p class="section-title">4 - Devolución de los equipos</p>
            <p><span class="bold">4.1</span> - El equipo locado deberá ser reintegrado al locador en la fecha registrada. Cualquier prórroga deberá ser solicitada por escrito.</p>

            <p class="section-title">5 - Gastos de alquiler y formas de cobranza</p>
            <p><span class="bold">5.1</span> - En el momento de la devolución del equipo, se calcularán los gastos del periodo locativo.</p>
            <p><span class="bold">5.2</span> - El Locatario será siempre responsable directo por los resarcimientos debidos a la locadora.</p>

            <p class="section-title">6 - Rescisión contractual anticipada</p>
            <p><span class="bold">6.1</span> - El contrato podrá ser rescindido con notificación previa de 24 horas.</p>

            <p class="section-title">7 - Disposiciones finales</p>
            <p><span class="bold">7.1</span> - La tarifa vigente forma parte integrante de este contrato.</p>
            <p><span class="bold">7.2</span> - El Locador estará autorizado a obtener información personal del Locatario.</p>

            <p class="section-title">8 - Jurisdicción</p>
            <p><span class="bold">8.1</span> - Las partes se someten a la jurisdicción de los tribunales ordinarios de la ciudad de Ushuaia.</p>
        </div>

        <div class="footer">
            <p>Gracias por elegir Jumping Ski Rental. Si tiene alguna duda, no dude en contactarnos.</p>
        </div>
    </div>
</body>
</html>
