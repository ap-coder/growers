<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LocalAutoLogin
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
        if (app()->isLocal() && !Auth::check()) {

            $userId = env('LOCAL_AUTO_LOGIN_USER_ID', 1);
            $user = User::find($userId);
            if ($user) {
                Auth::login($user);
            }
        }

        return $next($request);
    }
}

