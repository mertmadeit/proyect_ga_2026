@extends('master_nav')

@section('title', 'Perfiles')

@section('content')
<section class="py-4">
	<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
		<div>
			<span class="ui-kicker">Administracion</span>
			<h1 class="display-font mt-3 text-4xl text-[var(--text)]">Perfiles</h1>
			<p class="mt-2 text-sm text-[var(--muted)]">Controla los perfiles disponibles para los usuarios.</p>
		</div>
		<a href="{{ route('perfiles.create') }}" class="ui-button-primary">Agregar perfil</a>
	</div>

	<div class="mb-5 grid gap-4 sm:grid-cols-3">
		<div class="ui-card p-5">
			<p class="text-xs font-extrabold uppercase tracking-[0.16em] text-[var(--muted)]">Total</p>
			<p class="mt-2 text-3xl font-extrabold text-[var(--brand-green-dark)]">{{ method_exists($perfiles, 'total') ? $perfiles->total() : $perfiles->count() }}</p>
		</div>
		<div class="ui-card p-5">
			<p class="text-xs font-extrabold uppercase tracking-[0.16em] text-[var(--muted)]">Modulo</p>
			<p class="mt-2 text-lg font-extrabold">Permisos base</p>
		</div>
		<div class="ui-card p-5">
			<p class="text-xs font-extrabold uppercase tracking-[0.16em] text-[var(--muted)]">Estado</p>
			<span class="ui-chip mt-2">Activo</span>
		</div>
	</div>

	<div class="ui-panel overflow-hidden rounded-[22px]">
		@if (session('success'))
			<div class="border-b border-black/5 px-6 py-4">
				<div class="rounded-[12px] border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
			</div>
		@endif

		<div class="overflow-x-auto">
			<table class="ui-table min-w-full divide-y divide-black/5">
				<thead class="bg-[#f8fbf5]">
					<tr>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-[var(--muted)]">No.</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.16em] text-[var(--muted)]">Nombre</th>
						<th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-[0.16em] text-[var(--muted)]">Acciones</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-black/5 bg-white">
					@forelse ($perfiles as $perfil)
						<tr class="transition hover:bg-[var(--surface)]">
							<td class="px-6 py-4 text-sm font-bold text-[var(--brand-green-dark)]">#{{ $perfil->id }}</td>
							<td class="px-6 py-4 text-sm font-semibold text-[var(--text)]">{{ $perfil->nombre }}</td>
							<td class="px-6 py-4 text-right">
								<div class="ui-actions">
									<a href="{{ route('perfiles.edit', $perfil->id) }}" class="ui-button-secondary">Editar</a>
									<form action="{{ route('perfiles.destroy', $perfil->id) }}" method="POST">
										@csrf
										@method('DELETE')
										<button type="submit" onclick="return confirm('Eliminar perfil?')" class="ui-button-danger">Eliminar</button>
									</form>
								</div>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="3" class="ui-empty px-6 py-16 text-center">
								<p class="text-lg font-extrabold text-[var(--brand-green-dark)]">No hay perfiles registrados.</p>
								<p class="mt-2 text-sm text-[var(--muted)]">Crea un perfil para organizar accesos.</p>
								<a href="{{ route('perfiles.create') }}" class="ui-button-primary mt-4">Agregar perfil</a>
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection
