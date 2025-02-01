@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="auth-background">
    <div class="auth-shape"></div>
    <div class="auth-shape"></div>
</div>

<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-5">
            <div class="auth-container p-4 p-md-5">
                <div class="auth-header">
                    <div class="d-flex justify-content-center">
                        <img src="{{ ('image/logo.png') }}" alt="Alpin Cell Logo" class="auth-logo img-fluid mb-3">
                    </div>
                </div>
                <h3 class="auth-title text-center mb-4 fs-2">Login Here</h3>

                <form method="POST" action="">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="auth-label form-label">Email Address</label>
                        <input type="email" class="form-control auth-input @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="auth-label form-label">Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control auth-input @error('password') is-invalid @enderror" 
                                   id="password" name="password" required autocomplete="current-password">
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3" 
                                  style="cursor: pointer;" 
                                  onclick="togglePassword('password')">
                                <i class="bi bi-eye-slash text-white" id="password-toggle-icon"></i>
                            </span>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember" 
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label auth-text" for="remember">Remember Me</label>
                    </div>

                    <button type="submit" class="btn auth-button w-100">Login</button>

                    @if (Route::has('password.request'))
                        <div class="text-center mt-3">
                            <a class="auth-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    @endif

                    <div class="text-center mt-3">
                        <span class="auth-text">Belum punya akun?</span>
                        <a class="auth-link ms-2" href="/register">Daftar di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
