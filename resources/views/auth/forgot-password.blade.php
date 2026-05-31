<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @if (session('mensaje'))
        <div class="mb-4 rounded-md border border-amber-300 bg-amber-50 p-3 text-sm text-amber-900">
            {{ session('mensaje') }}
        </div>
    @endif
    @if (session('reset_url'))
        <div class="mb-4 rounded-md border border-emerald-300 bg-emerald-50 p-3 text-sm text-emerald-900">
            <p class="font-semibold">Enlace de recuperacion:</p>
            <a class="mt-1 block break-all underline" href="{{ session('reset_url') }}">{{ session('reset_url') }}</a>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
