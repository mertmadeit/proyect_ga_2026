<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-extrabold tracking-tight text-[var(--brand-green-dark)]">Dashboard</h1>
                <p class="mt-1 text-sm text-[var(--muted)]">Vista rapida de ventas, clientes e inventario.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('clientes.create') }}" class="ui-button-secondary">Nuevo cliente</a>
                <a href="{{ route('facturas.index') }}" class="ui-button-primary">Ver facturas</a>
            </div>
        </div>
    </x-slot>

    @php
        $ticketPromedio = $stats['facturas'] > 0
            ? $stats['facturacion_total'] / $stats['facturas']
            : 0;

        $topMetrics = [
            ['label' => 'Facturacion', 'value' => '$' . number_format($stats['facturacion_total'], 2), 'meta' => 'total acumulado'],
            ['label' => 'Ticket promedio', 'value' => '$' . number_format($ticketPromedio, 2), 'meta' => 'por factura'],
            ['label' => 'Clientes', 'value' => number_format($stats['clientes']), 'meta' => 'registrados'],
            ['label' => 'Inventario', 'value' => number_format($stats['inventario_total']), 'meta' => 'unidades'],
        ];

        $systemMetrics = [
            ['label' => 'Usuarios', 'value' => $stats['usuarios']],
            ['label' => 'Perfiles', 'value' => $stats['perfiles']],
            ['label' => 'Productos', 'value' => $stats['productos']],
            ['label' => 'Pedidos', 'value' => $stats['pedidos']],
            ['label' => 'Formas de pago', 'value' => $stats['formas_pago']],
            ['label' => 'Estados factura', 'value' => $stats['estados_factura']],
        ];
    @endphp

    <section class="grid gap-3 md:grid-cols-4">
        @foreach ($topMetrics as $metric)
            <article class="ui-metric">
                <p class="text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">{{ $metric['label'] }}</p>
                <strong class="mt-3 block text-2xl font-extrabold">{{ $metric['value'] }}</strong>
                <p class="mt-1 text-xs font-semibold text-[var(--muted)]">{{ $metric['meta'] }}</p>
            </article>
        @endforeach
    </section>

    <section class="mt-5 grid gap-5 xl:grid-cols-[1.05fr_.95fr]">
        <div class="ui-panel p-5">
            <div class="flex items-center justify-between gap-4 border-b border-black/5 pb-4">
                <div>
                    <h2 class="text-base font-extrabold text-[var(--brand-green-dark)]">Operacion</h2>
                    <p class="mt-1 text-sm text-[var(--muted)]">Accesos frecuentes para el dia a dia.</p>
                </div>
                <a href="{{ route('facturas.reporte') }}" class="ui-button-secondary">Reporte PDF</a>
            </div>

            <div class="mt-4 grid gap-3 sm:grid-cols-3">
                <a href="{{ route('clientes.index') }}" class="block rounded-[8px] border border-black/10 bg-white px-4 py-4 transition hover:bg-[var(--surface)]">
                    <p class="text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">01</p>
                    <p class="mt-2 font-extrabold text-[var(--brand-green-dark)]">Clientes</p>
                    <p class="mt-1 text-sm text-[var(--muted)]">Alta y consulta.</p>
                </a>
                <a href="{{ route('facturas.index') }}" class="block rounded-[8px] border border-black/10 bg-white px-4 py-4 transition hover:bg-[var(--surface)]">
                    <p class="text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">02</p>
                    <p class="mt-2 font-extrabold text-[var(--brand-green-dark)]">Facturas</p>
                    <p class="mt-1 text-sm text-[var(--muted)]">Montos y PDFs.</p>
                </a>
                <a href="{{ route('perfiles.index') }}" class="block rounded-[8px] border border-black/10 bg-white px-4 py-4 transition hover:bg-[var(--surface)]">
                    <p class="text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">03</p>
                    <p class="mt-2 font-extrabold text-[var(--brand-green-dark)]">Perfiles</p>
                    <p class="mt-1 text-sm text-[var(--muted)]">Roles de usuario.</p>
                </a>
            </div>
        </div>

        <div class="ui-panel p-5">
            <div class="border-b border-black/5 pb-4">
                <h2 class="text-base font-extrabold text-[var(--brand-green-dark)]">Sistema</h2>
                <p class="mt-1 text-sm text-[var(--muted)]">Conteo general por modulo.</p>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3">
                @foreach ($systemMetrics as $metric)
                    <div class="rounded-[8px] border border-black/10 bg-white px-4 py-3">
                        <p class="text-xs font-bold text-[var(--muted)]">{{ $metric['label'] }}</p>
                        <p class="mt-1 text-xl font-extrabold text-[var(--brand-green-dark)]">{{ $metric['value'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mt-5 grid gap-5 xl:grid-cols-[1.15fr_.85fr]">
        <div class="ui-panel overflow-hidden">
            <div class="flex items-center justify-between gap-4 border-b border-black/5 px-5 py-4">
                <div>
                    <h2 class="text-base font-extrabold text-[var(--brand-green-dark)]">Facturas recientes</h2>
                    <p class="mt-1 text-xs text-[var(--muted)]">Ultimos documentos registrados.</p>
                </div>
                <a href="{{ route('facturas.index') }}" class="text-sm font-extrabold text-[var(--brand-green-dark)]">Abrir</a>
            </div>
            <div class="overflow-x-auto">
                <table class="ui-table min-w-full divide-y divide-black/5">
                    <thead class="bg-[var(--surface)]">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">No.</th>
                            <th class="px-5 py-3 text-left text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Cliente</th>
                            <th class="px-5 py-3 text-left text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Forma</th>
                            <th class="px-5 py-3 text-left text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Estado</th>
                            <th class="px-5 py-3 text-right text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Valor</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/5 bg-white">
                        @forelse ($tablas['facturas'] as $factura)
                            <tr>
                                <td class="px-5 py-3 text-sm font-bold">#{{ $factura->numero }}</td>
                                <td class="px-5 py-3 text-sm text-[var(--muted)]">{{ $factura->cliente?->nombre ?? '-' }}</td>
                                <td class="px-5 py-3 text-sm text-[var(--muted)]">{{ $factura->forma?->nombre ?? '-' }}</td>
                                <td class="px-5 py-3 text-sm text-[var(--muted)]">{{ $factura->estado?->estado ?? '-' }}</td>
                                <td class="px-5 py-3 text-right text-sm font-extrabold text-[var(--brand-green-dark)]">${{ number_format((float) $factura->valor, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="ui-empty px-5 py-10 text-center text-sm text-[var(--muted)]">Sin facturas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="ui-panel overflow-hidden">
            <div class="flex items-center justify-between gap-4 border-b border-black/5 px-5 py-4">
                <div>
                    <h2 class="text-base font-extrabold text-[var(--brand-green-dark)]">Clientes recientes</h2>
                    <p class="mt-1 text-xs text-[var(--muted)]">Contactos mas nuevos.</p>
                </div>
                <a href="{{ route('clientes.index') }}" class="text-sm font-extrabold text-[var(--brand-green-dark)]">Abrir</a>
            </div>
            <div class="divide-y divide-black/5 bg-white">
                @forelse ($tablas['clientes'] as $cliente)
                    <div class="px-5 py-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-extrabold text-[var(--text)]">{{ $cliente->nombre }}</p>
                                <p class="mt-1 text-xs text-[var(--muted)]">{{ $cliente->email }}</p>
                            </div>
                            <span class="ui-chip">{{ $cliente->rfc }}</span>
                        </div>
                        <p class="mt-2 text-sm text-[var(--muted)]">{{ $cliente->telefono }}</p>
                    </div>
                @empty
                    <div class="ui-empty px-5 py-10 text-center text-sm text-[var(--muted)]">Sin clientes registrados.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="mt-5 grid gap-5 xl:grid-cols-2">
        <div class="ui-panel overflow-hidden">
            <div class="border-b border-black/5 px-5 py-4">
                <h2 class="text-base font-extrabold text-[var(--brand-green-dark)]">Inventario</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="ui-table min-w-full divide-y divide-black/5">
                    <thead class="bg-[var(--surface)]">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Producto</th>
                            <th class="px-5 py-3 text-right text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Precio</th>
                            <th class="px-5 py-3 text-right text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Stock</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/5 bg-white">
                        @forelse ($tablas['productos'] as $producto)
                            <tr>
                                <td class="px-5 py-3 text-sm font-bold">{{ $producto->nombre }}</td>
                                <td class="px-5 py-3 text-right text-sm text-[var(--muted)]">${{ number_format((float) $producto->precio, 2) }}</td>
                                <td class="px-5 py-3 text-right text-sm font-bold text-[var(--brand-green-dark)]">{{ $producto->cantidad }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="ui-empty px-5 py-10 text-center text-sm text-[var(--muted)]">Sin productos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="ui-panel overflow-hidden">
            <div class="border-b border-black/5 px-5 py-4">
                <h2 class="text-base font-extrabold text-[var(--brand-green-dark)]">Pedidos recientes</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="ui-table min-w-full divide-y divide-black/5">
                    <thead class="bg-[var(--surface)]">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Pedido</th>
                            <th class="px-5 py-3 text-right text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Cantidad</th>
                            <th class="px-5 py-3 text-right text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Monto</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/5 bg-white">
                        @forelse ($tablas['pedidos'] as $pedido)
                            <tr>
                                <td class="px-5 py-3 text-sm font-bold">{{ $pedido->nombre }}</td>
                                <td class="px-5 py-3 text-right text-sm text-[var(--muted)]">{{ $pedido->cantidad }}</td>
                                <td class="px-5 py-3 text-right text-sm font-bold text-[var(--brand-green-dark)]">${{ number_format((float) $pedido->precio, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="ui-empty px-5 py-10 text-center text-sm text-[var(--muted)]">Sin pedidos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>
