<x-guest-layout>
    <div class="mb-7">
        <div class="ui-kicker">Recuperacion</div>
        <h1 class="display-font mt-5 text-4xl leading-tight text-[var(--brand-green-dark)]">Recuperar contrasena</h1>
        <p class="mt-3 text-sm leading-relaxed text-[var(--muted)]">
            Escribe tu correo y te enviaremos un enlace para crear una nueva contrasena.
        </p>
    </div>

    <x-auth-session-status class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-900" :status="session('status')" />
    @if (session('mensaje'))
        <div class="mb-5 rounded-2xl border border-amber-300 bg-amber-50 p-3 text-sm text-amber-900">
            {{ session('mensaje') }}
        </div>
    @endif
    @if (session('reset_url'))
        <div class="mb-5 rounded-2xl border border-emerald-300 bg-emerald-50 p-3 text-sm text-emerald-900">
            <p class="font-semibold">Enlace de recuperacion:</p>
            <a class="mt-1 block break-all underline" href="{{ session('reset_url') }}">{{ session('reset_url') }}</a>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="text-sm font-bold text-[var(--brand-green-dark)]">Correo electronico</label>
            <input id="email" class="ui-field mt-2 block w-full" type="email" name="email" value="{{ old('email') }}" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-3 pt-2 sm:flex-row sm:items-center sm:justify-between">
            <a class="ui-button-secondary w-full sm:w-auto" href="{{ route('login') }}">
                Volver al login
            </a>

            <button type="submit" class="ui-button-primary w-full sm:w-auto">
                Enviar enlace
            </button>
        </div>
    </form>
</x-guest-layout>
