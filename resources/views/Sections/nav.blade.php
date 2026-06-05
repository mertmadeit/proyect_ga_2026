<nav class="brand-nav">
    @php
        $navLinks = [
            ['href' => url('/'), 'label' => 'Inicio'],
            ['href' => url('/#destacados'), 'label' => 'Coleccion'],
            ['href' => url('/#cuidado'), 'label' => 'Cuidado'],
            ['href' => url('/#contact'), 'label' => 'Contacto'],
        ];
    @endphp

    <div class="flex flex-wrap items-center gap-3 px-3 py-3 sm:px-4">
        <a href="{{ url('/') }}" class="flex items-center gap-3">
            <span class="brand-mark">V</span>
            <span class="leading-tight">
                <span class="block text-base font-extrabold text-[var(--brand-green-dark)]">Virelle</span>
                <span class="block text-xs font-semibold text-[var(--muted)]">Plantas y gestion comercial</span>
            </span>
        </a>

        <div class="order-3 flex w-full flex-wrap gap-1 border-t border-black/5 pt-3 md:order-none md:ml-8 md:w-auto md:border-0 md:pt-0">
            @foreach ($navLinks as $link)
                <a class="brand-link {{ url()->current() === $link['href'] ? 'is-active' : '' }}"
                    href="{{ $link['href'] }}">{{ $link['label'] }}</a>
            @endforeach
        </div>

        <div class="brand-actions ml-auto shrink-0">
            @auth
                <a class="ui-button-secondary" href="{{ route('dashboard') }}">Panel</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="ui-button-primary">Salir</button>
                </form>
            @else
                <a class="ui-button-secondary" href="{{ route('register') }}">Registro</a>
                <a class="ui-button-primary" href="{{ route('login') }}">Entrar</a>
            @endauth
        </div>
    </div>
</nav>
