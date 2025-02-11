@extends('layouts.app')

@section('title', 'Orders - Alpin Cell')

@section('styles')
<link href="{{ asset('css/indexProduct.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="Orders"></x-dashboard-header>

    <!-- Product Types Menu -->
    <div class="row g-4">
        @foreach ($products as $product)      
        <div class="col-md-3 col-sm-6">
            <div class="feature-card">
                <a href="{{route('categoryorder',['idProduct'=>$product->id])}}" class="text-decoration-none">
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
                            @elseif ($product->name == 'Kartu')
                                <i class="bi bi-sim"></i>
                            @endif
                        </div>
                        <h5 class="feature-title">{{$product->name}}</h5>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection