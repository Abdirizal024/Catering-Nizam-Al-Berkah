<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticatedAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = 'admin')
    {
        Log::info('Checking admin authentication.');
    
        if (Auth::guard($guard)->check()) {
            return redirect()->route('admin')->with('info', 'Anda sudah login, silakan kembali ke dashboard.');
        }
    
        return $next($request);
    }
    
}
