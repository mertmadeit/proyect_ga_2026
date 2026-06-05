@extends('master_nav')
@section('title', 'Editar factura')

@section('content')
	<section class="mx-auto max-w-3xl py-4">
		<div class="mb-6 flex items-center justify-between gap-3">
			<div>
				<span class="ui-kicker">Facturas</span>
				<h1 class="display-font mt-3 text-4xl">Editar factura</h1>
			</div>
			<a href="{{ route('facturas.index') }}" class="ui-button-secondary">Volver</a>
		</div>

		<div class="ui-panel rounded-[22px] p-6 sm:p-8">
			@if ($errors->any())
				<div class="mb-5 rounded-[12px] border border-red-200 bg-red-50 p-4 text-sm text-red-700">
					<ul class="list-disc pl-5">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::model($factura, ['route' => ['facturas.update', $factura->id], 'method' => 'PUT']) !!}
				<div class="grid gap-5 sm:grid-cols-2">
					<div class="space-y-2">
						<label for="valor" class="block text-sm font-bold text-[var(--text)]">Valor</label>
						{!! Form::number('valor', null, ['id' => 'valor', 'class' => 'ui-field', 'required' => 'required', 'placeholder' => 'Valor de la factura']) !!}
					</div>

					<div class="space-y-2">
						<label for="idcliente" class="block text-sm font-bold text-[var(--text)]">Cliente</label>
						{!! Form::select('idcliente', $clientes ?? [], null, ['id' => 'idcliente', 'class' => 'ui-field', 'required' => 'required']) !!}
					</div>

					<div class="space-y-2">
						<label for="idforma" class="block text-sm font-bold text-[var(--text)]">Forma de pago</label>
						{!! Form::select('idforma', $formas ?? [], null, ['id' => 'idforma', 'class' => 'ui-field', 'required' => 'required']) !!}
					</div>

					<div class="space-y-2">
						<label for="idestado" class="block text-sm font-bold text-[var(--text)]">Estado</label>
						{!! Form::select('idestado', $estados ?? [], null, ['id' => 'idestado', 'class' => 'ui-field', 'required' => 'required']) !!}
					</div>

					<div class="space-y-2 sm:col-span-2">
						<label for="detalles" class="block text-sm font-bold text-[var(--text)]">Detalles</label>
						{!! Form::textarea('detalles', null, ['id' => 'detalles', 'rows' => 4, 'class' => 'ui-field', 'placeholder' => 'Detalles de la factura']) !!}
					</div>
				</div>

				<div class="mt-7 flex justify-end">
					{!! Form::submit('Guardar cambios', ['class' => 'ui-button-primary cursor-pointer']) !!}
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
