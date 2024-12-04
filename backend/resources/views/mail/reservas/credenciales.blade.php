<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Credenciales de Acceso - Jumping Ski Rental</title>
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

    .section-title {
      font-size: 16px;
      font-weight: bold;
      margin-top: 20px;
      color: #4684d8;
    }

    .credentials {
      font-size: 14px;
      margin-top: 20px;
      background-color: #f9f9f9;
      padding: 15px;
      border-radius: 8px;
      border: 1px solid #ddd;
    }

    .footer {
      text-align: center;
      margin-top: 40px;
      font-size: 12px;
      color: #888;
    }

    a.button {
      display: inline-block;
      padding: 10px 20px;
      font-size: 14px;
      font-weight: bold;
      color: #ffffff;
      background-color: #4684d8;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 20px;
    }

    a.button:hover {
      background-color: #356bbd;
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
      <h1>Credenciales de Acceso</h1>
    </div>

    <p>Estimado/a <strong>{{ $nombre }}</strong>,</p>

    <p>Hemos creado una cuenta para usted en nuestro sistema. A continuación, encontrará sus credenciales para acceder a nuestro portal:</p>

    <div class="credentials">
      <p><span class="bold">Correo Electrónico:</span> {{ $email }}</p>
      <p><span class="bold">Contraseña Temporal:</span> {{ $password }}</p>
    </div>

    <p>Para acceder, por favor haga clic en el siguiente enlace:</p>
    <p><a href="{{ $frontendUrl }}" class="button">Iniciar Sesión</a></p>

    <p><strong>Nota:</strong> Por motivos de seguridad, le recomendamos cambiar su contraseña al iniciar sesión por primera vez.</p>

    <div class="footer">
      <p>Gracias por elegir Jumping Ski Rental. Si tiene alguna pregunta, no dude en contactarnos.</p>
      <p>Atentamente,<br>El equipo de Jumping Ski Rental</p>
    </div>
  </div>
</body>

</html>