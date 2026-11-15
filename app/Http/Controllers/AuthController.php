<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Opsi A: Jika tabel users & seeder sudah disiapkan di database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        // Opsi B: Akun demo cepat jika belum memakai tabel users database
        if ($credentials['email'] === 'admin@autocare.test' && $credentials['password'] === 'password123') {
            $request->session()->put('pengguna_login', [
                'nama' => 'Admin AutoCare',
                'email' => $credentials['email'],
            ]);
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Email atau kata sandi tidak sesuai.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('pengguna_login');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}