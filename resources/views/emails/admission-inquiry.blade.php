<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva solicitud de admisión</title>
</head>
<body style="margin:0;background:#f2f5f9;font-family:Arial,sans-serif;color:#24364c">
    <main style="max-width:600px;margin:32px auto;padding:32px;background:#fff;border-radius:12px">
        <p style="margin:0 0 8px;color:#1763b1;font-size:13px;font-weight:bold;letter-spacing:.08em">INSTITUTO DE CAPACITACIÓN TÉCNICA</p>
        <h1 style="margin:0 0 20px;font-size:24px">Nueva solicitud de admisión</h1>
        <p>Una persona solicitó información sobre uno de los programas institucionales.</p>
        <table style="width:100%;border-collapse:collapse;margin-top:20px">
            <tr><th align="left" style="padding:10px;border-bottom:1px solid #e5eaf0">Nombre</th><td style="padding:10px;border-bottom:1px solid #e5eaf0">{{ $applicantName }}</td></tr>
            <tr><th align="left" style="padding:10px;border-bottom:1px solid #e5eaf0">Correo</th><td style="padding:10px;border-bottom:1px solid #e5eaf0">{{ $applicantEmail }}</td></tr>
            <tr><th align="left" style="padding:10px;border-bottom:1px solid #e5eaf0">Teléfono</th><td style="padding:10px;border-bottom:1px solid #e5eaf0">{{ $applicantPhone }}</td></tr>
            <tr><th align="left" style="padding:10px;border-bottom:1px solid #e5eaf0">Programa de interés</th><td style="padding:10px;border-bottom:1px solid #e5eaf0">{{ $programName }}</td></tr>
        </table>
        <p style="margin:24px 0 0;color:#64748b;font-size:13px">Puedes responder este mensaje directamente para contactar a la persona interesada.</p>
    </main>
</body>
</html>
