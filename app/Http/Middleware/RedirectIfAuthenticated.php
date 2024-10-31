<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   // Di dalam `app/Http/Middleware/AuthenticateAdmin.php`
public function handle($request, Closure $next, ...$guards)
{
    if (!auth()->guard('admin')->check()) {
        return redirect()->route('login');
    }

    return $next($request);
}

}
