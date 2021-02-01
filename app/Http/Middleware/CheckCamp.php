<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCamp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $camp = session()->get('campana');
        $usuario = Auth::user();
        $rol = $usuario->roles[0]->name;
        if (!$camp && $rol == 'Agente') {
            return redirect()->route('campana-select');
        }
        return $next($request);
    }
}