<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de Facturas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1f2937; }
        h1 { margin: 0 0 6px 0; font-size: 20px; }
        p { margin: 0 0 12px 0; color: #4b5563; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #d1d5db; padding: 8px; text-align: left; vertical-align: top; }
        th { background: #f3f4f6; font-weight: 700; }
        .muted { color: #6b7280; }
        .preview { width: 70px; height: 70px; object-fit: cover; border: 1px solid #e5e7eb; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Reporte de Facturas</h1>
    <p>Generado: {{ $fechaGeneracion }}</p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Cliente</th>
                <th>RFC</th>
                <th>Forma</th>
                <th>Estado</th>
                <th>Valor</th>
                <th>Archivo</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($facturas as $factura)
                <tr>
                    <td>#{{ $factura->numero }}</td>
                    <td>{{ $factura->cliente?->nombre ?? '-' }}</td>
                    <td>{{ $factura->cliente?->rfc ?? '-' }}</td>
                    <td>{{ $factura->forma?->nombre ?? '-' }}</td>
                    <td>{{ $factura->estado?->estado ?? '-' }}</td>
                    <td>${{ number_format((float) $factura->valor, 2) }}</td>
                    <td>
                        @php
                            $archivo = $factura->archivo ? public_path('archivos/' . basename($factura->archivo)) : null;
                            $vistaPrevia = null;
                            if ($archivo && is_file($archivo)) {
                                $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true)) {
                                    $bytes = @file_get_contents($archivo);
                                    if ($bytes !== false) {
                                        $mime = match ($extension) {
                                            'jpg', 'jpeg' => 'image/jpeg',
                                            'png' => 'image/png',
                                            'gif' => 'image/gif',
                                            'webp' => 'image/webp',
                                            default => null,
                                        };
                                        if ($mime) {
                                            $vistaPrevia = 'data:' . $mime . ';base64,' . base64_encode($bytes);
                                        }
                                    }
                                }
                            }
                        @endphp

                        @if ($vistaPrevia)
                            <img src="{{ $vistaPrevia }}" alt="Vista previa" class="preview">
                        @elseif ($factura->archivo)
                            <span>{{ basename($factura->archivo) }}</span>
                        @else
                            <span class="muted">Sin archivo</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay facturas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
