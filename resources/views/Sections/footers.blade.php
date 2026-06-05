<footer role="contentinfo" class="mt-20 border-t border-black/5 bg-white/35">
  <div class="ui-shell py-12 sm:py-16">
    <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr_1fr]">
      <div>
        <div class="text-lg font-bold text-[var(--brand-green-dark)]">Virelle</div>
        <p class="mt-2 max-w-sm text-sm leading-relaxed text-[var(--muted)]">Plantas, accesorios y facturacion organizada para una operacion clara.</p>
        <p class="mt-5 text-sm text-[var(--muted)]">Contacto: <a class="font-bold text-[var(--brand-green-dark)]" href="mailto:contacto@virelle.com">contacto@virelle.com</a></p>
      </div>

      <div>
        <div class="text-xs font-bold uppercase tracking-[0.24em] text-[var(--muted)]">Gestion</div>
        <nav aria-label="Enlaces de pie de pagina" class="mt-4 grid gap-2">
          <a href="{{ route('clientes.index') }}" class="text-sm text-[var(--muted)] hover:text-[var(--text)]">Clientes</a>
          <a href="{{ route('facturas.index') }}" class="text-sm text-[var(--muted)] hover:text-[var(--text)]">Facturas</a>
          <a href="{{ route('perfiles.index') }}" class="text-sm text-[var(--muted)] hover:text-[var(--text)]">Perfiles</a>
        </nav>
      </div>

      <div class="lg:text-right">
        <div class="text-xs font-bold uppercase tracking-[0.24em] text-[var(--muted)]">Tienda</div>
        <div class="mt-4 flex flex-wrap gap-x-6 gap-y-2 lg:justify-end">
          <a href="{{ url('/#destacados') }}" class="text-sm text-[var(--muted)] hover:text-[var(--text)]">Coleccion</a>
          <a href="{{ url('/#cuidado') }}" class="text-sm text-[var(--muted)] hover:text-[var(--text)]">Guia</a>
          <a href="{{ url('/#contact') }}" class="text-sm text-[var(--muted)] hover:text-[var(--text)]">Contacto</a>
        </div>
      </div>
    </div>

    <div class="mt-10 text-center text-xs uppercase tracking-[0.24em] text-[var(--muted)]">
      &copy; 2026 Virelle. Todos los derechos reservados.
    </div>
  </div>
</footer>
