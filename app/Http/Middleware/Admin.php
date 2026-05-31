<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ((int) Auth::user()->idperfil !== 1) {
            return redirect()
                ->route('facturas.index')
                ->with('mensaje', 'No tienes permiso para realizar esta accion.');
        }

        return $next($request);
    }
}
