@extends('master_nav')

@section('title', 'Clientes')

@section('content')
@php
	$isAdmin = auth()->check() && (int) auth()->user()->idperfil === 1;
@endphp
<section class="py-4">
	<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
		<div>
			<span class="ui-kicker">Administracion</span>
			<h1 class="display-font mt-3 text-4xl text-[var(--text)]">Clientes</h1>
			<p class="mt-2 text-sm text-[var(--muted)]">Gestiona contactos, RFC y datos comerciales desde una tabla clara.</p>
		</div>
		@if ($isAdmin)
			<a href="{{ route('clientes.create') }}" class="ui-button-primary">Agregar cliente</a>
		@endif
	</div>

	<div class="mb-5 grid gap-4 sm:grid-cols-3">
		<div class="ui-card p-5">
			<p class="text-xs font-extrabold uppercase tracking-[0.16em] text-[var(--muted)]">Total</p>
			<p class="mt-2 text-3xl font-extrabold text-[var(--brand-green-dark)]">{{ method_exists($clientes, 'total') ? $clientes->total() : $clientes->count() }}</p>
		</div>
		<div class="ui-card p-5">
			<p class="text-xs font-extrabold uppercase tracking-[0.16em] text-[var(--muted)]">Modulo</p>
			<p class="mt-2 text-lg font-extrabold">Directorio comercial</p>
		</div>
		<div class="ui-card p-5">
			<p class="text-xs font-extrabold uppercase tracking-[0.16em] text-[var(--muted)]">Estado</p>
			<span class="ui-chip mt-2">Activo</span>
		</div>
	</div>

	<div class="ui-panel overflow-hidden rounded-[22px]">
		@if (session('success'))
			<div class="border-b border-black/5 px-6 py-4">
				<div class="rounded-[12px] border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
					{{ session('success') }}
				</div>
			</div>
		@endif

		<div class="overflow-x-auto">
			<table class="ui-table min-w-full divide-y divide-black/5">
				<thead class="bg-[#f8fbf5]">
					<tr>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-[var(--muted)]">No.</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-[var(--muted)]">Nombre</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-[var(--muted)]">RFC</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-[var(--muted)]">Telefono</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-[var(--muted)]">Email</th>
						@if ($isAdmin)
							<th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-[0.16em] text-[var(--muted)]">Acciones</th>
						@endif
					</tr>
				</thead>
				<tbody class="divide-y divide-black/5 bg-white">
					@forelse ($clientes as $cliente)
						<tr class="transition hover:bg-[var(--surface)]">
							<td class="px-6 py-4 text-sm font-bold text-[var(--brand-green-dark)]">#{{ $cliente->id }}</td>
							<td class="px-6 py-4 text-sm font-semibold text-[var(--text)]">{{ $cliente->nombre }}</td>
							<td class="px-6 py-4 text-sm text-[var(--muted)]">{{ $cliente->rfc }}</td>
							<td class="px-6 py-4 text-sm text-[var(--muted)]">{{ $cliente->telefono }}</td>
							<td class="px-6 py-4 text-sm text-[var(--muted)]">{{ $cliente->email }}</td>
							@if ($isAdmin)
								<td class="px-6 py-4 text-right">
									<div class="ui-actions">
										<a href="{{ route('clientes.edit', $cliente->id) }}" class="ui-button-secondary">Editar</a>
										<form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
											@csrf
											@method('DELETE')
											<button type="submit" onclick="return confirm('Eliminar cliente?')" class="ui-button-danger">Eliminar</button>
										</form>
									</div>
								</td>
							@endif
						</tr>
					@empty
						<tr>
							<td colspan="{{ $isAdmin ? 6 : 5 }}" class="ui-empty px-6 py-16 text-center">
								<p class="text-lg font-extrabold text-[var(--brand-green-dark)]">No hay clientes registrados.</p>
								<p class="mt-2 text-sm text-[var(--muted)]">Agrega el primer contacto para empezar a facturar.</p>
								@if ($isAdmin)
									<a href="{{ route('clientes.create') }}" class="ui-button-primary mt-4">Agregar cliente</a>
								@endif
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection
