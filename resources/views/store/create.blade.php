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
<!-- header -->
<div class="container-fluid mt-3">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title mb-0 d-flex align-items-center">
                            <i class="bi bi-shop me-2 text-primary"></i>
                            Management
                        </h3>
                    </div>
                    <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addStoreModal">
                        <i class="bi bi-plus-lg me-2"></i>Store
                    </button>
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

        
                <div class="store-card position-relative" onclick="window.location.href='{{ route('productindex', ['store_id' => $store->id]) }}';" 
                    style="cursor: pointer;">
                    <!-- Tombol Edit & Delete -->
                    <div class="position-absolute top-0 end-0 p-2">
                        <a href="#" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button type="button" class="btn btn-outline-danger btn-sm" 
                            onclick="event.stopPropagation();" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $store->id }}">
                            <i class="bi bi-trash"></i>
                        </button>                         
                    </div>
    
                    <!-- Ikon Toko -->
                    <div class="icon-container">
                        <i class="bi bi-shop"></i>
                    </div>
    
                    <!-- Nama Toko -->
                    <h5 class="store-title fw-bold">{{ $store->name }}</h5>
                </div>
                {{-- destroy --}}
                <div class="modal fade" id="confirmDeleteModal{{ $store->id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog-centered modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus Store</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus store <strong>{{ $store->name }}</strong>?  
                                Tindakan ini tidak bisa dibatalkan.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('storeDestroy', ['id' => $store->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        <div class="col-12 text-center">
            <div class="d-flex flex-column align-items-center">
                <i class="bi bi-shop text-primary" style="font-size: 4rem;"></i>
                <h4 class="text-muted mt-3">Belum ada store yang tersedia</h4>
                <p class="text-muted">Tambahkan store pertama Anda untuk mulai mengelola produk.</p>
                <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addStoreModal">
                    <i class="bi bi-plus-lg me-2"></i> Tambah Store
                </button>
            </div>
        </div>
        @endforelse
    </div>
    
    <!-- Modal Tambah Store -->
    <div class="modal fade" id="addStoreModal" tabindex="-1" aria-labelledby="addStoreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStoreModalLabel">Tambah Store</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('storeStore')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Store</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
