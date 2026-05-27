@extends('master')
@section('title','Bienvenido')
@section('content')
<section class="py-14 sm:py-20">
  <div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
    <div>
      <p class="text-xs font-semibold tracking-[0.22em] text-(--muted) uppercase">Virelle</p>
      <h1 class="mt-4 text-4xl font-semibold tracking-tight sm:text-5xl">Bienvenido</h1>
      <p class="mt-5 max-w-xl text-base leading-relaxed text-(--muted) sm:text-lg">Plantas y accesorios para un hogar minimalista, con recomendaciones simples para que las cuides sin complicarte.</p>
      <div class="mt-8 flex flex-wrap gap-3">
        <a href="{{ route('clientes.index') }}" class="inline-flex items-center justify-center rounded-full bg-(--brand-green) px-6 py-3 text-sm font-semibold text-white">Ver colección</a>
        <a href="{{ route('clientes.create') }}" class="inline-flex items-center justify-center rounded-full border border-black/10 bg-(--card-bg) px-6 py-3 text-sm font-semibold text-(--brand-green)">Contacto</a>
      </div>
    </div>
    <div aria-hidden="true" class="relative">
      <div class="rounded-3xl border border-black/10 bg-(--card-bg) p-10 sm:p-14">
        <div class="mx-auto h-24 w-24 rounded-full border border-black/10 bg-(--card-bg)"></div>
        <div class="mx-auto mt-8 h-2 w-44 rounded-full bg-black/5"></div>
        <div class="mx-auto mt-3 h-2 w-28 rounded-full bg-black/5"></div>
      </div>
    </div>
  </div>
</section>

<section class="py-12 sm:py-16">
  <div class="flex flex-wrap items-end justify-between gap-4">
    <div>
      <h2 class="text-2xl font-semibold tracking-tight">Productos destacados</h2>
      <p class="mt-2 text-sm text-(--muted) sm:text-base">Una selección corta para empezar bien.</p>
    </div>
  </div>

  <div class="mt-10 grid gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3">
    @php
    $items = [
      ['name'=>'Monstera Deliciosa','meta'=>'Interior · Luz indirecta','price'=>'$34.00'],
      ['name'=>'Sansevieria','meta'=>'Muy resistente · Poco riego','price'=>'$22.00'],
      ['name'=>'Pilea Peperomioides','meta'=>'Compacta · Crecimiento rápido','price'=>'$18.00'],
    ];
    @endphp

    @foreach($items as $it)
      <article class="rounded-2xl border border-black/10 bg-(--card-bg) p-6">
        <div class="h-36 rounded-xl bg-(--card-bg)"></div>
        <h3 class="mt-5 text-base font-semibold">{{ $it['name'] }}</h3>
        <p class="mt-1 text-sm text-(--muted)">{{ $it['meta'] }}</p>
        <div class="mt-6 flex items-center justify-between gap-4">
          <div class="text-base font-semibold text-(--brand-green)">{{ $it['price'] }}</div>
          <a class="inline-flex items-center justify-center rounded-full border border-black/10 bg-(--card-bg) px-4 py-2 text-sm font-semibold" href="mailto:contacto@virelle.com">Consultar</a>
        </div>
      </article>
    @endforeach
  </div>
</section>

@endsection
