<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Anhskohbo\NoCaptcha\Rules\Captcha;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->remember;

        if (auth()->attempt($credentials, $remember)) {

            if (!auth()->user()->is_verified) {
                auth()->logout();
                return redirect('/login')->withErrors([
                    'email' => 'Akun Anda belum diverifikasi oleh admin.',
                ]);
            }

            return redirect()->intended('/home');
        }

        return back()->withErrors(['email' => 'Maaf, Email atau Password Salah'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
