<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next, $role1, $role2)
    {
        if (!Auth::check() || (!Auth::user()->hasRole($role1) && !Auth::user()->hasRole($role2))) {
            // Redireccionar o lanzar una excepción según sea necesario
            session()->flash('mensaje', 'USTED NO CUENTA CON LOS PERMISOS NECESARIOS PARA REALIZAR ESTA OPERACION');
            return redirect()->route('dashboard'); // Por ejemplo, redireccionar a la página de inicio
            // O puedes lanzar una excepción
            // throw new \Exception('Acceso no autorizado.');
        }

        return $next($request);
    }
}
