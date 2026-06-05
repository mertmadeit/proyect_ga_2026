<x-guest-layout>
    <div class="mb-7">
        <div class="ui-kicker">Verificacion</div>
        <h1 class="display-font mt-5 text-4xl leading-tight text-[var(--brand-green-dark)]">Revisa tu correo</h1>
        <p class="mt-3 text-sm leading-relaxed text-[var(--muted)]">
            Antes de entrar, confirma tu correo desde el enlace que acabamos de enviarte.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-5 rounded-[8px] border border-emerald-200 bg-emerald-50 p-3 text-sm font-bold text-emerald-900">
            Enviamos un nuevo enlace de verificacion a tu correo.
        </div>
    @endif

    <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    Reenviar correo
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="ui-button-secondary">
                Salir
            </button>
        </form>
    </div>
</x-guest-layout>
