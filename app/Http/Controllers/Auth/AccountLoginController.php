<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountLoginController extends Controller
{
    /**
     * Show the login form for account users.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('site.pages.login.index');  // Custom login page for regular users
    }

    /**
     * Handle the account user login attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Check for user authentication (using the default 'web' guard)
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended('/account-dashboard');  // Redirect to the private account pages (site pages)
        }

        // If login fails, redirect back to login with an error message
        return redirect()->route('login')->with('error', 'Invalid credentials');
    }

    /**
     * Logout the account user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login');  // Redirect to login page after logout
    }
}
