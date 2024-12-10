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
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // If the user is an admin, redirect to the admin dashboard
                if (Auth::user()->is_admin) {
                    return redirect(RouteServiceProvider::ADMIN);
                }

                // If the user is a client, redirect to the account dashboard
                // Redirect to /account/account-dashboard
                return redirect(RouteServiceProvider::ACCOUNT);
            }
        }

        return $next($request);
    }
}
