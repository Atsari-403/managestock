<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */

    public function loginform()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $remember = $request->has('remember');
    $key = 'login_attempts:'.Str::lower($request->email).'|'.$request->ip(); // Kunci unik berdasarkan email + IP

    // Rate Limiting: Cegah brute force (max 5 percobaan dalam 1 menit)
    if (RateLimiter::tooManyAttempts($key, 5)) {
        throw ValidationException::withMessages([
            'email' => 'Too many login attempts. Please try again later.',
        ]);
    }

    if (Auth::attempt($credentials, $remember)) {
        RateLimiter::clear($key); // Reset percobaan jika berhasil login
        $request->session()->regenerate(); // Regenerasi session untuk keamanan
        return redirect()->intended('/');
    }

    // Log aktivitas login gagal
    Log::warning('Failed login attempt', [
        'email' => $request->email,
        'ip' => $request->ip(),
        'time' => now(),
    ]);

    RateLimiter::hit($key, 60); // Tambah hitungan login gagal (berlaku selama 1 menit)

    throw ValidationException::withMessages([
        'email' => 'Invalid login credentials.',
    ]);
}
}
