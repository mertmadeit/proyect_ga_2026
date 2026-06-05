<x-guest-layout>
    <div class="mb-7">
        <div class="ui-kicker">Acceso</div>
        <h1 class="display-font mt-5 text-4xl leading-tight text-[var(--brand-green-dark)]">Iniciar sesion</h1>
        <p class="mt-3 text-sm leading-relaxed text-[var(--muted)]">
            Entra a tu cuenta para continuar con la gestion de clientes, facturas y pedidos.
        </p>
    </div>

    <x-auth-session-status class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-900" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="text-sm font-bold text-[var(--brand-green-dark)]">Correo electronico</label>
            <input id="email" class="ui-field mt-2 block w-full" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="text-sm font-bold text-[var(--brand-green-dark)]">Contrasena</label>

            <input id="password" class="ui-field mt-2 block w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex flex-wrap items-center justify-between gap-3">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-black/20 text-[var(--brand-green)] shadow-sm focus:ring-[var(--brand-green)]" name="remember">
                <span class="ms-2 text-sm text-[var(--muted)]">Recordarme</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-[var(--brand-green-dark)] underline-offset-4 hover:underline" href="{{ route('password.request') }}">
                    Olvide mi contrasena
                </a>
            @endif
        </div>

        <div class="flex flex-col gap-3 pt-2 sm:flex-row sm:items-center sm:justify-between">
            <a class="ui-button-secondary w-full sm:w-auto" href="{{ route('register') }}">
                Crear cuenta
            </a>

            <button type="submit" class="ui-button-primary w-full sm:w-auto">
                Entrar
            </button>
        </div>
    </form>
</x-guest-layout>
