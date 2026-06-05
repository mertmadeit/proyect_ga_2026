<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <title>Virelle - Venta de plantas - @yield('title')</title>
</head>
<body class="m-0 bg-[var(--bg)] text-[var(--text)] antialiased">
    @include('Sections.nav')

    <main class="ui-shell py-8 sm:py-10">
        @include('Sections.mensajes')
        @yield('content')
    </main>

    @include('Sections.footers')

    @yield('scripts')
</body>
</html>
