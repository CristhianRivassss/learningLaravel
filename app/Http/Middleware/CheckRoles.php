<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;


class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Debug: log que el middleware se está ejecutando
        Log::info("CheckRoles middleware ejecutándose para rol: " . $role);
        
        // Verificar si hay usuario autenticado
        if (!Auth::check()) {
            Log::info("Usuario no autenticado, redirigiendo a login");
            return redirect('/login');
        }

        $userRole = Auth::user()->role;
        Log::info("Usuario autenticado - Rol del usuario: '" . $userRole . "', Rol requerido: '" . $role . "'");

        // Verificar si el usuario tiene el rol requerido
        if ($userRole === $role) {
            Log::info("Rol coincide, permitiendo acceso");
            return $next($request);
        }

        // Si no tiene el rol, denegar acceso
        Log::info("Rol no coincide, denegando acceso");
        return redirect('/')->with('error', 'No tienes permisos. Tu rol: [' . $userRole . '], Requerido: [' . $role . ']');
    }
}
