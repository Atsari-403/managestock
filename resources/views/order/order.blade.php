@extends('layouts.app')

@section('title', 'Orders - Alpin Cell')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">Orders</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Orders</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <button class="btn btn-primary d-flex align-items-center gap-2">
                        <i class="bi bi-download"></i>
                        Export Orders
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Types Menu -->
    <div class="row mb-4">
        <!-- Dummy Data with Icons -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="{{route('order.product.product')}}" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-phone" style="font-size: 50px;"></i>
                        <h5 class="card-title">Pulsa</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="#" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-wallet2" style="font-size: 50px;"></i>
                        <h5 class="card-title">E-wallet</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="#" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-cart" style="font-size: 50px;"></i>
                        <h5 class="card-title">Transaksi</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="#" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-credit-card" style="font-size: 50px;"></i>
                        <h5 class="card-title">Pembayaran</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="#" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-controller" style="font-size: 50px;"></i>
                        <h5 class="card-title">Top Up Game</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="#" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-ticket-perforated" style="font-size: 50px;"></i>
                        <h5 class="card-title">Voucher</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="#" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-box" style="font-size: 50px;"></i>
                        <h5 class="card-title">Accessories</h5>
                    </div>
                </a>
            </div>
        </div>
        <!-- Additional Box for 'Lainnya' -->
        {{-- <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="#" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-three-dots" style="font-size: 50px;"></i>
                        <h5 class="card-title">Lainnya</h5>
                    </div>
                </a>
            </div>
        </div> --}}
    </div>
</div>
@endsection

@section('styles')
<style>
.card-body {
    padding: 1.5rem;
}

.card-body .card-title {
    font-size: 1.25rem;
    color: #333;
}

.card {
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.card-body i {
    font-size: 50px;
    color: #007bff;
}

.table .btn-light {
    background-color: #f8f9fa;
    border-color: #f8f9fa;
}

.table .btn-light:hover {
    background-color: #e9ecef;
    border-color: #e9ecef;
}
</style>
@endsection
