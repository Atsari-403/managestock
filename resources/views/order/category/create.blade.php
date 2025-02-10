@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('styles')
<link href="{{ asset('css/tambahKategori.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="Create Product"></x-dashboard-header>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card form-card">
                <div class="card-header">
                    <h5 class="mb-0 d-flex align-items-center">
                        {{-- update <i class="bi bi-folder-symlink me-2"></i> --}}
                        <i class="bi bi-folder-plus me-2"></i>
                        Tambah Kategori
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert custom-alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{route('categoryproductstore',$idProduct)}}" method="POST">
                        @csrf
                        <!-- Nama Kategori -->
                        <div class="form-group mb-4">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-tag"></i>
                                </span>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       placeholder="Masukkan nama kategori"
                                       required>
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block mt-1">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-submit w-100">
                            <i class="bi bi-plus-lg me-2"></i>
                            Tambah Kategori
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
