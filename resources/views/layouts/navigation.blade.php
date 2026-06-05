<nav x-data="{ open: false }" class="brand-nav">
    @php
        $links = [
            ['href' => route('dashboard'), 'label' => 'Panel', 'active' => request()->routeIs('dashboard')],
            ['href' => route('clientes.index'), 'label' => 'Clientes', 'active' => request()->routeIs('clientes.*')],
            ['href' => route('facturas.index'), 'label' => 'Facturas', 'active' => request()->routeIs('facturas.*')],
            ['href' => route('perfiles.index'), 'label' => 'Perfiles', 'active' => request()->routeIs('perfiles.*')],
        ];
    @endphp

    <div class="flex flex-wrap items-center gap-3 px-3 py-3 sm:px-4">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <span class="brand-mark">V</span>
            <span class="leading-tight">
                <span class="block text-base font-extrabold text-[var(--brand-green-dark)]">Virelle</span>
                <span class="block text-xs font-semibold text-[var(--muted)]">Panel comercial</span>
            </span>
        </a>

        <button type="button" class="brand-link ml-auto md:hidden" @click="open = ! open" aria-label="Abrir menu">
            Menu
        </button>

        <div class="hidden flex-wrap gap-1 md:ml-8 md:flex">
            @foreach ($links as $link)
                <a class="brand-link {{ $link['active'] ? 'is-active' : '' }}" href="{{ $link['href'] }}">{{ $link['label'] }}</a>
            @endforeach
        </div>

        <div class="brand-actions ml-auto hidden md:flex">
            <a class="brand-link" href="{{ route('profile.edit') }}">{{ Auth::user()->name }}</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="ui-button-secondary">Salir</button>
            </form>
        </div>

        <div x-show="open" x-cloak class="order-3 w-full border-t border-black/5 pt-3 md:hidden">
            <div class="grid gap-1">
                @foreach ($links as $link)
                    <a class="brand-link {{ $link['active'] ? 'is-active' : '' }}" href="{{ $link['href'] }}">{{ $link['label'] }}</a>
                @endforeach
                <a class="brand-link" href="{{ route('profile.edit') }}">Perfil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="ui-button-secondary mt-2">Salir</button>
                </form>
            </div>
        </div>
    </div>
</nav>
