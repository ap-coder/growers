<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\TwoFactorCodeNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | Login Controller
    |----------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to their home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user after login based on their role.
     *
     * @return string
     */
    protected function authenticated(Request $request, $user)
    {
        // Check if the user is an admin
        if ($user->is_admin) {
            return redirect()->route('admin.home');  // Admin dashboard
        }

        // Regular user, redirect to their private pages
        return redirect()->route('account.dashboard');  // account user dashboard
    }

    /**
     * Show the login form for users.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('site.pages.login.index');  // The same login page for all users
    }
}
