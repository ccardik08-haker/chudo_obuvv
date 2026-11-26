<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login'    => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $identifier = $request->input('login');

        $field = match (true) {
            filter_var($identifier, FILTER_VALIDATE_EMAIL) !== false => 'email',
            preg_match('/^\+?[0-9]{10,15}$/', $identifier) === 1    => 'phone',
            default                                                  => 'login',
        };

        if (Auth::attempt([$field => $identifier, 'password' => $request->input('password')],
            $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'login' => 'Неверный логин, телефон или пароль',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}