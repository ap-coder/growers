<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ImpersonateUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('impersonate_user_id')) {
            $impersonatedUser = \App\Models\User::find(session('impersonate_user_id'));
            
            if ($impersonatedUser) {
                Auth::setUser($impersonatedUser);
            } else {
                session()->forget('impersonate_user_id');
                session()->forget('impersonate_original_user_id');
            }
        }

        return $next($request);
    }
}
