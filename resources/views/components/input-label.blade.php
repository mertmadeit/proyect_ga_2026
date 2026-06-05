@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-bold text-[var(--brand-green-dark)]']) }}>
    {{ $value ?? $slot }}
</label>
