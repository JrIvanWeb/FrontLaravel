<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recuperación de contraseña</title>
</head>
<body style="margin: 0; padding: 32px; color: #1f2933; font-family: Arial, sans-serif;">
    <main style="max-width: 520px; margin: 0 auto;">
        <h1 style="font-size: 22px;">Recuperar contraseña</h1>
        <p>Usa este código para crear una nueva contraseña en Back-ICT:</p>
        <p style="padding: 16px; background: #f1f5f9; font-size: 30px; font-weight: 700; letter-spacing: 6px; text-align: center;">
            {{ $code }}
        </p>
        <p>El código vence en {{ $expiresInMinutes }} minutos y solo puede utilizarse una vez. Si no solicitaste este cambio, ignora este correo.</p>
    </main>
</body>
</html>