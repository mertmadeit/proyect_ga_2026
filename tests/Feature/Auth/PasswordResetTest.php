<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_reset_password_link_screen_can_be_rendered(): void
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }

    public function test_reset_password_link_can_be_requested(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_reset_password_screen_can_be_rendered(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
            $response = $this->get('/reset-password/'.$notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    public function test_password_can_be_reset_with_valid_token(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $response = $this->post('/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response
                ->assertSessionHasNoErrors()
                ->assertRedirect(route('login'));

            return true;
        });
    }

    public function test_non_existing_email_returns_generic_success_message(): void
    {
        $response = $this->from('/forgot-password')->post('/forgot-password', [
            'email' => 'missing-user@example.test',
        ]);

        $response
            ->assertRedirect('/forgot-password')
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status', 'Si el correo esta registrado, enviaremos un enlace para recuperar la contrasena.')
            ->assertSessionMissing('reset_url');
    }

    public function test_local_log_mailer_exposes_reset_url_for_existing_user(): void
    {
        Config::set('app.env', 'local');
        Config::set('mail.default', 'log');
        Config::set('services.testmail.enabled', false);

        $user = User::factory()->create();

        $response = $this->from('/forgot-password')->post('/forgot-password', [
            'email' => $user->email,
        ]);

        $response
            ->assertRedirect('/forgot-password')
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status', 'Enlace de recuperacion generado.')
            ->assertSessionHas('mensaje', 'Modo local: abre el siguiente enlace para cambiar tu contrasena.')
            ->assertSessionHas('reset_url');
    }

    public function test_production_never_exposes_reset_url_when_smtp_fails(): void
    {
        Config::set('app.env', 'production');
        Config::set('app.debug', false);
        Config::set('mail.default', 'smtp');
        Config::set('services.testmail.enabled', false);

        $user = User::factory()->create();

        Password::shouldReceive('sendResetLink')
            ->once()
            ->andThrow(new \RuntimeException('SMTP is down'));

        $response = $this->from('/forgot-password')->post('/forgot-password', [
            'email' => $user->email,
        ]);

        $response
            ->assertRedirect('/forgot-password')
            ->assertSessionHasErrors('email')
            ->assertSessionMissing('reset_url');
    }

    public function test_throttle_status_is_returned_as_validation_error(): void
    {
        Config::set('app.env', 'local');
        Config::set('mail.default', 'smtp');
        Config::set('services.testmail.enabled', false);

        $user = User::factory()->create();

        Password::shouldReceive('sendResetLink')
            ->once()
            ->andReturn(\Illuminate\Support\Facades\Password::RESET_THROTTLED);

        $response = $this->from('/forgot-password')->post('/forgot-password', [
            'email' => $user->email,
        ]);

        $response
            ->assertRedirect('/forgot-password')
            ->assertSessionHasErrors([
                'email' => 'Espera unos segundos antes de volver a solicitar el enlace.',
            ])
            ->assertSessionMissing('reset_url');
    }
}
