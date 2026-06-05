<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Virelle - Panel</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="m-0 bg-[var(--bg)] text-[var(--text)] antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            @isset($header)
                <header class="ui-app-header mt-4">
                    <div class="ui-shell py-6">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="ui-shell py-8 sm:py-10">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
