@extends('master')
@section('title', 'Inicio')
@section('content')
    <section class="relative overflow-hidden rounded-[28px] border border-black/5 bg-white shadow-[var(--shadow-soft)]">
        <div class="absolute inset-x-0 top-0 h-24 bg-[linear-gradient(90deg,rgba(223,233,216,.75),rgba(255,255,255,.35),rgba(184,112,86,.16))]"></div>

        <div class="relative grid gap-10 p-5 sm:p-8 lg:grid-cols-[1.02fr_.98fr] lg:p-10">
            <div class="flex min-h-[620px] flex-col justify-center py-8 lg:py-12">
                <span class="ui-kicker">Virelle Atelier</span>

                <h1 class="display-font mt-7 max-w-3xl text-5xl leading-[.98] text-(--brand-ink) sm:text-6xl lg:text-7xl">
                    Plantas listas para elevar cualquier espacio.
                </h1>
                <p class="mt-6 max-w-2xl text-base leading-8 text-(--muted) sm:text-lg">
                    Una tienda vegetal con catalogo claro, cuidado simple y gestion de clientes y facturas en una experiencia mas ordenada.
                </p>

                <div class="mt-9 flex flex-wrap gap-3">
                    <a href="#destacados" class="ui-button-primary">Ver coleccion</a>
                    <a href="{{ route('facturas.create') }}" class="ui-button-secondary">Registrar venta</a>
                </div>

                <div class="mt-12 grid max-w-2xl gap-3 sm:grid-cols-3">
                    <div class="ui-card p-5">
                        <p class="text-2xl font-extrabold text-(--brand-green-dark)">38+</p>
                        <p class="mt-1 text-xs leading-5 text-(--muted)">Variedades listas para venta</p>
                    </div>
                    <div class="ui-card p-5">
                        <p class="text-2xl font-extrabold text-(--brand-green-dark)">24h</p>
                        <p class="mt-1 text-xs leading-5 text-(--muted)">Respuesta comercial</p>
                    </div>
                    <div class="ui-card p-5">
                        <p class="text-2xl font-extrabold text-(--brand-green-dark)">4.9</p>
                        <p class="mt-1 text-xs leading-5 text-(--muted)">Satisfaccion promedio</p>
                    </div>
                </div>
            </div>

            <div class="grid min-h-[620px] gap-4 lg:grid-rows-[1fr_auto]">
                <div class="relative overflow-hidden rounded-[24px] bg-(--brand-green-dark)">
                    <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1400&q=82" alt="Interior con plantas Virelle" class="absolute inset-0 h-full w-full object-cover opacity-95">
                    <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(15,23,20,0)_35%,rgba(15,23,20,.55)_100%)]"></div>
                    <div class="absolute left-5 right-5 bottom-5 rounded-[20px] border border-white/20 bg-white/88 p-5 shadow-[0_20px_55px_rgba(0,0,0,.16)] backdrop-blur">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs font-extrabold uppercase tracking-[0.16em] text-(--muted)">Seleccion 2026</p>
                                <h2 class="mt-2 text-xl font-extrabold text-(--brand-green-dark)">Interior resistente</h2>
                            </div>
                            <span class="ui-chip">$22+</span>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-(--muted)">Piezas pensadas para luz indirecta, bajo mantenimiento y espacios modernos.</p>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <a href="{{ route('clientes.index') }}" class="ui-card group block p-5 transition hover:-translate-y-0.5">
                        <p class="text-xs font-extrabold uppercase tracking-[0.16em] text-(--muted)">Operacion</p>
                        <div class="mt-3 flex items-center justify-between gap-4">
                            <h3 class="text-lg font-extrabold">Clientes</h3>
                            <span class="ui-chip">Abrir</span>
                        </div>
                    </a>
                    <a href="{{ route('facturas.index') }}" class="ui-card group block p-5 transition hover:-translate-y-0.5">
                        <p class="text-xs font-extrabold uppercase tracking-[0.16em] text-(--muted)">Control</p>
                        <div class="mt-3 flex items-center justify-between gap-4">
                            <h3 class="text-lg font-extrabold">Facturas</h3>
                            <span class="ui-chip">Abrir</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-12 grid gap-5 sm:grid-cols-3" aria-label="Beneficios">
        <article class="ui-card p-6">
            <span class="ui-chip">01</span>
            <h2 class="mt-5 text-lg font-extrabold">Catalogo limpio</h2>
            <p class="mt-2 text-sm leading-6 text-(--muted)">Productos faciles de explorar, con precio y atributos visibles al instante.</p>
        </article>
        <article class="ui-card p-6">
            <span class="ui-chip">02</span>
            <h2 class="mt-5 text-lg font-extrabold">Gestion rapida</h2>
            <p class="mt-2 text-sm leading-6 text-(--muted)">Accesos directos a clientes, perfiles y facturas sin perder contexto.</p>
        </article>
        <article class="ui-card p-6">
            <span class="ui-chip">03</span>
            <h2 class="mt-5 text-lg font-extrabold">Cuidado claro</h2>
            <p class="mt-2 text-sm leading-6 text-(--muted)">Recomendaciones sencillas para que cada planta llegue y permanezca bien.</p>
        </article>
    </section>

    <section id="destacados" class="mt-16">
        <div class="flex flex-wrap items-end justify-between gap-5">
            <div>
                <span class="ui-kicker">Coleccion</span>
                <h2 class="display-font mt-3 text-4xl text-(--brand-ink)">Destacados curados</h2>
                <p class="mt-2 text-sm text-(--muted)">Piezas faciles de cuidar y listas para vender.</p>
            </div>
            <a href="{{ route('clientes.create') }}" class="ui-button-secondary">Nuevo cliente</a>
        </div>

        @php
            $items = [
                ['name'=>'Monstera Deliciosa','meta'=>'Interior - Luz indirecta','price'=>'$34.00','image'=>'https://images.unsplash.com/photo-1446071103084-c257b5f70672?auto=format&fit=crop&w=1200&q=82'],
                ['name'=>'Sansevieria','meta'=>'Muy resistente - Poco riego','price'=>'$22.00','image'=>'https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1200&q=82'],
                ['name'=>'Pilea Peperomioides','meta'=>'Compacta - Crecimiento rapido','price'=>'$18.00','image'=>'https://images.unsplash.com/photo-1459666644539-a9755287d6b0?auto=format&fit=crop&w=1200&q=82'],
            ];
        @endphp

        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($items as $it)
                <article class="ui-card group overflow-hidden">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $it['image'] }}" alt="{{ $it['name'] }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.04]" loading="lazy">
                        <span class="ui-chip absolute right-4 top-4">{{ $it['price'] }}</span>
                    </div>
                    <div class="p-6">
                        <p class="text-xs font-extrabold uppercase tracking-[0.16em] text-(--muted)">Planta de interior</p>
                        <h3 class="mt-2 text-xl font-extrabold">{{ $it['name'] }}</h3>
                        <p class="mt-2 text-sm text-(--muted)">{{ $it['meta'] }}</p>
                        <a class="ui-button-secondary mt-6 w-full" href="{{ route('clientes.create') }}">Consultar</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section id="cuidado" class="mt-16 overflow-hidden rounded-[28px] bg-(--brand-green-dark) text-white shadow-[var(--shadow-soft)]">
        <div class="grid gap-8 p-6 sm:p-8 lg:grid-cols-[.85fr_1.15fr] lg:p-10">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-white/60">Ritual</p>
                <h2 class="display-font mt-3 text-4xl">Guia de cuidado</h2>
                <p class="mt-4 text-sm leading-7 text-white/72">Tres reglas simples para plantas de interior, redactadas para vender mejor y cuidar sin complicaciones.</p>
            </div>
            <div class="grid gap-4 sm:grid-cols-3">
                <div class="rounded-[18px] border border-white/10 bg-white/8 p-5">
                    <span class="ui-chip">01</span>
                    <h3 class="mt-5 font-extrabold">Luz</h3>
                    <p class="mt-2 text-sm leading-6 text-white/72">Cerca de ventana, sin sol directo fuerte.</p>
                </div>
                <div class="rounded-[18px] border border-white/10 bg-white/8 p-5">
                    <span class="ui-chip">02</span>
                    <h3 class="mt-5 font-extrabold">Riego</h3>
                    <p class="mt-2 text-sm leading-6 text-white/72">Deja secar la capa superior antes de regar.</p>
                </div>
                <div class="rounded-[18px] border border-white/10 bg-white/8 p-5">
                    <span class="ui-chip">03</span>
                    <h3 class="mt-5 font-extrabold">Rutina</h3>
                    <p class="mt-2 text-sm leading-6 text-white/72">Revisa hojas y sustrato una vez por semana.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="ui-card mt-12 p-6 sm:p-8">
        <div class="flex flex-wrap items-center justify-between gap-6">
            <div>
                <span class="ui-kicker">Atencion personal</span>
                <h2 class="display-font mt-3 text-4xl">Te ayudamos a elegir.</h2>
                <p class="mt-2 max-w-2xl text-sm leading-7 text-(--muted)">Cuentanos tu espacio, luz disponible y tamano ideal. Te recomendamos opciones concretas.</p>
            </div>
            <a class="ui-button-primary" href="mailto:contacto@virelle.com">Escribenos</a>
        </div>
    </section>
@endsection
