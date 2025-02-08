@extends('layouts.app')

@section('title', 'Orders - Alpin Cell')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="Orders"></x-dashboard-header>

    <!-- Product Types Menu -->
    <div class="row mb-4">
        @foreach ($products as $product)      
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="{{route($product->name)}}" class="text-decoration-none">
                    <div class="card-body text-center">
                        @if ($product->name == 'Pulsa')
                            <i class="bi bi-phone" style="font-size: 50px;"></i>
                        @elseif ($product->name == 'E-Wallet')
                            <i class="bi bi-wallet2" style="font-size: 50px;"></i>
                        @elseif ($product->name == 'Transaksi')
                            <i class="bi bi-cart" style="font-size: 50px;"></i>
                        @elseif ($product->name == 'Pembayaran Pascabayar')
                            <i class="bi bi-credit-card" style="font-size: 50px;"></i>
                        @elseif ($product->name == 'Top Up Game')
                            <i class="bi bi-controller" style="font-size: 50px;"></i>
                        @elseif ($product->name == 'Voucher')
                            <i class="bi bi-ticket-perforated" style="font-size: 50px;"></i>
                        @elseif ($product->name == 'Aksesoris')
                            <i class="bi bi-box" style="font-size: 50px;"></i>
                        @endif
                        <h5 class="card-title">{{$product->name}}</h5>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
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
