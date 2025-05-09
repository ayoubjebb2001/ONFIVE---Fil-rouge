<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request) {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            
            return redirect()->intended()->with('login_success', 'Login successful');
        }

        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request) {
        auth()->logout();

        return redirect()->route('home')->with('logout_success', 'Logout successful');
    }
}
