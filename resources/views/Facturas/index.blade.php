@extends('master_nav')

@section('title', 'Facturas')

@section('content')
<section class="py-4">
	<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
		<div>
			<span class="ui-kicker">Administracion</span>
			<h1 class="display-font mt-3 text-4xl text-(--text)">Facturas</h1>
			<p class="mt-2 text-sm text-(--muted)">Consulta clientes, montos y archivos PDF registrados.</p>
		</div>
		<div class="flex flex-wrap items-center justify-end gap-2">
			@auth
				<a href="{{ route('facturas.reporte') }}" class="ui-button-secondary">Descargar reporte PDF</a>
			@endauth
			@if (auth()->check() && (int) auth()->user()->idperfil === 1)
				<a href="{{ route('facturas.create') }}" class="ui-button-primary">Agregar factura</a>
			@endif
		</div>
	</div>

	<div class="mb-5 grid gap-4 sm:grid-cols-3">
		<div class="ui-card p-5">
			<p class="text-xs font-extrabold uppercase tracking-[0.16em] text-(--muted)">Total</p>
			<p class="mt-2 text-3xl font-extrabold text-(--brand-green-dark)">{{ method_exists($facturas, 'total') ? $facturas->total() : $facturas->count() }}</p>
		</div>
		<div class="ui-card p-5">
			<p class="text-xs font-extrabold uppercase tracking-[0.16em] text-(--muted)">Modulo</p>
			<p class="mt-2 text-lg font-extrabold">Control de ventas</p>
		</div>
		<div class="ui-card p-5">
			<p class="text-xs font-extrabold uppercase tracking-[0.16em] text-(--muted)">Archivos</p>
			<span class="ui-chip mt-2">PDF</span>
		</div>
	</div>

	<div class="ui-panel overflow-hidden rounded-[22px]">
		<div class="overflow-x-auto">
			<table class="ui-table min-w-full divide-y divide-black/5">
				<thead class="bg-[#f8fbf5]">
					<tr>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-(--muted)">No.</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-(--muted)">Cliente</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-(--muted)">RFC</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-(--muted)">Valor</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-(--muted)">Archivo</th>
						<th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-[0.16em] text-(--muted)">Acciones</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-black/5 bg-white">
					@forelse ($facturas as $factura)
						<tr class="transition hover:bg-(--surface)">
							<td class="px-6 py-4 text-sm font-bold text-(--brand-green-dark)">#{{ $factura->id }}</td>
							<td class="px-6 py-4 text-sm font-semibold text-(--text)">{{ $factura->cliente?->nombre ?? '-' }}</td>
							<td class="px-6 py-4 text-sm text-(--muted)">{{ $factura->cliente?->rfc ?? '-' }}</td>
							<td class="px-6 py-4 text-sm font-bold text-(--brand-green-dark)">${{ number_format($factura->valor, 2) }}</td>
							<td class="px-6 py-4 text-sm text-(--muted)">
								@php
									$archivoNombre = $factura->archivo ? basename($factura->archivo) : null;
									$archivoPath = $archivoNombre ? public_path('archivos/' . $archivoNombre) : null;
								@endphp

								@if ($archivoNombre && $archivoPath && is_file($archivoPath))
									<a href="{{ asset('archivos/' . $archivoNombre) }}" target="_blank" rel="noopener" class="font-bold text-(--brand-green-dark)">Ver PDF</a>
								@else
									-
								@endif
							</td>
							<td class="px-6 py-4 text-right">
								@if (auth()->check() && (int) auth()->user()->idperfil === 1)
									<div class="inline-flex items-center justify-end gap-2 whitespace-nowrap">
										<a href="{{ route('facturas.edit', $factura->id) }}" class="ui-button-secondary min-h-0 px-3 py-1.5">Editar</a>
										<form action="{{ route('facturas.destroy', $factura->id) }}" method="POST" class="inline">
											@csrf
											@method('DELETE')
											<button type="submit" onclick="return confirm('Eliminar factura?')" class="ui-button-danger min-h-0 px-3 py-1.5">Eliminar</button>
										</form>
									</div>
								@else
									<span class="text-xs font-semibold uppercase tracking-[0.14em] text-(--muted)">Solo lectura</span>
								@endif
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="6" class="ui-empty px-6 py-16 text-center">
								<p class="text-lg font-extrabold text-(--brand-green-dark)">No hay facturas registradas.</p>
								<p class="mt-2 text-sm text-(--muted)">Crea la primera factura para comenzar el control de ventas.</p>
								@if (auth()->check() && (int) auth()->user()->idperfil === 1)
									<a href="{{ route('facturas.create') }}" class="ui-button-primary mt-4">Agregar factura</a>
								@endif
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>

		@if (method_exists($facturas, 'links'))
			<div class="border-t border-black/5 px-6 py-4">
				{{ $facturas->links() }}
			</div>
		@endif
	</div>
</section>
@endsection
