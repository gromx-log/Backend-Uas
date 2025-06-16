<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // show login form
    public function showLoginForm ()
    {
        return view('auth.login');
    }

    // show signup form
    public function showSignupForm ()
    {
        return view('auth.signup');
    }

    // handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // handle signup
     public function signup(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string|max:20|unique:users',
            'userHandle' => 'required|string|max:20|unique:users',
            'email' => 'required|email|unique:users',
            'bio' => 'string|nullable',
            'password' => ['required','string','min:8','confirmed'],
        ]);

        $credentials['password'] = Hash::make($credentials['password']);
        $user = User::create($credentials);
        Auth::login($user);

        return redirect()->route('home');
    }
    
    // handles user log out from session
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('show.login');
    }
}
