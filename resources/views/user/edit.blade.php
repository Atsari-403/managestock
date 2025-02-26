@extends('layouts.app')

@section('title', 'Edit User - Alpin Cell')

@section('styles')
<link href="{{ asset('css/user/edit.css') }}" rel="stylesheet">
<style>
    #store_id {
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 14px;
    background-color: #fff;
    border: 1px solid #ced4da;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
    transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

#store_id:focus {
    border-color: #007bff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

</style>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="Edit User"></x-dashboard-header>

    <div class="row">
        <!-- Edit User Form Section -->
        <div class="col-xl-8 col-lg-7">
            <div class="card border-0 shadow-lg rounded-3 animate-card">
                <div class="card-header bg-gradient-primary text-white py-2 rounded-3">
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
                                <div class="input-group input-rounded shadow-sm">
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
                                <div class="input-group input-rounded shadow-sm">
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
                                <div class="input-group input-rounded shadow-sm">
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
                            <!-- Store Selection -->
                            <div class="col-md-6 mb-4">
                                <label for="store_id" class="form-label fw-medium text-dark mb-2">Select Store</label>
                                <div class="input-group input-rounded shadow-sm">
                                    <span class="input-group-text"><i class="bi bi-shop"></i></span>
                                    <select class="form-select form-control-sm border-0 @error('store_id') is-invalid @enderror" id="store_id" name="store_id" required>
                                        <option value="" disabled>Select a store</option>
                                        @foreach ($stores as $store)
                                            <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                                {{ $store->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('store_id')
                                    <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('indexuser') }}" class="btn btn-outline-secondary btn-hover">
                                <i class="fas fa-times-circle me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4 btn-hover">
                                <i class="fas fa-save me-2"></i>Update User
                            </button>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Registered Emails Section -->
        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-lg rounded-3 animate-card" id="email-section">
                <div class="card-header bg-gradient-info text-white py-2 rounded-3">
                    <h5 class="card-title mb-0">Registered Emails</h5>
                </div>
                <div class="card-body p-4 email-list" style="max-height: 300px; overflow-y: auto;">
                    <ul class="list-group list-group-flush">
                        @foreach ($registeredEmails as $email)
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3 list-hover">
                                <span class="text-muted">{{ $email->email }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <button class="btn btn-outline-primary d-block d-md-none mt-3 btn-hover" id="toggleEmailsBtn">
                <i class="fas fa-eye me-2"></i>View Registered Emails
            </button>
        </div>
    </div>
</div>
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

