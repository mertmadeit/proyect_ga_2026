<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-extrabold uppercase tracking-[0.08em] text-[var(--muted)]">Cuenta</p>
            <h1 class="display-font mt-2 text-4xl text-[var(--brand-green-dark)]">Perfil</h1>
        </div>
    </x-slot>

    <div class="grid gap-6 lg:grid-cols-[1fr_.82fr]">
        <div class="space-y-6">
            <div class="ui-panel p-6 sm:p-8">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="ui-panel p-6 sm:p-8">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <aside class="ui-panel h-fit p-6 sm:p-8">
            @include('profile.partials.delete-user-form')
        </aside>
    </div>
</x-app-layout>
