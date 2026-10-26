<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva solicitud de admisión</title>
</head>
<body style="margin:0;padding:24px 12px;background-color:#f4f6f9;font-family:Arial,Helvetica,sans-serif;color:#3d4c5f">
    @php
        $whatsappPhone = preg_replace('/\D/', '', $applicantPhone);
        if (strlen($whatsappPhone) === 10) {
            $whatsappPhone = '57'.$whatsappPhone;
        }
        $callPhone = preg_replace('/[^0-9+]/', '', $applicantPhone);
        $whatsappMessage = rawurlencode("Hola {$applicantName}, te contactamos del Instituto de Capacitación Técnica por tu interés en el programa {$programName}.");
    @endphp
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="560" style="width:100%;max-width:560px;background:#ffffff;border-radius:12px;overflow:hidden">
                    <tr>
                        <td style="padding:22px 28px;background:#0f2540">
                            @if ($hasLogo)
                                <img src="cid:{{ $logoCid }}" width="64" alt="Logo del Instituto de Capacitación Técnica" style="display:block;width:64px;height:auto;margin-bottom:14px;border:0">
                            @else
                                <p style="margin:0 0 14px;color:#f2a900;font-size:16px;font-weight:bold">I.C.T.</p>
                            @endif
                            <h1 style="margin:0;color:#ffffff;font-size:21px;line-height:1.35">Nueva solicitud de admisión</h1>
                            <p style="margin:7px 0 0;color:#d4deeb;font-size:14px">Llegó una nueva consulta para el equipo.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:26px 28px">
                            <p style="margin:0 0 16px;color:#0f2540;font-size:16px;line-height:1.7">
                                <strong>{{ $applicantName }}</strong>, ha solicitado información sobre el programa: <strong>{{ $programName }}</strong>.
                            </p>
                            <p style="margin:0 0 8px;color:#566a82;font-size:14px;line-height:1.6">
                                Puedes comunicarte con esta persona por correo en
                                <a href="mailto:{{ $applicantEmail }}" style="color:#0759b5;text-decoration:none">{{ $applicantEmail }}</a>
                                o llamando al
                                <a href="tel:{{ $callPhone }}" style="color:#0759b5;text-decoration:none">{{ $applicantPhone }}</a>.
                            </p>
                            <p style="margin:0;color:#566a82;font-size:14px;line-height:1.6">
                                @if (strlen($whatsappPhone) >= 11)
                                    También puedes escribirle por WhatsApp.
                                @else
                                    También puedes escribirle por WhatsApp al número registrado.
                                @endif
                            </p>
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="margin-top:22px">
                                <tr>
                                    <td style="padding:0 8px 8px 0">
                                        <a href="mailto:{{ $applicantEmail }}" style="display:inline-block;padding:11px 15px;border-radius:7px;background:#0b5bd3;color:#ffffff;font-size:13px;font-weight:bold;text-decoration:none">Responder correo</a>
                                    </td>
                                    <td style="padding:0 8px 8px 0">
                                        <a href="tel:{{ $callPhone }}" style="display:inline-block;padding:11px 15px;border-radius:7px;background:#edf4fc;color:#0759b5;font-size:13px;font-weight:bold;text-decoration:none">Llamar</a>
                                    </td>
                                    @if (strlen($whatsappPhone) >= 11)
                                        <td style="padding:0 0 8px">
                                            <a href="https://wa.me/{{ $whatsappPhone }}?text={{ $whatsappMessage }}" target="_blank" style="display:inline-block;padding:11px 15px;border-radius:7px;background:#e9f6ee;color:#217342;font-size:13px;font-weight:bold;text-decoration:none">WhatsApp</a>
                                        </td>
                                    @endif
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:14px 28px;background:#f4f6f9;color:#718198;font-size:12px">
                            Instituto de Capacitación Técnica <span style="color:#f2a900">· I.C.T.</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
