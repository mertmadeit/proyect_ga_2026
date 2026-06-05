<x-guest-layout>
    <div class="mb-7">
        <div class="ui-kicker">Nueva clave</div>
        <h1 class="display-font mt-5 text-4xl leading-tight text-[var(--brand-green-dark)]">Actualizar contrasena</h1>
        <p class="mt-3 text-sm leading-relaxed text-[var(--muted)]">
            Define una nueva contrasena para volver a entrar al panel de Virelle.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="text-sm font-bold text-[var(--brand-green-dark)]">Correo electronico</label>
            <input id="email" class="ui-field mt-2 block w-full" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="text-sm font-bold text-[var(--brand-green-dark)]">Nueva contrasena</label>
            <input id="password" class="ui-field mt-2 block w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="text-sm font-bold text-[var(--brand-green-dark)]">Confirmar contrasena</label>

            <input id="password_confirmation" class="ui-field mt-2 block w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex justify-end pt-2">
            <button type="submit" class="ui-button-primary w-full sm:w-auto">
                Guardar contrasena
            </button>
        </div>
    </form>
</x-guest-layout>
