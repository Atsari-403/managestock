@extends('layouts.app')

@section('title', 'Orders - Alpin Cell')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="Orders"></x-dashboard-header>

    <!-- Product Types Menu -->
    <div class="row mb-4">
        <!-- Dummy Data with Icons -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="{{route('order.product.pulsa')}}" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-phone" style="font-size: 50px;"></i>
                        <h5 class="card-title">Pulsa</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="{{route('order.product.e-wallet')}}" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-wallet2" style="font-size: 50px;"></i>
                        <h5 class="card-title">E-wallet</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="{{route('order.product.transaksi')}}" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-cart" style="font-size: 50px;"></i>
                        <h5 class="card-title">Transaksi</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="{{route('order.product.ppb')}}" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-credit-card" style="font-size: 50px;"></i>
                        <h5 class="card-title">Pembayaran Pasca Bayar</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="{{route('order.product.topupgame')}}" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-controller" style="font-size: 50px;"></i>
                        <h5 class="card-title">Top Up Game</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="{{route('order.product.voucher')}}" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-ticket-perforated" style="font-size: 50px;"></i>
                        <h5 class="card-title">Voucher</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="{{route('order.product.accessories')}}" class="text-decoration-none">
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
