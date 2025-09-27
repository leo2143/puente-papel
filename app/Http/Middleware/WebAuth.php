<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class WebAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si hay token en la sesión o cookie
        $token = $request->cookie('jwt_token') ?? session('jwt_token');
        
        if ($token) {
            try {
                // Intentar autenticar con el token
                $user = JWTAuth::setToken($token)->authenticate();
                
                if ($user) {
                    // Autenticar al usuario en Laravel
                    Auth::login($user);
                }
            } catch (JWTException $e) {
                // Token inválido, limpiar
                $this->clearAuth($request);
            }
        }

        return $next($request);
    }

    /**
     * Limpiar autenticación
     */
    private function clearAuth(Request $request)
    {
        session()->forget('jwt_token');
        $request->session()->forget('jwt_token');
    }
}
