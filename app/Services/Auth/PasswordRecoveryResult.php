<?php

namespace App\Services\Auth;

final class PasswordRecoveryResult
{
    public function __construct(
        public readonly bool $successful,
        public readonly string $status,
        public readonly ?string $message = null,
        public readonly ?string $resetUrl = null,
        public readonly bool $showEmailError = false,
    ) {
    }

    public static function success(string $status, ?string $message = null, ?string $resetUrl = null): self
    {
        return new self(true, $status, $message, $resetUrl);
    }

    public static function error(string $status, ?string $message = null): self
    {
        return new self(false, $status, $message, null, true);
    }
}
