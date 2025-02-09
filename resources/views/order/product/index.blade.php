@extends('layouts.app')

@section('title', 'Orders - Alpin Cell')

@section('styles')
<link href="{{ asset('css/indexCategory.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <x-dashboard-header title="Create Product"></x-dashboard-header>

    <!-- Product Types Menu -->
    <div class="row g-4">
        @foreach ($products as $product)      
        <div class="col-md-3 col-sm-6">
            <div class="product-card position-relative">
                <!-- Tombol Edit & Hapus di Sudut Atas -->
                <div class="position-absolute top-0 end-0 m-2 d-flex gap-1">
                    <!-- Tombol Edit -->
                    <a href="#" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </a>
        
                    <!-- Tombol Hapus -->
                    <form action="#" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
        
                <a href="{{ route('indexcategoryproduct', ['idProduct' => $product->id]) }}" class="text-decoration-none">
                    <div class="card-content">
                        <div class="icon-container">
                            @if ($product->name == 'Pulsa')
                                <i class="bi bi-phone"></i>
                            @elseif ($product->name == 'E-Wallet')
                                <i class="bi bi-wallet2"></i>
                            @elseif ($product->name == 'Transaksi')
                                <i class="bi bi-cart"></i>
                            @elseif ($product->name == 'Pembayaran Pascabayar')
                                <i class="bi bi-credit-card"></i>
                            @elseif ($product->name == 'Top Up Game')
                                <i class="bi bi-controller"></i>
                            @elseif ($product->name == 'Voucher')
                                <i class="bi bi-ticket-perforated"></i>
                            @elseif ($product->name == 'Aksesoris')
                                <i class="bi bi-box"></i>
                            @endif
                        </div>
                        <h5 class="product-title">{{ $product->name }}</h5>
        
                        <!-- Tombol Tambah Kategori -->
                        <div class="button-container mt-3">
                            <a href="{{ route('categoryproductcreate', ['idProduct' => $product->id]) }}" class="add-category-btn">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
                            </a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
        @endforeach
    </div>
</div>
@endsection