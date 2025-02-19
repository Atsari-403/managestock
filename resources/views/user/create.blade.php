@extends('layouts.app')

@section('title', 'Add User - Alpin Cell')

@section('styles')
<link href="{{ asset('css/user/create.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="Add User"></x-dashboard-header>

    <div class="row">
        <!-- Add User Form Section -->
        <div class="col-xl-8 col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 animate-card">
                <div class="card-header bg-gradient-primary text-white py-3 px-4">
                    <h5 class="card-title mb-0 fw-bold"><i class="bi bi-person-plus me-2"></i>User Details</h5>
                </div>
                <div class="card-body p-3">
                    <form method="POST" action="{{route('createuser')}}">
                        @csrf
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-medium text-dark mb-2">Full Name</label>
                                <div class="input-group input-group-sm input-rounded shadow-sm ">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-person-fill"></i></span>
                                    <input type="text" class="form-control form-control-sm border-0 @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" placeholder="Enter full name" required>
                                </div>
                                @error('name')
                                    <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-medium text-dark mb-2">Email Address</label>
                                <div class="input-group input-group-sm input-rounded shadow-sm">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-envelope-fill"></i></span>
                                    <input type="email" class="form-control form-control-sm border-0 @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}" placeholder="Enter email address" required>
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-medium text-dark mb-2">Password</label>
                                <div class="input-group input-group-sm input-rounded shadow-sm">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control form-control-sm border-0 @error('password') is-invalid @enderror" 
                                           id="password" name="password" placeholder="Create a password" required>
                                    <button class="btn bg-light border-0" type="button" id="togglePassword">
                                        <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                                <div class="form-text mt-3" id="passwordHelp">
                                    <i class="bi bi-info-circle me-1"></i> Password should be at least 8 characters long
                                </div>
                            </div>
                            
                            <!-- Role -->
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label fw-medium text-dark mb-2">User Role</label>
                                <div class="input-group input-group-sm input-rounded shadow-sm">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-shield-lock-fill"></i></span>
                                    <select class="form-select form-control-sm border-0 @error('role') is-invalid @enderror" id="role" name="role" required>
                                        <option value="" disabled selected>Select user role</option>
                                        <option value="0" {{ old('role') == 0 ? 'selected' : '' }}>Standard User</option>
                                        <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Administrator</option>
                                    </select>
                                </div>
                                @error('role')
                                    <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-2">
                            <a href="{{ route('indexuser') }}" class="btn btn-outline-secondary btn-sm btn-hover">
                                <i class="bi bi-x-circle me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary btn-sm px-4 btn-hover">
                                <i class="bi bi-person-plus-fill me-2"></i>Create User
                            </button>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Registered Emails Section -->
        <div class="col-xl-4 col-lg-5 mt-4 mt-lg-0">
            <div class="card border-0 shadow-xl rounded-4 overflow-hidden animate-card" id="email-section">
                <div class="card-header bg-gradient-info text-white py-4 px-4">
                    <h5 class="card-title mb-0 fw-bold"><i class="bi bi-envelope-paper me-2"></i>Registered Emails</h5>
                </div>
                <div class="card-body p-0">
                    <div class="email-list" style="max-height: 350px; overflow-y: auto;">
                        <ul class="list-group list-group-flush">
                            @foreach ($registeredEmails as $email)
                                <li class="list-group-item border-0 py-3 px-4 list-hover">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-light me-3">
                                            <i class="bi bi-person text-primary"></i>
                                        </div>
                                        <span class="email-text">{{ $email->email }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="p-3 bg-light border-top">
                        <span class="text-muted small">
                            <i class="bi bi-info-circle me-1"></i>
                            Showing {{ count($registeredEmails) }} registered email{{ count($registeredEmails) != 1 ? 's' : '' }}
                        </span>
                    </div>
                </div>
            </div>
        
            <!-- Button to Toggle Visibility of Registered Emails Section on Mobile -->
            <button class="btn btn-info text-white w-100 mt-3 d-block d-lg-none rounded-pill shadow-sm" id="toggleEmailsBtn">
                <i class="bi bi-eye me-2"></i>View Registered Emails
            </button>
        </div>
    </div>
</div>

<!-- Toast Notification for Successful Form Submission -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="successToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
            <i class="bi bi-check-circle me-2"></i>
            <strong class="me-auto">Success</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            User has been successfully created!
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                toggleIcon.classList.toggle('bi-eye');
                toggleIcon.classList.toggle('bi-eye-slash');
            });
        }
        
        // Toggle email section visibility on mobile
        const toggleEmailsBtn = document.getElementById('toggleEmailsBtn');
        const emailSection = document.getElementById('email-section');
        
        if (toggleEmailsBtn) {
            toggleEmailsBtn.addEventListener('click', function() {
                if (emailSection.style.display === 'none' || emailSection.style.display === '') {
                    emailSection.style.display = 'block';
                    emailSection.classList.add('fade-in');
                    toggleEmailsBtn.innerHTML = '<i class="bi bi-eye-slash me-2"></i>Hide Registered Emails';
                } else {
                    emailSection.style.display = 'none';
                    toggleEmailsBtn.innerHTML = '<i class="bi bi-eye me-2"></i>View Registered Emails';
                }
            });
        }
        
        // Form validation and toast notification
        const form = document.querySelector('form');
        
        if (form) {
            form.addEventListener('submit', function(event) {
                // Form validation code would go here if needed
                
                // For demonstration, we'll show a toast on form submission in a real app
                // You might want to trigger this only after successful submission
                /*
                const successToast = document.getElementById('successToast');
                if (successToast) {
                    const toast = new bootstrap.Toast(successToast);
                    toast.show();
                }
                */
            });
        }
    });
</script>
@endsection