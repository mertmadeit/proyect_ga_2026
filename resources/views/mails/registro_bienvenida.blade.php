<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Bienvenido</title>
</head>
<body style="margin:0;padding:0;background:#eef5f1;font-family:Arial,Helvetica,sans-serif;color:#1d2b2a;">
    @php
        $appUrl = rtrim((string) config('app.url'), '/');
    @endphp
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" style="padding:32px 16px;">
                <table role="presentation" width="640" cellspacing="0" cellpadding="0" style="width:100%;max-width:640px;border-collapse:collapse;">
                    <tr>
                        <td style="padding:0 0 14px;">
                            <div style="font-size:13px;letter-spacing:0.08em;text-transform:uppercase;color:#567568;font-weight:700;">Virelle</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#ffffff;border:1px solid #d9e8df;border-radius:16px;overflow:hidden;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
                                <tr>
                                    <td style="padding:30px 30px 24px;background:#123f32;">
                                        <h1 style="margin:0;font-size:28px;line-height:1.2;color:#ffffff;">Bienvenido a Virelle</h1>
                                        <p style="margin:10px 0 0;font-size:15px;line-height:1.6;color:#cfe4d8;">
                                            Tu acceso al panel quedo listo, {{ $nombre }}.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:28px 30px 30px;">
                                        <p style="margin:0 0 18px;font-size:15px;line-height:1.7;color:#35534c;">
                                            Usa estos datos para iniciar sesion y comenzar a gestionar la operacion de Virelle.
                                        </p>

                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;background:#f7faf8;border:1px solid #e1ebe5;border-radius:12px;">
                                            <tr>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e1ebe5;color:#567568;font-size:13px;font-weight:700;">Nombre</td>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e1ebe5;color:#1d2b2a;font-size:14px;text-align:right;">{{ $nombre }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e1ebe5;color:#567568;font-size:13px;font-weight:700;">Email</td>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e1ebe5;color:#1d2b2a;font-size:14px;text-align:right;">{{ $email }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:13px 16px;color:#567568;font-size:13px;font-weight:700;">Contrasena</td>
                                                <td style="padding:13px 16px;color:#1d2b2a;font-size:14px;text-align:right;">{{ $passwordPlano }}</td>
                                            </tr>
                                        </table>

                                        <table role="presentation" cellspacing="0" cellpadding="0" style="margin:24px 0 0;">
                                            <tr>
                                                <td style="background:#1f6f55;border-radius:999px;">
                                                    <a href="{{ $appUrl }}/login" style="display:inline-block;padding:12px 22px;color:#ffffff;text-decoration:none;font-weight:700;font-size:14px;">Entrar al panel</a>
                                                </td>
                                            </tr>
                                        </table>

                                        <p style="margin:20px 0 0;color:#61746d;font-size:13px;line-height:1.6;">
                                            Por seguridad, cambia tu contrasena despues de iniciar sesion por primera vez.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:18px 4px 0;color:#7b8c84;font-size:12px;line-height:1.5;text-align:center;">
                            Este mensaje fue enviado automaticamente por Virelle.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
