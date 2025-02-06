@extends('layouts.app')

@section('title', 'Profile Settings - Alpin Cell')

@section('content')
<div class="container-fluid mt-4">
    <x-dashboard-header title="Setting Profile"></x-dashboard-header>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Profile Settings</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('setting.update',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @method('PUT')

                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img src="{{ Auth::user()->picture ? Auth::user()->picture : asset('image/avatar.png') }}" 
                                     alt="Profile" class="rounded-circle" width="150" height="150">
                                <label for="picture" class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle">
                                    <i class="bi bi-camera"></i>
                                </label>
                                <input type="file" name="picture" id="picture" class="d-none">
                            </div>
                            <div class="small text-muted">Allowed JPG or PNG. Max size of 800K</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" name="name" class="form-control" id="username" 
                                           value="{{ old('name', Auth::user()->name) }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" id="email" 
                                           value="{{ old('email', Auth::user()->email) }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">No. Telp</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                    <input type="tel" name="phone_number" class="form-control" id="phone" 
                                           value="{{ old('phone_number', Auth::user()->phone_number) }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label">Role</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                    <input type="text" class="form-control" id="role" 
                                    value="{{ Auth::user()->role == 1 ? 'Admin' : 'Staff' }}" disabled>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="mb-3">Change Password</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="newPassword" class="form-label">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" class="form-control" id="newPassword">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control" id="confirmPassword">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-light">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
