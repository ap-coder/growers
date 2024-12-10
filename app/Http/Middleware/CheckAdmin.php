<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // If user is not an admin, redirect them to the client account page
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect('/account-dashboard');  // Redirect to the client dashboard or another route
        }

        return $next($request);
    }
}

