<x-guest-layout>
    <div class="mb-7">
        <div class="ui-kicker">Registro</div>
        <h1 class="display-font mt-5 text-4xl leading-tight text-[var(--brand-green-dark)]">Crear cuenta</h1>
        <p class="mt-3 text-sm leading-relaxed text-[var(--muted)]">
            Agrega tus datos para empezar a trabajar dentro del panel de Virelle.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="text-sm font-bold text-[var(--brand-green-dark)]">Nombre</label>
            <input id="name" class="ui-field mt-2 block w-full" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="text-sm font-bold text-[var(--brand-green-dark)]">Correo electronico</label>
            <input id="email" class="ui-field mt-2 block w-full" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="idperfil" class="text-sm font-bold text-[var(--brand-green-dark)]">Perfil</label>
            <select id="idperfil" name="idperfil" class="ui-field mt-2 block w-full" required>
                <option value="">Selecciona un perfil</option>
                @foreach (($perfiles ?? []) as $perfil)
                    <option value="{{ $perfil->id }}" {{ (string) old('idperfil') === (string) $perfil->id ? 'selected' : '' }}>
                        {{ $perfil->nombre }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('idperfil')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="text-sm font-bold text-[var(--brand-green-dark)]">Contrasena</label>

            <input id="password" class="ui-field mt-2 block w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="text-sm font-bold text-[var(--brand-green-dark)]">Confirmar contrasena</label>

            <input id="password_confirmation" class="ui-field mt-2 block w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-3 pt-2 sm:flex-row sm:items-center sm:justify-between">
            <a class="ui-button-secondary w-full sm:w-auto" href="{{ route('login') }}">
                Ya tengo cuenta
            </a>

            <button type="submit" class="ui-button-primary w-full sm:w-auto">
                Registrarme
            </button>
        </div>
    </form>
</x-guest-layout>
