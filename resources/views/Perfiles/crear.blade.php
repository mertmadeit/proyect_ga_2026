@extends('master_nav')
@section('title', 'Crear perfil')

@section('content')
	<section class="mx-auto max-w-2xl py-4">
		<div class="mb-6 flex items-center justify-between gap-3">
			<div>
				<span class="ui-kicker">Perfiles</span>
				<h1 class="display-font mt-3 text-4xl">Crear perfil</h1>
			</div>
			<a href="{{ route('perfiles.index') }}" class="ui-button-secondary">Volver</a>
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

			{!! Form::open(['route' => 'perfiles.store']) !!}
				<div class="space-y-2">
					<label for="nombre" class="block text-sm font-bold text-(--text)">Nombre del perfil</label>
					{!! Form::text('nombre', null, ['id' => 'nombre', 'class' => 'ui-field', 'required' => 'required', 'placeholder' => 'Ej. Administrador']) !!}
				</div>

				<div class="mt-7 flex justify-end">
					{!! Form::submit('Guardar perfil', ['class' => 'ui-button-primary cursor-pointer']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</section>
@endsection
