<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Factura creada</title>
</head>
<body style="margin:0;padding:24px;background:#f4f7f3;font-family:Arial,sans-serif;color:#19321d;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table role="presentation" width="620" cellspacing="0" cellpadding="0" style="max-width:620px;background:#ffffff;border-radius:12px;border:1px solid #d9e4d4;">
                    <tr>
                        <td style="padding:24px;">
                            <h1 style="margin:0 0 10px;font-size:22px;color:#143c2d;">Nueva factura registrada</h1>
                            <p style="margin:0 0 16px;color:#385042;">Se ha creado la factura <strong>#{{ $factura->numero }}</strong>.</p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
                                <tr>
                                    <td style="padding:8px 0;border-bottom:1px solid #ebf1e8;"><strong>Cliente:</strong></td>
                                    <td style="padding:8px 0;border-bottom:1px solid #ebf1e8;">{{ $cliente?->nombre ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;border-bottom:1px solid #ebf1e8;"><strong>RFC:</strong></td>
                                    <td style="padding:8px 0;border-bottom:1px solid #ebf1e8;">{{ $cliente?->rfc ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;border-bottom:1px solid #ebf1e8;"><strong>Forma de pago:</strong></td>
                                    <td style="padding:8px 0;border-bottom:1px solid #ebf1e8;">{{ $forma?->nombre ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;border-bottom:1px solid #ebf1e8;"><strong>Estado:</strong></td>
                                    <td style="padding:8px 0;border-bottom:1px solid #ebf1e8;">{{ $estado?->estado ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;"><strong>Valor:</strong></td>
                                    <td style="padding:8px 0;">${{ number_format((float) $factura->valor, 2) }}</td>
                                </tr>
                            </table>

                            <p style="margin:16px 0 0;color:#6e7f70;font-size:13px;">Mensaje generado automaticamente por el sistema de facturacion.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
