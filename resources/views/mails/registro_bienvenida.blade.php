<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Bienvenido</title>
</head>
<body style="margin:0;padding:24px;background:#f3f7f5;font-family:Arial,sans-serif;color:#1d2b2a;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table role="presentation" width="620" cellspacing="0" cellpadding="0" style="max-width:620px;background:#ffffff;border-radius:14px;border:1px solid #dde7e1;">
                    <tr>
                        <td style="padding:28px;">
                            <h1 style="margin:0 0 12px;font-size:24px;color:#123f32;">Bienvenido a Virelle, {{ $nombre }}</h1>
                            <p style="margin:0 0 14px;color:#35534c;">
                                Tu cuenta fue registrada correctamente. Te compartimos tus datos de acceso:
                            </p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
                                <tr>
                                    <td style="padding:9px 0;border-bottom:1px solid #edf2ef;"><strong>Nombre:</strong></td>
                                    <td style="padding:9px 0;border-bottom:1px solid #edf2ef;">{{ $nombre }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:9px 0;border-bottom:1px solid #edf2ef;"><strong>Email:</strong></td>
                                    <td style="padding:9px 0;border-bottom:1px solid #edf2ef;">{{ $email }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:9px 0;"><strong>Contrasena:</strong></td>
                                    <td style="padding:9px 0;">{{ $passwordPlano }}</td>
                                </tr>
                            </table>

                            <p style="margin:18px 0 0;color:#61746d;font-size:13px;">
                                Por seguridad, te recomendamos cambiar tu contrasena al iniciar sesion.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
