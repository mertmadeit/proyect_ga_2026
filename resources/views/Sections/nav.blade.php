<nav
    class="z-50 sticky top-4 w-full max-w-7xl mx-auto rounded-3xl border border-black/10 bg-white shadow-[var(--shadow-sm)]">
    @php
    $navLinks = [
    ['href' => url('/'), 'label' => 'Home'],
    ['href' => route('perfiles.index'), 'label' => 'Perfiles'],
    ['href' => route('clientes.index'), 'label' => 'Clientes'],
    ['href' => route('facturas.index'), 'label' => 'Facturas'],
    ['href' => '#contact', 'label' => 'Contact'],
    ];
    @endphp

    <div class="relative flex min-h-14 flex-wrap items-center gap-4 px-4 py-3 sm:min-h-16 sm:px-5">
            <div class="flex items-center gap-3">
                <div class="leading-tight">
                    <a href="{{ url('/') }}" class="text-lg font-semibold tracking-tight text-(--brand-green-dark)">Virelle</a>
                    <div class="text-xs text-(--muted)">Plantas & accesorios</div>
                </div>
            </div>
        <ul
            class="order-3 flex basis-full items-center justify-between gap-3 border-t border-black/5 pt-3 text-xs font-medium sm:text-sm md:absolute md:left-1/2 md:basis-auto md:-translate-x-1/2 md:justify-center md:gap-10 md:border-0 md:pt-0">
            @foreach ($navLinks as $link)
            <li class="flex-1 text-center md:flex-none">
                <a class="block px-2 py-1.5 rounded-md text-(--muted) hover:text-(--brand-green-dark) hover:bg-(--brand-sage) transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-(--brand-green)"
                    href="{{ $link['href'] }}">{{ $link['label'] }}</a>
            </li>
            @endforeach
        </ul>
        <div class="ml-auto flex shrink-0 items-center gap-2">
            <a class="inline-flex items-center justify-center gap-2 rounded-full border border-black/10 bg-(--card-bg) px-4 py-2 text-sm font-semibold text-(--brand-green-dark) shadow-sm transition-transform hover:-translate-y-0.5 hover:bg-(--brand-sage)"
                href="./register">
                <span>Registrarse</span>
            </a>
            <a class="inline-flex items-center justify-center gap-2 rounded-full bg-(--brand-sage) px-4 py-2 text-sm font-bold text-(--brand-green-dark) transition hover:bg-white"
                href="./login">
                <span>Iniciar sesión</span>
            </a>
        </div>
    </div>
</nav>
