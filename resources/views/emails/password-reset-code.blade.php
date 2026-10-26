<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Código para recuperar tu contraseña</title>
</head>
<body style="margin:0;padding:24px 12px;background-color:#f4f6f9;font-family:Arial,Helvetica,sans-serif;color:#3d4c5f">
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="520" style="width:100%;max-width:520px;background-color:#ffffff;border-radius:12px;overflow:hidden">
                    <tr>
                        <td style="padding:24px 28px;background-color:#0f2540">
                            <p style="margin:0 0 8px;color:#f2a900;font-size:13px;font-weight:bold;letter-spacing:1px">I.C.T.</p>
                            <h1 style="margin:0;color:#ffffff;font-size:21px;line-height:1.35">Recupera tu contraseña</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:26px 28px">
                            <p style="margin:0 0 18px;font-size:15px;line-height:1.6">Usa este código para crear una nueva contraseña:</p>
                            <p style="margin:0 0 18px;padding:16px;border-radius:8px;background-color:#f2f7fd;color:#0f2540;text-align:center;font-size:30px;font-weight:bold;letter-spacing:8px">{{ $code }}</p>
                            <p style="margin:0;color:#566a82;font-size:13px;line-height:1.6">El código vence en <strong>{{ $expiresInMinutes }} minutos</strong> y solo se puede utilizar una vez. No compartas este código con nadie.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 28px;background-color:#f4f6f9;color:#718198;font-size:12px">
                            Instituto de Capacitación Técnica · I.C.T.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
