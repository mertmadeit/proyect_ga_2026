<section class="space-y-6">
    <header>
        <h2 class="text-xl font-extrabold text-[var(--brand-green-dark)]">Zona delicada</h2>

        <p class="mt-2 text-sm leading-6 text-[var(--muted)]">
            Eliminar la cuenta borra el acceso y los datos asociados. Usalo solo si ya no necesitas operar en Virelle.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Eliminar cuenta</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-xl font-extrabold text-[var(--brand-green-dark)]">
                Confirmar eliminacion
            </h2>

            <p class="mt-2 text-sm leading-6 text-[var(--muted)]">
                Escribe tu contrasena para confirmar que quieres eliminar definitivamente esta cuenta.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Contrasena"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Eliminar cuenta
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
