@extends('master_nav')
@section('title', 'Crear cliente')

@section('content')
	<section class="mx-auto max-w-3xl py-4">
		<div class="mb-6 flex items-center justify-between gap-3">
			<div>
				<span class="ui-kicker">Clientes</span>
				<h1 class="display-font mt-3 text-4xl">Crear cliente</h1>
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

			{!! Form::open(['route' => 'clientes.store']) !!}
				<div class="grid gap-5 sm:grid-cols-2">
					<div class="space-y-2 sm:col-span-2">
						<label for="nombre" class="block text-sm font-bold text-(--text)">Nombre</label>
						{!! Form::text('nombre', null, ['id' => 'nombre', 'class' => 'ui-field', 'required' => 'required', 'placeholder' => 'Ej. Juan Perez']) !!}
					</div>

					<div class="space-y-2">
						<label for="rfc" class="block text-sm font-bold text-(--text)">RFC</label>
						{!! Form::text('rfc', null, ['id' => 'rfc', 'class' => 'ui-field', 'required' => 'required', 'placeholder' => 'Ej. ABCD010203XYZ']) !!}
					</div>

					<div class="space-y-2">
						<label for="telefono" class="block text-sm font-bold text-(--text)">Telefono</label>
						{!! Form::text('telefono', null, ['id' => 'telefono', 'class' => 'ui-field', 'required' => 'required', 'placeholder' => 'Ej. 5512345678']) !!}
					</div>

					<div class="space-y-2 sm:col-span-2">
						<label for="direccion" class="block text-sm font-bold text-(--text)">Direccion</label>
						{!! Form::text('direccion', null, ['id' => 'direccion', 'class' => 'ui-field', 'required' => 'required', 'placeholder' => 'Ej. Calle 123, Col. Centro']) !!}
					</div>

					<div class="space-y-2 sm:col-span-2">
						<label for="email" class="block text-sm font-bold text-(--text)">Email</label>
						{!! Form::email('email', null, ['id' => 'email', 'class' => 'ui-field', 'required' => 'required', 'placeholder' => 'Ej. cliente@correo.com']) !!}
					</div>
				</div>

				<div class="mt-7 flex justify-end">
					{!! Form::submit('Guardar cliente', ['class' => 'ui-button-primary cursor-pointer']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</section>
@endsection
