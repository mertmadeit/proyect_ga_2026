<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Factura creada</title>
</head>
<body style="margin:0;padding:0;background:#eef5f1;font-family:Arial,Helvetica,sans-serif;color:#19321d;">
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
                                        <div style="margin:0 0 10px;color:#a8d9c2;font-size:13px;font-weight:700;">Factura #{{ $factura->numero }}</div>
                                        <h1 style="margin:0;font-size:27px;line-height:1.2;color:#ffffff;">Nueva factura registrada</h1>
                                        <p style="margin:10px 0 0;font-size:15px;line-height:1.6;color:#cfe4d8;">
                                            Se genero una nueva factura en el panel de Virelle.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:28px 30px 30px;">
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;background:#f7faf8;border:1px solid #e1ebe5;border-radius:12px;">
                                            <tr>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e1ebe5;color:#567568;font-size:13px;font-weight:700;">Cliente</td>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e1ebe5;color:#1d2b2a;font-size:14px;text-align:right;">{{ $cliente?->nombre ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e1ebe5;color:#567568;font-size:13px;font-weight:700;">RFC</td>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e1ebe5;color:#1d2b2a;font-size:14px;text-align:right;">{{ $cliente?->rfc ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e1ebe5;color:#567568;font-size:13px;font-weight:700;">Forma de pago</td>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e1ebe5;color:#1d2b2a;font-size:14px;text-align:right;">{{ $forma?->nombre ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e1ebe5;color:#567568;font-size:13px;font-weight:700;">Estado</td>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e1ebe5;color:#1d2b2a;font-size:14px;text-align:right;">{{ $estado?->estado ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e1ebe5;color:#567568;font-size:13px;font-weight:700;">Valor</td>
                                                <td style="padding:13px 16px;border-bottom:1px solid #e1ebe5;color:#123f32;font-size:18px;font-weight:700;text-align:right;">${{ number_format((float) $factura->valor, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:13px 16px;color:#567568;font-size:13px;font-weight:700;vertical-align:top;">Detalles</td>
                                                <td style="padding:13px 16px;color:#1d2b2a;font-size:14px;line-height:1.6;text-align:right;">{!! $factura->detalles ?: '-' !!}</td>
                                            </tr>
                                        </table>

                                        <table role="presentation" cellspacing="0" cellpadding="0" style="margin:24px 0 0;">
                                            <tr>
                                                <td style="background:#1f6f55;border-radius:999px;">
                                                    <a href="{{ $appUrl }}/facturas" style="display:inline-block;padding:12px 22px;color:#ffffff;text-decoration:none;font-weight:700;font-size:14px;">Ver facturas</a>
                                                </td>
                                            </tr>
                                        </table>

                                        <p style="margin:20px 0 0;color:#6e7f70;font-size:13px;line-height:1.6;">
                                            Mensaje generado automaticamente por el sistema de facturacion.
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
