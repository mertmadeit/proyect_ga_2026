<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Str::startsWith((string) config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        // Railway safety net: if APP_URL is HTTPS and a Resend key exists,
        // avoid falling back to MAIL_MAILER=log by mistake in production-like envs.
        if (
            Str::startsWith((string) config('app.url'), 'https://') &&
            filled((string) config('services.resend.key')) &&
            config('mail.default') === 'log'
        ) {
            Config::set('mail.default', 'resend');
        }
    }
}
