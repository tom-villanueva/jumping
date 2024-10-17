<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato reserva Nro: {{ $id }}</title>
    <style>
        .texto {
            text-align:center; 
            color:#000000;  
            font-size: 12px;
            line-height:0.6
        }

        .separador {
            text-align:center; 
            color:#000000;  
            font-size: 10px;
            line-height:0.4
        }
    </style>
</head>
<body style="line-height: 1;">
          <div style="text-align:center;">

        <img src="images/jumping-logo.png" width="100px" />
        <p class="separador">&nbsp;</p>
        <p class="texto"><u>Nro. Reserva: {{ $id }}</u></p>
        <p class="separador">&nbsp;</p>
        <p class="texto">Locatario: {{ $nombre }}</p>

        <p class="texto">Salida: {{ $fecha_desde }}. Regreso: {{ $fecha_hasta }}</p>
        <p class="separador">&nbsp;</p>

        <p class="texto"><u>Garantía</u></p>
        <p class="separador">&nbsp;</p>
        <p class="texto">Tarjeta:_____________________________________</p>
        <p class="texto">&nbsp;</p>
        <p class="texto">Vto:_____/_____ Cdo. Seg.:____________</p>
        <p class="separador">&nbsp;</p>

        <p style="text-align:center; color:#000000;font-size: 10px;line-height:8px;">
        El locatario autoriza a Jumping Ski rental a descontar de su tarjeta de crédito lo emergente al presente contrato. (Requiere contrato firmado).
          Este contrato vence indefectiblemente en la fecha {{ $fecha_desde }}.
          Las condiciones generales se encuentran disponibles en el correo electrónico enviado junto a la reserva. Las partes dicen conocer y aceptar las mismas.
        </p>
        <p class="separador">&nbsp;</p>
        <p class="separador">&nbsp;</p>
        <p class="texto">Firma Locatario:__________________________</p>
        <p class="separador">&nbsp;</p>
      </div>
</body>
</html>