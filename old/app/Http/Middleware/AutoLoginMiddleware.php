<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AutoLoginMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (app()->isLocal() && !Auth::check()) {
            Auth::login(User::first()); // Log in the first user
        }

        return $next($request);
    }
}
