@extends('layouts.app')

@section('title', 'Product - Pulsa')

@section('styles')
<link href="{{ asset('css/indexCategory.css') }}" rel="stylesheet">
<style>
    /* Styling Card */
    .product-card {
        transition: all 0.3s ease-in-out;
        border-radius: 10px;
        overflow: hidden;
    }

    /* Isi Card */
    .product-card .card-content {
        background: linear-gradient(135deg, #007bff, #00d4ff);
        padding: 15px;
        border-radius: 10px;
        color: rgba(255, 255, 255, 0.85); /* Warna putih lebih soft */
        font-weight: bold;
        font-family: 'Poppins', sans-serif;
    }

    /* Hover Efek */
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 20px rgba(0, 123, 255, 0.2);
    }

    /* Judul Produk */
    .product-title {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.9); /* Warna putih sedikit lebih tegas */
    }
</style>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="{{ $product->name }}"></x-dashboard-header>

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
    @endif

    <!-- Product Providers -->
    @if ($categoryProducts->isEmpty())
        <div class="alert alert-warning text-center">Tidak ada Kategori dalam Product ini.</div>
    @else
    <div class="row g-4">
        @foreach ($categoryProducts as $categoryProduct)
        <div class="col-md-3 col-sm-6">
            <div class="product-card position-relative shadow-sm border-0 rounded-lg overflow-hidden">
                <a href="{{ route('packetorder', ['idProduct' => $product->id, 'idCategory' => $categoryProduct->id]) }}" class="text-decoration-none d-block">
                    <div class="card-content p-3 text-center bg-light rounded">
                        <h5 class="product-title fw-bold mb-0">{{ $categoryProduct->name }}</h5>
                    </div>
                </a>
            </div>
        </div>        
        @endforeach
    </div> <!-- Tutup div row g-4 -->
    @endif
</div> <!-- Tutup div container-fluid -->
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
@endsection
