<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Factura #{{ $factura->numero }}</title>
	<style>
		body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111; }
		.header { margin-bottom: 16px; }
		.title { font-size: 18px; font-weight: 700; margin: 0; }
		.meta { margin: 4px 0 0; color: #333; }
		.table { width: 100%; border-collapse: collapse; margin-top: 12px; }
		.table th, .table td { border: 1px solid #ddd; padding: 8px; vertical-align: top; }
		.table th { background: #f3f4f6; text-align: left; }
		.section-title { font-weight: 700; margin: 16px 0 6px; }
		.small { color: #444; font-size: 11px; }
	</style>
</head>
<body>
	<div class="header">
		<p class="title">Factura #{{ $factura->numero }}</p>
		<p class="meta">Fecha: {{ $fechaEmision ?? now()->format('Y-m-d H:i') }}</p>
	</div>

	<table class="table">
		<tr>
			<th style="width: 25%">Cliente</th>
			<td>{{ $cliente?->nombre ?? '—' }}</td>
			<th style="width: 15%">RFC</th>
			<td>{{ $cliente?->rfc ?? '—' }}</td>
		</tr>
		<tr>
			<th>Forma de pago</th>
			<td>{{ $forma?->nombre ?? '—' }}</td>
			<th>Estado</th>
			<td>{{ $estado?->estado ?? '—' }}</td>
		</tr>
		<tr>
			<th>Valor</th>
			<td colspan="3">{{ number_format((float) $factura->valor, 0, ',', '.') }}</td>
		</tr>
	</table>

	<p class="section-title">Detalles</p>
	<div>
		{!! $factura->detalles !!}
	</div>

	<p class="small">Documento generado automáticamente por el sistema.</p>
</body>
</html>
