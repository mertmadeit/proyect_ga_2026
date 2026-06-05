<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Virelle - Acceso</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css'])
    </head>
    <body class="m-0 bg-[var(--bg)] text-[var(--text)] antialiased">
        @include('Sections.nav')

        <main class="ui-shell py-10 sm:py-14">
            <div class="grid min-h-[calc(100vh-18rem)] items-center gap-8 lg:grid-cols-[0.95fr_1.05fr] lg:gap-14">
                <section class="hidden lg:block">
                    <div class="ui-panel overflow-hidden p-8">
                        <div class="ui-kicker">Virelle</div>
                        <h1 class="display-font mt-6 max-w-md text-5xl leading-tight text-[var(--brand-green-dark)]">Gestion vegetal sin ruido.</h1>
                        <p class="mt-5 max-w-md text-base leading-relaxed text-[var(--muted)]">
                            Accede a clientes, facturas y perfiles desde un espacio sobrio, pensado para vender y dar seguimiento.
                        </p>

                        <div class="mt-10 grid gap-4">
                            <div class="ui-photo h-72">
                                <img src="{{ asset('img/03.jpg') }}" alt="Camino verde Virelle" loading="lazy" decoding="async">
                            </div>
                            <div class="ui-data-card">
                                <p class="text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Sesion segura</p>
                                <p class="mt-2 text-sm leading-6 text-[var(--muted)]">Mantiene el acceso separado de la experiencia publica sin romper la identidad visual.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="w-full max-w-[540px] justify-self-center lg:justify-self-end">
                    <div class="mb-6 lg:hidden">
                        <div class="text-lg font-bold text-[var(--brand-green-dark)]">Virelle</div>
                        <p class="mt-1 text-sm text-[var(--muted)]">Plantas, accesorios y facturacion organizada.</p>
                    </div>

                    <div class="ui-panel p-6 sm:p-8">
                        {{ $slot }}
                    </div>
                </section>
            </div>
        </main>

        @include('Sections.footers')
    </body>
</html>
