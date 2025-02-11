@extends('layouts.app')

@section('title', 'Edit User - Alpin Cell')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="Edit User"></x-dashboard-header>

    <div class="row">
        <!-- Edit User Form Section -->
        <div class="col-xl-8 col-lg-7">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-primary text-white py-3 rounded-3">
                    <h5 class="card-title mb-0">Edit User</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{route('userupdate',$user->id)}}">
                        @csrf
                        @method('POST')
                        
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 mb-4">
                                <label for="name" class="form-label">Name</label>
                                <div class="input-group shadow-sm">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Full Name" required>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group shadow-sm">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="email@example.com" required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div class="col-md-6 mb-4">
                                <label for="role" class="form-label">Role</label>
                                <div class="input-group shadow-sm">
                                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                    <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                                        <option value="0" {{ old('role', $user->role) == 0 ? 'selected' : '' }}>User</option>
                                        <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('indexuser') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times-circle me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Update User
                            </button>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Registered Emails Section -->
        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-lg rounded-3" id="email-section">
                <div class="card-header bg-primary text-white py-3 rounded-3">
                    <h5 class="card-title mb-0">Registered Emails</h5>
                </div>
                <div class="card-body p-4" style="max-height: 300px; overflow-y: auto;">
                    <ul class="list-group list-group-flush">
                        @foreach ($registeredEmails as $email)
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted">{{ $email->email }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <button class="btn btn-outline-primary d-block d-md-none mt-3" id="toggleEmailsBtn">
                <i class="fas fa-eye me-2"></i>View Registered Emails
            </button>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .input-group-text {
        background-color: #f1f3f5;
        border-color: #ced4da;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #0d6efd;
    }

    .btn-outline-secondary, .btn-outline-primary {
        border-radius: 25px;
        font-weight: 600;
    }

    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
    }

    .btn-outline-primary:hover {
        background-color: #e7f1ff;
    }

    /* Hide email section on mobile */
    #email-section {
        display: block;
    }

    @media (max-width: 767px) {
        #email-section {
            display: none;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.getElementById('toggleEmailsBtn').addEventListener('click', function () {
        var emailSection = document.getElementById('email-section');
        if (emailSection.style.display === "none" || emailSection.style.display === "") {
            emailSection.style.display = "block";
            emailSection.classList.add('mt-3');
            this.textContent = "Hide Registered Emails";
        } else {
            emailSection.style.display = "none";
            emailSection.classList.remove('mt-3');  
            this.textContent = "View Registered Emails";
        }
    });
</script>
@endsection
