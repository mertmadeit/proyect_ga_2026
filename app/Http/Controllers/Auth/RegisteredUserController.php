<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistroBienvenida;
use App\Models\Perfil;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $this->ensureDefaultPerfiles();
        $perfiles = Perfil::query()
            ->whereIn('nombre', ['Admin', 'Empleado'])
            ->orderBy('nombre')
            ->get();
        return view('auth.register', compact('perfiles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->ensureDefaultPerfiles();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'idperfil' => ['required', 'integer', 'exists:perfiles,id'],
        ]);

        $passwordPlano = (string) $request->password;
        $perfilId = (int) $request->idperfil;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'idperfil' => $perfilId,
        ]);

        try {
            Mail::to($user->email)->send(
                new RegistroBienvenida($user->name, $user->email, $passwordPlano)
            );
        } catch (\Throwable $e) {
            Log::error('No se pudo enviar el correo de bienvenida.', [
                'email' => $user->email,
                'error' => $e->getMessage(),
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    private function ensureDefaultPerfiles(): void
    {
        Perfil::query()->upsert([
            ['id' => 1, 'nombre' => 'Admin'],
            ['id' => 2, 'nombre' => 'Empleado'],
        ], ['id'], ['nombre']);
    }
}
