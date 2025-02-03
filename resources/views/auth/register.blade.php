@extends('layouts.auth')

@section('styles')
<link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="auth-background">
    <div class="auth-shape"></div>
    <div class="auth-shape"></div>
</div>

<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center py-5">
        <div class="col-md-5">
            <div class="auth-container p-4 p-md-5">
                <div class="auth-header">
                    <div class="d-flex justify-content-center">
                        <img src="{{ ('image/logo.png') }}" alt="Alpin Cell Logo" class="auth-logo img-fluid mb-3">
                    </div>
                </div>
                <h3 class="auth-title text-center mb-4 fs-2">Register Here</h3>

                <form method="POST" action="">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="auth-label form-label">Name</label>
                        <input type="text" class="form-control auth-input @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="auth-label form-label">Email Address</label>
                        <input type="email" class="form-control auth-input @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="username" class="auth-label form-label">Username</label>
                        <input type="text" class="form-control auth-input @error('username') is-invalid @enderror" 
                               id="username" name="username" value="{{ old('username') }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="auth-label form-label">Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control auth-input @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
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

                    <div class="mb-4">
                        <label for="password_confirmation" class="auth-label form-label">Confirm Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control auth-input" 
                                   id="password_confirmation" name="password_confirmation" required>
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3" 
                                  style="cursor: pointer;" 
                                  onclick="togglePassword('password_confirmation')">
                                <i class="bi bi-eye-slash text-white" id="password_confirmation-toggle-icon"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn auth-button w-100">Register</button>

                    <div class="text-center mt-3">
                        <span class="auth-text">Sudah punya akun?</span>
                        <a class="auth-link ms-2" href="/login">Login disini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

