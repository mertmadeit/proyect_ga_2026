<x-guest-layout>
    <div class="mb-7">
        <div class="ui-kicker">Confirmacion</div>
        <h1 class="display-font mt-5 text-4xl leading-tight text-[var(--brand-green-dark)]">Confirma tu acceso</h1>
        <p class="mt-3 text-sm leading-relaxed text-[var(--muted)]">
            Esta zona requiere validar tu contrasena antes de continuar.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="password" value="Contrasena" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end pt-2">
            <x-primary-button>
                Confirmar
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
