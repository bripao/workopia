<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        // Validate the request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Regenerate the session to prevent fixation attacks
            $request->session()->regenerate();

            // Redirect to the intended route or a default route
            return redirect()->intended(route('home'))->with('success', 'You are now logged in!');
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
