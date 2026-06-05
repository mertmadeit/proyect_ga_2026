@extends('master')
@section('title', 'Inicio')
@section('content')
    <section class="ui-hero relative">
        <img
            src="https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&w=1400&q=75"
            alt="Plantas de interior en macetas de ceramica"
            fetchpriority="high"
            decoding="async"
            class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-[linear-gradient(90deg,rgba(16,23,17,.72)_0%,rgba(16,23,17,.46)_42%,rgba(16,23,17,.14)_100%)]"></div>

        <div class="relative flex min-h-[72vh] max-w-3xl flex-col justify-end px-6 pb-10 pt-32 sm:px-10 lg:pb-14">
            <p class="text-xs font-extrabold uppercase tracking-[0.08em] text-white/72">Atelier vegetal y gestion comercial</p>
            <h1 class="display-font mt-4 text-6xl leading-[.95] text-white sm:text-7xl lg:text-8xl">Virelle</h1>
            <p class="mt-5 max-w-2xl text-base leading-8 text-white/82 sm:text-lg">
                Plantas de interior, accesorios y facturacion en un mismo sistema: una tienda cuidada por fuera y ordenada por dentro.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="#destacados" class="ui-button-primary">Ver coleccion</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="ui-button-secondary">Abrir panel</a>
                @else
                    <a href="{{ route('register') }}" class="ui-button-secondary">Crear cuenta</a>
                @endauth
            </div>
        </div>
    </section>

    <section class="mt-8 grid gap-4 sm:grid-cols-3" aria-label="Resumen de Virelle">
        <article class="ui-data-card">
            <p class="text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Catalogo</p>
            <p class="mt-2 text-2xl font-extrabold text-[var(--brand-green-dark)]">38 variedades</p>
            <p class="mt-1 text-sm leading-6 text-[var(--muted)]">Interior, sombra luminosa y bajo mantenimiento.</p>
        </article>
        <article class="ui-data-card">
            <p class="text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Operacion</p>
            <p class="mt-2 text-2xl font-extrabold text-[var(--brand-green-dark)]">Clientes + facturas</p>
            <p class="mt-1 text-sm leading-6 text-[var(--muted)]">Datos comerciales listos para ventas repetidas.</p>
        </article>
        <article class="ui-data-card">
            <p class="text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Cuidado</p>
            <p class="mt-2 text-2xl font-extrabold text-[var(--brand-green-dark)]">Guia simple</p>
            <p class="mt-1 text-sm leading-6 text-[var(--muted)]">Recomendaciones claras para cada tipo de espacio.</p>
        </article>
    </section>

    <section id="destacados" class="mt-16">
        <div class="grid gap-8 lg:grid-cols-[.78fr_1.22fr] lg:items-end">
            <div>
                <span class="ui-kicker">Coleccion</span>
                <h2 class="display-font mt-3 text-4xl text-[var(--brand-ink)] sm:text-5xl">Plantas listas para entrar a casa.</h2>
            </div>
            <p class="text-sm leading-7 text-[var(--muted)]">
                Seleccion pensada para hogares y oficinas: piezas bonitas sin exigir rutinas imposibles. Cada venta puede enlazarse con cliente y factura desde el panel.
            </p>
        </div>

        @php
            $items = [
                ['name'=>'Monstera Deliciosa','meta'=>'Hojas amplias - Luz indirecta','price'=>'$34.00','image'=>'https://images.unsplash.com/photo-1614594975525-e45190c55d0b?auto=format&fit=crop&w=900&q=75'],
                ['name'=>'Sansevieria','meta'=>'Resistente - Poco riego','price'=>'$22.00','image'=>asset('img/sansevieria.jpg')],
                ['name'=>'Pilea Peperomioides','meta'=>'Compacta - Crecimiento rapido','price'=>'$18.00','image'=>'https://images.unsplash.com/photo-1601985705806-5b9a71f6004f?auto=format&fit=crop&w=900&q=75'],
            ];
        @endphp

        <div class="mt-8 grid gap-5 md:grid-cols-3">
            @foreach($items as $it)
                <article class="ui-card group">
                    <div class="h-72 overflow-hidden">
                        <img src="{{ $it['image'] }}" alt="{{ $it['name'] }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]" loading="lazy" decoding="async">
                    </div>
                    <div class="relative p-5">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Interior</p>
                                <h3 class="mt-2 text-xl font-extrabold">{{ $it['name'] }}</h3>
                            </div>
                            <span class="ui-chip">{{ $it['price'] }}</span>
                        </div>
                        <p class="mt-3 text-sm text-[var(--muted)]">{{ $it['meta'] }}</p>
                        <a class="ui-button-secondary mt-5 w-full" href="mailto:contacto@virelle.com">Consultar disponibilidad</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section id="cuidado" class="mt-16 grid gap-5 lg:grid-cols-[1.1fr_.9fr]">
        <div class="ui-panel p-6 sm:p-8">
            <span class="ui-kicker">Cuidado</span>
            <h2 class="display-font mt-3 text-4xl text-[var(--brand-ink)]">Una rutina que si se cumple.</h2>
            <div class="mt-8 grid gap-4 sm:grid-cols-3">
                <div>
                    <p class="text-3xl font-extrabold text-[var(--brand-clay)]">01</p>
                    <h3 class="mt-3 font-extrabold">Luz amable</h3>
                    <p class="mt-2 text-sm leading-6 text-[var(--muted)]">Cerca de ventana, lejos de sol directo fuerte.</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold text-[var(--brand-clay)]">02</p>
                    <h3 class="mt-3 font-extrabold">Riego medido</h3>
                    <p class="mt-2 text-sm leading-6 text-[var(--muted)]">Toca el sustrato antes de agregar agua.</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold text-[var(--brand-clay)]">03</p>
                    <h3 class="mt-3 font-extrabold">Revision semanal</h3>
                    <p class="mt-2 text-sm leading-6 text-[var(--muted)]">Hojas limpias, maceta estable y buen drenaje.</p>
                </div>
            </div>
        </div>

        <div class="ui-photo min-h-[360px]">
            <img src="{{ asset('img/03.jpg') }}" alt="Ruta verde como referencia natural de Virelle" loading="lazy" decoding="async">
        </div>
    </section>

    <section id="contact" class="mt-12 grid gap-5 lg:grid-cols-[.8fr_1.2fr] lg:items-stretch">
        <div class="ui-photo min-h-[300px]">
            <img src="{{ asset('img/02.jpg') }}" alt="Paisaje verde de referencia para la marca Virelle" loading="lazy" decoding="async">
        </div>
        <div class="ui-panel flex flex-col justify-between p-6 sm:p-8">
            <div>
                <span class="ui-kicker">Contacto</span>
                <h2 class="display-font mt-3 text-4xl text-[var(--brand-ink)]">Hablemos de tu proxima venta verde.</h2>
                <p class="mt-4 max-w-2xl text-sm leading-7 text-[var(--muted)]">
                    Para recomendaciones, pedidos y seguimiento comercial, deja el mensaje con el espacio, presupuesto y tipo de planta que buscas.
                </p>
            </div>
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="ui-button-primary" href="mailto:contacto@virelle.com">Escribenos</a>
                @auth
                    <a class="ui-button-secondary" href="{{ route('clientes.create') }}">Registrar cliente</a>
                @else
                    <a class="ui-button-secondary" href="{{ route('login') }}">Entrar al sistema</a>
                @endauth
            </div>
        </div>
    </section>
@endsection
