@extends('master_nav')
@section('title', 'Editar cliente')

@section('content')
	<section class="mx-auto max-w-3xl py-4">
		<div class="mb-6 flex items-center justify-between gap-3">
			<div>
				<span class="ui-kicker">Clientes</span>
				<h1 class="display-font mt-3 text-4xl">Editar cliente</h1>
			</div>
			<a href="{{ route('clientes.index') }}" class="ui-button-secondary">Volver</a>
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

			{!! Form::model($cliente, ['route' => ['clientes.update', $cliente->id], 'method' => 'PUT']) !!}
				<div class="grid gap-5 sm:grid-cols-2">
					<div class="space-y-2 sm:col-span-2">
						<label for="nombre" class="block text-sm font-bold text-[var(--text)]">Nombre</label>
						{!! Form::text('nombre', null, ['id' => 'nombre', 'class' => 'ui-field', 'required' => 'required']) !!}
					</div>

					<div class="space-y-2">
						<label for="rfc" class="block text-sm font-bold text-[var(--text)]">RFC</label>
						{!! Form::text('rfc', null, ['id' => 'rfc', 'class' => 'ui-field', 'required' => 'required']) !!}
					</div>

					<div class="space-y-2">
						<label for="telefono" class="block text-sm font-bold text-[var(--text)]">Telefono</label>
						{!! Form::text('telefono', null, ['id' => 'telefono', 'class' => 'ui-field', 'required' => 'required']) !!}
					</div>

					<div class="space-y-2 sm:col-span-2">
						<label for="direccion" class="block text-sm font-bold text-[var(--text)]">Direccion</label>
						{!! Form::text('direccion', null, ['id' => 'direccion', 'class' => 'ui-field', 'required' => 'required']) !!}
					</div>

					<div class="space-y-2 sm:col-span-2">
						<label for="email" class="block text-sm font-bold text-[var(--text)]">Email</label>
						{!! Form::email('email', null, ['id' => 'email', 'class' => 'ui-field', 'required' => 'required']) !!}
					</div>
				</div>

				<div class="mt-7 flex justify-end">
					{!! Form::submit('Guardar cambios', ['class' => 'ui-button-primary cursor-pointer']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</section>
@endsection
