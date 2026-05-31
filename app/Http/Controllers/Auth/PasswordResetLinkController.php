<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\PasswordRecoveryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    public function __construct(
        private readonly PasswordRecoveryService $passwordRecoveryService
    ) {
    }

    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $result = $this->passwordRecoveryService->sendResetLink((string) $request->input('email'));

        $response = back();

        if ($result->showEmailError) {
            $response = $response
                ->withInput($request->only('email'))
                ->withErrors(['email' => $result->status]);
        } else {
            $response = $response->with('status', $result->status);
        }

        if ($result->message !== null) {
            $response = $response->with('mensaje', $result->message);
        }

        if ($result->resetUrl !== null) {
            $response = $response->with('reset_url', $result->resetUrl);
        }

        return $response;
    }
}
