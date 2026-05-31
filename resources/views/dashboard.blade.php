<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Dashboard General') }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="mb-6 overflow-hidden rounded-2xl bg-gradient-to-r from-emerald-600 via-emerald-500 to-teal-500 p-6 text-white shadow-xl">
                <p class="text-sm uppercase tracking-[0.2em] text-emerald-50/90">Panel de Control</p>
                <h1 class="mt-2 text-3xl font-extrabold">Resumen Completo del Sistema</h1>
                <p class="mt-2 text-emerald-50/95">Visualiza todas las tablas en un solo lugar y navega a cada modulo operativo.</p>

                <div class="mt-5 flex flex-wrap gap-3">
                    <a href="{{ route('perfiles.index') }}" class="rounded-lg bg-white/95 px-4 py-2 text-sm font-semibold text-emerald-700 hover:bg-white">Perfiles</a>
                    <a href="{{ route('clientes.index') }}" class="rounded-lg bg-white/95 px-4 py-2 text-sm font-semibold text-emerald-700 hover:bg-white">Clientes</a>
                    <a href="{{ route('facturas.index') }}" class="rounded-lg bg-white/95 px-4 py-2 text-sm font-semibold text-emerald-700 hover:bg-white">Facturas</a>
                    <a href="{{ route('facturas.reporte') }}" class="rounded-lg border border-white/80 bg-white/20 px-4 py-2 text-sm font-semibold text-white hover:bg-white/30">Descargar Reporte PDF</a>
                </div>
            </section>

            <section class="mb-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <article class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-gray-500">Perfiles</p>
                    <p class="mt-2 text-3xl font-extrabold text-emerald-700 dark:text-emerald-400">{{ $stats['perfiles'] }}</p>
                </article>
                <article class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-gray-500">Usuarios</p>
                    <p class="mt-2 text-3xl font-extrabold text-sky-700 dark:text-sky-400">{{ $stats['usuarios'] }}</p>
                </article>
                <article class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-gray-500">Clientes</p>
                    <p class="mt-2 text-3xl font-extrabold text-indigo-700 dark:text-indigo-400">{{ $stats['clientes'] }}</p>
                </article>
                <article class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-gray-500">Facturas</p>
                    <p class="mt-2 text-3xl font-extrabold text-fuchsia-700 dark:text-fuchsia-400">{{ $stats['facturas'] }}</p>
                </article>
                <article class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-gray-500">Formas de Pago</p>
                    <p class="mt-2 text-3xl font-extrabold text-amber-700 dark:text-amber-400">{{ $stats['formas_pago'] }}</p>
                </article>
                <article class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-gray-500">Estados Factura</p>
                    <p class="mt-2 text-3xl font-extrabold text-lime-700 dark:text-lime-400">{{ $stats['estados_factura'] }}</p>
                </article>
                <article class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-gray-500">Productos</p>
                    <p class="mt-2 text-3xl font-extrabold text-violet-700 dark:text-violet-400">{{ $stats['productos'] }}</p>
                </article>
                <article class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-gray-500">Pedidos</p>
                    <p class="mt-2 text-3xl font-extrabold text-rose-700 dark:text-rose-400">{{ $stats['pedidos'] }}</p>
                </article>
            </section>

            <section class="mb-8 grid gap-4 md:grid-cols-3">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-gray-500">Facturacion Acumulada</p>
                    <p class="mt-2 text-2xl font-extrabold text-emerald-700 dark:text-emerald-400">${{ number_format($stats['facturacion_total'], 2) }}</p>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-gray-500">Inventario Total</p>
                    <p class="mt-2 text-2xl font-extrabold text-indigo-700 dark:text-indigo-400">{{ number_format($stats['inventario_total']) }} unidades</p>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-gray-500">Monto Total Pedidos</p>
                    <p class="mt-2 text-2xl font-extrabold text-rose-700 dark:text-rose-400">${{ number_format($stats['monto_pedidos'], 2) }}</p>
                </div>
            </section>

            <section class="space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Tabla: perfiles</h3>
                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-200 text-left text-xs uppercase tracking-[0.14em] text-gray-500 dark:border-gray-700">
                                    <th class="px-3 py-2">ID</th>
                                    <th class="px-3 py-2">Nombre</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 dark:text-gray-200">
                                @forelse ($tablas['perfiles'] as $perfil)
                                    <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                        <td class="px-3 py-2">{{ $perfil->id }}</td>
                                        <td class="px-3 py-2">{{ $perfil->nombre }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-3 py-3 text-gray-500">Sin datos.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="grid gap-6 xl:grid-cols-2">
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Tabla: users</h3>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="border-b border-gray-200 text-left text-xs uppercase tracking-[0.14em] text-gray-500 dark:border-gray-700">
                                        <th class="px-3 py-2">Usuario</th>
                                        <th class="px-3 py-2">Email</th>
                                        <th class="px-3 py-2">Perfil</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 dark:text-gray-200">
                                    @forelse ($tablas['usuarios'] as $usuario)
                                        <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                            <td class="px-3 py-2 font-semibold">{{ $usuario->name }}</td>
                                            <td class="px-3 py-2">{{ $usuario->email }}</td>
                                            <td class="px-3 py-2">{{ $usuario->perfil?->nombre ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-3 py-3 text-gray-500">Sin datos.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Tabla: clientes</h3>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="border-b border-gray-200 text-left text-xs uppercase tracking-[0.14em] text-gray-500 dark:border-gray-700">
                                        <th class="px-3 py-2">Nombre</th>
                                        <th class="px-3 py-2">RFC</th>
                                        <th class="px-3 py-2">Telefono</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 dark:text-gray-200">
                                    @forelse ($tablas['clientes'] as $cliente)
                                        <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                            <td class="px-3 py-2 font-semibold">{{ $cliente->nombre }}</td>
                                            <td class="px-3 py-2">{{ $cliente->rfc }}</td>
                                            <td class="px-3 py-2">{{ $cliente->telefono }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-3 py-3 text-gray-500">Sin datos.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="grid gap-6 xl:grid-cols-2">
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Tabla: formaspago</h3>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="border-b border-gray-200 text-left text-xs uppercase tracking-[0.14em] text-gray-500 dark:border-gray-700">
                                        <th class="px-3 py-2">ID</th>
                                        <th class="px-3 py-2">Nombre</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 dark:text-gray-200">
                                    @forelse ($tablas['formas_pago'] as $forma)
                                        <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                            <td class="px-3 py-2">{{ $forma->id }}</td>
                                            <td class="px-3 py-2">{{ $forma->nombre }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="px-3 py-3 text-gray-500">Sin datos.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Tabla: estadosfacturas</h3>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="border-b border-gray-200 text-left text-xs uppercase tracking-[0.14em] text-gray-500 dark:border-gray-700">
                                        <th class="px-3 py-2">ID</th>
                                        <th class="px-3 py-2">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 dark:text-gray-200">
                                    @forelse ($tablas['estados_factura'] as $estado)
                                        <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                            <td class="px-3 py-2">{{ $estado->id }}</td>
                                            <td class="px-3 py-2">{{ $estado->estado }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="px-3 py-3 text-gray-500">Sin datos.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Tabla: facturas</h3>
                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-200 text-left text-xs uppercase tracking-[0.14em] text-gray-500 dark:border-gray-700">
                                    <th class="px-3 py-2">Numero</th>
                                    <th class="px-3 py-2">Cliente</th>
                                    <th class="px-3 py-2">Forma Pago</th>
                                    <th class="px-3 py-2">Estado</th>
                                    <th class="px-3 py-2">Valor</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 dark:text-gray-200">
                                @forelse ($tablas['facturas'] as $factura)
                                    <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                        <td class="px-3 py-2 font-semibold">#{{ $factura->numero }}</td>
                                        <td class="px-3 py-2">{{ $factura->cliente?->nombre ?? '-' }}</td>
                                        <td class="px-3 py-2">{{ $factura->forma?->nombre ?? '-' }}</td>
                                        <td class="px-3 py-2">{{ $factura->estado?->estado ?? '-' }}</td>
                                        <td class="px-3 py-2">${{ number_format((float) $factura->valor, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-3 py-3 text-gray-500">Sin datos.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="grid gap-6 xl:grid-cols-2">
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Tabla: productos</h3>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="border-b border-gray-200 text-left text-xs uppercase tracking-[0.14em] text-gray-500 dark:border-gray-700">
                                        <th class="px-3 py-2">Nombre</th>
                                        <th class="px-3 py-2">Precio</th>
                                        <th class="px-3 py-2">Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 dark:text-gray-200">
                                    @forelse ($tablas['productos'] as $producto)
                                        <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                            <td class="px-3 py-2 font-semibold">{{ $producto->nombre }}</td>
                                            <td class="px-3 py-2">${{ number_format((float) $producto->precio, 2) }}</td>
                                            <td class="px-3 py-2">{{ $producto->cantidad }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-3 py-3 text-gray-500">Sin datos.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Tabla: pedidos</h3>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="border-b border-gray-200 text-left text-xs uppercase tracking-[0.14em] text-gray-500 dark:border-gray-700">
                                        <th class="px-3 py-2">Nombre</th>
                                        <th class="px-3 py-2">Cantidad</th>
                                        <th class="px-3 py-2">Precio</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 dark:text-gray-200">
                                    @forelse ($tablas['pedidos'] as $pedido)
                                        <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                            <td class="px-3 py-2 font-semibold">{{ $pedido->nombre }}</td>
                                            <td class="px-3 py-2">{{ $pedido->cantidad }}</td>
                                            <td class="px-3 py-2">${{ number_format((float) $pedido->precio, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-3 py-3 text-gray-500">Sin datos.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
