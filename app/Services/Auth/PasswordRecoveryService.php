<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Throwable;

class PasswordRecoveryService
{
    private const GENERIC_SUCCESS_STATUS = 'Si el correo esta registrado, enviaremos un enlace para recuperar la contrasena.';

    public function sendResetLink(string $email): PasswordRecoveryResult
    {
        $email = mb_strtolower(trim($email));
        $user = User::where('email', $email)->first();

        if (! $user) {
            return PasswordRecoveryResult::success(self::GENERIC_SUCCESS_STATUS);
        }

        if ($this->isTestingEnvironment()) {
            return $this->sendThroughLaravelBroker($email);
        }

        if (Config::boolean('services.testmail.enabled')) {
            return $this->sendThroughTestmail($user);
        }

        if (Config::get('mail.default') === 'log') {
            if (! $this->canExposeResetUrl()) {
                return PasswordRecoveryResult::error(
                    'No se pudo enviar el correo. Configura MAIL_MAILER=resend y RESEND_KEY en variables de entorno.'
                );
            }

            return $this->localFallback(
                $user,
                'Modo local: abre el siguiente enlace para cambiar tu contrasena.'
            );
        }

        return $this->sendThroughLaravelBrokerWithFallback($user, $email);
    }

    private function sendThroughLaravelBroker(string $email): PasswordRecoveryResult
    {
        $status = Password::sendResetLink(['email' => $email]);

        if ($status === Password::RESET_LINK_SENT) {
            return PasswordRecoveryResult::success(__($status));
        }

        if ($status === Password::RESET_THROTTLED) {
            return PasswordRecoveryResult::error('Espera unos segundos antes de volver a solicitar el enlace.');
        }

        return PasswordRecoveryResult::error(__($status));
    }

    private function sendThroughTestmail(User $user): PasswordRecoveryResult
    {
        $namespace = (string) Config::get('services.testmail.namespace', '');
        $tag = (string) Config::get('services.testmail.tag', 'password-reset');

        if ($namespace === '') {
            if ($this->canExposeResetUrl()) {
                return $this->localFallback($user, 'Configura TESTMAIL_NAMESPACE en .env');
            }

            return PasswordRecoveryResult::error('No se pudo enviar el correo. Intenta de nuevo en unos minutos.');
        }

        $testmailAddress = "{$namespace}.{$tag}@inbox.testmail.app";
        $resetUrl = $this->makeResetUrl($user);
        $exposedResetUrl = $this->canExposeResetUrl() ? $resetUrl : null;

        if (Config::get('mail.default') === 'log') {
            if (! $this->canExposeResetUrl()) {
                return PasswordRecoveryResult::error(
                    'No se pudo enviar el correo. Configura MAIL_MAILER=resend y RESEND_KEY en variables de entorno.'
                );
            }

            return PasswordRecoveryResult::success(
                'Enlace de recuperacion generado.',
                "Modo local activo: usa el enlace de abajo. Si activas SMTP, el destino sera {$testmailAddress}.",
                $exposedResetUrl
            );
        }

        $fromAddress = (string) Config::get('mail.from.address', '');
        if (! filter_var($fromAddress, FILTER_VALIDATE_EMAIL)) {
            if ($this->canExposeResetUrl()) {
                return PasswordRecoveryResult::success(
                    'Enlace de recuperacion generado.',
                    'MAIL_FROM_ADDRESS no es valido. Usa el enlace de abajo mientras corriges el remitente SMTP.',
                    $exposedResetUrl
                );
            }

            return PasswordRecoveryResult::error('No se pudo enviar el correo. Intenta de nuevo en unos minutos.');
        }

        try {
            Mail::raw(
                "Password reset link for {$user->email}: {$resetUrl}",
                function ($message) use ($testmailAddress) {
                    $message->to($testmailAddress)
                        ->subject('Password Reset Link');
                }
            );
        } catch (Throwable $exception) {
            report($exception);

            if ($this->canExposeResetUrl()) {
                return PasswordRecoveryResult::success(
                    'Enlace de recuperacion generado.',
                    "No se pudo enviar por SMTP. Usa el enlace de abajo o revisa la configuracion del remitente. Destino esperado: {$testmailAddress}",
                    $exposedResetUrl
                );
            }

            return PasswordRecoveryResult::error('No se pudo enviar el correo. Intenta de nuevo en unos minutos.');
        }

        return PasswordRecoveryResult::success(
            'Reset enviado a Testmail.',
            "Revisa el inbox {$testmailAddress} en testmail.app",
            $exposedResetUrl
        );
    }

    private function sendThroughLaravelBrokerWithFallback(User $user, string $email): PasswordRecoveryResult
    {
        try {
            $status = Password::sendResetLink(['email' => $email]);
        } catch (Throwable $exception) {
            report($exception);

            if ($this->canExposeResetUrl() && Config::boolean('app.debug')) {
                return PasswordRecoveryResult::success(
                    'Enlace de recuperacion generado.',
                    $this->buildLocalFallbackMessage($exception),
                    $this->makeResetUrl($user)
                );
            }

            return PasswordRecoveryResult::error('No se pudo enviar el correo. Intenta de nuevo en unos minutos.');
        }

        if ($status === Password::RESET_LINK_SENT) {
            return PasswordRecoveryResult::success(__($status));
        }

        if ($status === Password::RESET_THROTTLED) {
            return PasswordRecoveryResult::error('Espera unos segundos antes de volver a solicitar el enlace.');
        }

        return PasswordRecoveryResult::error(__($status));
    }

    private function localFallback(User $user, string $message): PasswordRecoveryResult
    {
        return PasswordRecoveryResult::success(
            'Enlace de recuperacion generado.',
            $message,
            $this->canExposeResetUrl() ? $this->makeResetUrl($user) : null
        );
    }

    private function makeResetUrl(User $user): string
    {
        $token = Password::broker()->createToken($user);

        return route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ]);
    }

    private function isTestingEnvironment(): bool
    {
        return $this->environment() === 'testing';
    }

    private function canExposeResetUrl(): bool
    {
        return in_array($this->environment(), ['local', 'testing'], true);
    }

    private function environment(): string
    {
        return (string) Config::get('app.env', app()->environment());
    }

    private function buildLocalFallbackMessage(Throwable $exception): string
    {
        $message = $exception->getMessage();

        if (str_contains($message, 'cURL error 60')) {
            return 'No se pudo conectar con Resend desde este entorno local. Usa temporalmente el enlace de abajo mientras corriges SSL de PHP.';
        }

        if (str_contains($message, 'You can only send testing emails to your own email address')) {
            return 'Resend esta en modo de prueba: verifica un dominio en Resend y usa MAIL_FROM_ADDRESS de ese dominio para enviar a otros correos.';
        }

        return 'Resend rechazo el envio en este entorno local. Usa temporalmente el enlace de abajo y revisa configuracion de dominio/remitente.';
    }
}
