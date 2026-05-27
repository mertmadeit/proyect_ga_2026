@extends('master_nav')

@section('title', 'Clientes')

@section('content')
<section class="py-4">
	<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
		<div>
			<span class="ui-kicker">Administracion</span>
			<h1 class="display-font mt-3 text-4xl text-(--text)">Clientes</h1>
			<p class="mt-2 text-sm text-(--muted)">Gestiona contactos, RFC y datos comerciales desde una tabla clara.</p>
		</div>
		<a href="{{ route('clientes.create') }}" class="ui-button-primary">Agregar cliente</a>
	</div>

	<div class="mb-5 grid gap-4 sm:grid-cols-3">
		<div class="ui-card p-5">
			<p class="text-xs font-extrabold uppercase tracking-[0.16em] text-(--muted)">Total</p>
			<p class="mt-2 text-3xl font-extrabold text-(--brand-green-dark)">{{ method_exists($clientes, 'total') ? $clientes->total() : $clientes->count() }}</p>
		</div>
		<div class="ui-card p-5">
			<p class="text-xs font-extrabold uppercase tracking-[0.16em] text-(--muted)">Modulo</p>
			<p class="mt-2 text-lg font-extrabold">Directorio comercial</p>
		</div>
		<div class="ui-card p-5">
			<p class="text-xs font-extrabold uppercase tracking-[0.16em] text-(--muted)">Estado</p>
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
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-(--muted)">No.</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-(--muted)">Nombre</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-(--muted)">RFC</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-(--muted)">Telefono</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-(--muted)">Email</th>
						<th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-[0.16em] text-(--muted)">Acciones</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-black/5 bg-white">
					@forelse ($clientes as $cliente)
						<tr class="transition hover:bg-(--surface)">
							<td class="px-6 py-4 text-sm font-bold text-(--brand-green-dark)">#{{ $cliente->id }}</td>
							<td class="px-6 py-4 text-sm font-semibold text-(--text)">{{ $cliente->nombre }}</td>
							<td class="px-6 py-4 text-sm text-(--muted)">{{ $cliente->rfc }}</td>
							<td class="px-6 py-4 text-sm text-(--muted)">{{ $cliente->telefono }}</td>
							<td class="px-6 py-4 text-sm text-(--muted)">{{ $cliente->email }}</td>
							<td class="px-6 py-4 text-right">
								<div class="inline-flex items-center justify-end gap-2 whitespace-nowrap">
									<a href="{{ route('clientes.edit', $cliente->id) }}" class="ui-button-secondary min-h-0 px-3 py-1.5">Editar</a>
									<form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline">
										@csrf
										@method('DELETE')
										<button type="submit" onclick="return confirm('Eliminar cliente?')" class="ui-button-danger min-h-0 px-3 py-1.5">Eliminar</button>
									</form>
								</div>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="6" class="ui-empty px-6 py-16 text-center">
								<p class="text-lg font-extrabold text-(--brand-green-dark)">No hay clientes registrados.</p>
								<p class="mt-2 text-sm text-(--muted)">Agrega el primer contacto para empezar a facturar.</p>
								<a href="{{ route('clientes.create') }}" class="ui-button-primary mt-4">Agregar cliente</a>
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection
