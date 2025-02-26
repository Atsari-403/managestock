@extends('layouts.app')

@section('title', 'Store - Alpin Cell')

@section('styles')
<link href="{{ asset('css/dashboard/index.css') }}" rel="stylesheet">
<link href="{{ asset('css/indexCategory.css') }}" rel="stylesheet">
<link href="{{ asset('css/indexProduct.css') }}" rel="stylesheet">
<style>
:root {
    --primary-color: #007bff;
    --hover-color: #0056b3;
    --bg-light: #f8fafc;
    --text-dark: #2d3748;
}

.container-fluid {
    background: var(--bg-light);
    min-height: 100vh;
}

/* Card Store */
.store-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    height: 100%;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

/* Garis Hover di Atas Card */
.store-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: var(--primary-color);
    transform: scaleX(0);
    transition: transform 0.3s ease;
    transform-origin: left;
}

.store-card:hover::before {
    transform: scaleX(1);
}

.store-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 123, 255, 0.1);
}

/* Ikon */
.icon-container {
    width: 80px;
    height: 80px;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: linear-gradient(145deg, #f8fafc, #ffffff);
    box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.05),
                -4px -4px 8px rgba(255, 255, 255, 0.9);
    transition: background 0.3s ease, transform 0.3s ease;
}

.icon-container i {
    font-size: 2.5rem;
    color: var(--primary-color);
    transition: color 0.3s ease, transform 0.3s ease;
}

.store-card:hover .icon-container {
    background: var(--primary-color);
}

.store-card:hover .icon-container i {
    color: white;
    transform: scale(1.1);
}

/* Nama Toko */
.store-title {
    color: var(--text-dark);
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
    transition: color 0.3s ease;
}

.store-card:hover .store-title {
    color: var(--primary-color);
}

/* Saat Nama Toko Diklik */
.store-title:active {
    color: var(--primary-color);
}

/* Responsif */
@media (max-width: 768px) {
    .icon-container {
        width: 60px;
        height: 60px;
    }

    .icon-container i {
        font-size: 2rem;
    }

    .store-title {
        font-size: 1.1rem;
    }
}

/* Animasi Muncul */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.store-card {
    animation: fadeInUp 0.5s ease forwards;
}
</style>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title mb-0 d-flex align-items-center">
                            <i class="bi bi-shop me-2 text-primary"></i>
                            Store Management
                        </h3>
                        <p class="text-muted mt-2 mb-0">Kelola toko Anda dengan mudah</p>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    @if(session()->has('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endif
    <div class="row g-4">
        @forelse ($stores as $store)      
        <div class="col-md-3 col-sm-6">
            {{-- {{ dd(route('productindex', ['store_id' => $store->id])) }} --}}

        
                <div class="store-card position-relative" onclick="window.location.href='{{ route('indexorderAdmin', ['store_id' => $store->id]) }}';" 
                    style="cursor: pointer;">
    
                    <!-- Ikon Toko -->
                    <div class="icon-container">
                        <i class="bi bi-shop"></i>
                    </div>
    
                    <!-- Nama Toko -->
                    <h5 class="store-title fw-bold">{{ $store->name }}</h5>
                </div>
            </div>
        @empty
        <div class="col-12 text-center">
            <div class="d-flex flex-column align-items-center">
                <i class="bi bi-shop text-primary" style="font-size: 4rem;"></i>
                <h4 class="text-muted mt-3">Belum ada store yang tersedia</h4>
                <p class="text-muted">Tambahkan store pertama Anda untuk mulai mengelola produk.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
