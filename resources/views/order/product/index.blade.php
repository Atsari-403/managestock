@extends('layouts.app')

@section('title', 'Orders - Alpin Cell')

@section('styles')
<link href="{{ asset('css/indexCategory.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="Create Product"></x-dashboard-header>
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
    <!-- Product Types Menu -->
    <div class="row g-4">
        @foreach ($products as $product)      
        <div class="col-md-3 col-sm-6">
            <div class="product-card">
                <a href="{{route('indexcategoryproduct',['idProduct'=>$product->id])}}" class="text-decoration-none">
                    <div class="card-content">
                        <div class="icon-container">
                            @if ($product->name == 'Pulsa')
                                <i class="bi bi-phone"></i>
                            @elseif ($product->name == 'E-Wallet')
                                <i class="bi bi-wallet2"></i>
                            @elseif ($product->name == 'Transaksi')
                                <i class="bi bi-cart"></i>
                            @elseif ($product->name == 'Pembayaran')
                                <i class="bi bi-credit-card"></i>
                            @elseif ($product->name == 'Top Up Game')
                                <i class="bi bi-controller"></i>
                            @elseif ($product->name == 'Voucher')
                                <i class="bi bi-ticket-perforated"></i>
                            @elseif ($product->name == 'Aksesoris')
                                <i class="bi bi-box"></i>
                            @elseif ($product->name == 'Kartu')
                                <i class="bi bi-sim"></i>
                            @elseif ($product->name == 'Paket Data')
                                <i class="bi bi-router"></i>
                            @endif
                        </div>
                        <h5 class="product-title">{{$product->name}}</h5>
                        
                        <div class="button-container">
                            <a href="{{route('categoryproductcreate',['idProduct'=>$product->id])}}" class="add-category-btn">
                                <i class="bi bi-plus-lg me-1"></i>
                                Tambah Kategori
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