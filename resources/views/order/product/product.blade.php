@extends('layouts.app')

@section('title', 'Product - Pulsa')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">Pulsa</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a></li>
                            {{-- <li class="breadcrumb-item"><a href="{{ route('orders') }}" class="text-decoration-none">Orders</a></li> --}}
                            <li class="breadcrumb-item active" aria-current="page">Pulsa</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Packages for Pulsa -->
    <div class="row mb-4">
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Paket Pulsa 10.000</h5>
                    <p class="card-text">Harga: Rp 12.000</p>
                    <a href="#" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#formPulsa" aria-expanded="false" aria-controls="formPulsa">
                        Beli Pulsa
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Paket Pulsa 20.000</h5>
                    <p class="card-text">Harga: Rp 22.000</p>
                    <a href="#" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#formPulsa" aria-expanded="false" aria-controls="formPulsa">
                        Beli Pulsa
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Paket Pulsa 50.000</h5>
                    <p class="card-text">Harga: Rp 55.000</p>
                    <a href="#" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#formPulsa" aria-expanded="false" aria-controls="formPulsa">
                        Beli Pulsa
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Form to Input Phone Number (Collapse) -->
    <div class="collapse" id="formPulsa">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0">Isi Nomor Telepon</h5>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phoneNumber" placeholder="Masukkan nomor telepon" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">Konfirmasi Pembelian</button>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#formPulsa">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
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

.card-body .btn-primary {
    width: 100%;
}

.card-body .form-control {
    border-radius: 8px;
}

.card-body .d-flex button {
    width: 48%;
}
</style>
@endsection
