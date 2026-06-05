@php
    $mensajeInfo = session('mensaje');
    $mensajeOk = session('success');
    $mensajeError = session('error');
@endphp

@if ($mensajeInfo)
    <div class="mb-5 rounded-[12px] border border-amber-200 bg-amber-50 px-4 py-3 text-sm font-medium text-amber-900">
        {{ $mensajeInfo }}
    </div>
@endif

@if ($mensajeOk)
    <div class="mb-5 rounded-[12px] border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
        {{ $mensajeOk }}
    </div>
@endif

@if ($mensajeError)
    <div class="mb-5 rounded-[12px] border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
        {{ $mensajeError }}
    </div>
@endif
