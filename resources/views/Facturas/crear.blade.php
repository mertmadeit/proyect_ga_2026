@extends('master_nav')
@section('title', 'Crear factura')

@section('content')
	@php
		$facturasIndexUrl = Route::has('facturas.index') ? route('facturas.index') : url('facturas');
		$facturasStoreUrl = Route::has('facturas.store') ? route('facturas.store') : url('facturas');
	@endphp

	<section class="mx-auto min-w-0 max-w-3xl py-4">
		<div class="invoice-form-header mb-6 flex items-center justify-between gap-3">
			<div>
				<span class="ui-kicker">Facturas</span>
				<h1 class="invoice-form-title display-font mt-3 text-4xl">Crear factura</h1>
			</div>
			<a href="{{ $facturasIndexUrl }}" class="ui-button-secondary">Volver</a>
		</div>

		<div class="invoice-form-shell ui-panel rounded-[22px] p-6 sm:p-8">
			@if ($errors->any())
				<div class="mb-5 rounded-[12px] border border-red-200 bg-red-50 p-4 text-sm text-red-700">
					<ul class="list-disc pl-5">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::open(['url' => $facturasStoreUrl]) !!}
				<div class="invoice-form-grid grid gap-5 sm:grid-cols-2">
					<div class="space-y-2">
						<label for="valor" class="block text-sm font-bold text-[var(--text)]">Valor</label>
						{!! Form::number('valor', old('valor'), ['id' => 'valor', 'class' => 'ui-field', 'required' => 'required', 'placeholder' => 'Valor de la factura']) !!}
					</div>

					<div class="space-y-2">
						<label for="idcliente" class="block text-sm font-bold text-[var(--text)]">Cliente</label>
						{!! Form::select('idcliente', $clientes ?? [], old('idcliente'), ['id' => 'idcliente', 'class' => 'ui-field', 'required' => 'required', 'placeholder' => 'Selecciona un cliente']) !!}
					</div>

					<div class="space-y-2">
						<label for="idforma" class="block text-sm font-bold text-[var(--text)]">Forma de pago</label>
						{!! Form::select('idforma', $formas ?? [], old('idforma'), ['id' => 'idforma', 'class' => 'ui-field', 'required' => 'required', 'placeholder' => 'Selecciona una forma']) !!}
					</div>

					<div class="space-y-2">
						<label for="idestado" class="block text-sm font-bold text-[var(--text)]">Estado</label>
						{!! Form::select('idestado', $estados ?? [], old('idestado'), ['id' => 'idestado', 'class' => 'ui-field', 'required' => 'required', 'placeholder' => 'Selecciona un estado']) !!}
					</div>

					<div class="space-y-2 sm:col-span-2">
						<label for="detalles" class="block text-sm font-bold text-[var(--text)]">Detalles</label>
						{!! Form::textarea('detalles', old('detalles'), ['id' => 'detalles', 'rows' => 4, 'class' => 'ui-field', 'placeholder' => 'Detalles de la factura']) !!}
					</div>
				</div>

				<div class="mt-7 flex justify-end">
					{!! Form::submit('Guardar factura', ['class' => 'ui-button-primary cursor-pointer']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</section>
@endsection

@section('scripts')
	<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			const textarea = document.querySelector('#detalles');
			if (!textarea || typeof ClassicEditor === 'undefined') return;
			ClassicEditor.create(textarea)
				.then((editor) => {
					const form = textarea.closest('form');
					if (!form) return;
					form.addEventListener('submit', () => {
						textarea.value = editor.getData();
					});
				})
				.catch((error) => console.error(error));
		});
	</script>
@endsection
