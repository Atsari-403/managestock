@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
<div class="container-fluid mt-4">
   <!-- header -->
   <x-dashboard-header
      title="User Profile"
      description="informasi profil pengguna"
      icon="bi bi-person-circle">
   </x-dashboard-header>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-light">
                <div class="card-header bg-white border-bottom p-4">
                    <h4 class="card-title mb-0 text-center">Profile of {{ $user->name }}</h4>
                </div>
                <div class="card-body p-4">
                    <!-- Profile Picture Section -->
                    <div class="text-center mb-4">
                        @if($user->picture)
                            <img src="{{ $user->picture }}" alt="Profile Picture" class="img-fluid rounded-circle" style="max-width: 150px;">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Default Profile Picture" class="img-fluid rounded-circle" style="max-width: 150px;">
                        @endif
                    </div>

                    <!-- User Details -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" value="{{ $user->phone_number }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="role" value="{{ $user->role == 1 ? 'Admin' : 'User' }}" readonly>
                        </div>
                    </div>

                    <!-- Profile Picture Upload Section -->
                    <div class="mb-3">
                        <label for="picture" class="form-label">Profile Picture</label>
                        @if($user->picture)
                            <p class="text-muted">Anda telah mengunggah foto profil. Untuk memperbarui, unggah gambar baru.</p>
                        @else
                            <p class="text-muted">Belum ada foto profil yang diunggah. Anda dapat mengunggahnya sekarang!</p>
                        @endif
                    </div>

                    <!-- Back Button -->
                    <div class="d-flex justify-content-between">
                        <button onclick="window.history.back();" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </button>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
