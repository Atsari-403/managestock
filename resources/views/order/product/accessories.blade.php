@extends('layouts.app')

@section('title', 'Aksesoris')

@section('styles')
<link href="{{ asset('css/aksesoris.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">Aksesoris</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Aksesoris</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Accessories Grid -->
    <div class="row">
        <!-- Headset -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-headphones fs-2 text-primary"></i>
                        </div>
                        <h5 class="card-title mb-0">Headset</h5>
                    </div>
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalAksesoris">
                        Beli Headset
                    </button>
                </div>
            </div>
        </div>

        <!-- Kabel Data -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="bi bi-lightning-charge fs-2 text-success"></i>
                        </div>
                        <h5 class="card-title mb-0">Kabel Data</h5>
                    </div>
                    <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#modalAksesoris">
                        Beli Kabel Data
                    </button>
                </div>
            </div>
        </div>

        <!-- Charger -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                            <i class="bi bi-battery-charging fs-2 text-warning"></i>
                        </div>
                        <h5 class="card-title mb-0">Charger</h5>
                    </div>
                    <button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#modalAksesoris">
                        Beli Charger
                    </button>
                </div>
            </div>
        </div>

        <!-- OTG -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                            <i class="bi bi-usb fs-2 text-danger"></i>
                        </div>
                        <h5 class="card-title mb-0">OTG</h5>
                    </div>
                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#modalAksesoris">
                        Beli OTG
                    </button>
                </div>
            </div>
        </div>

        <!-- Kalung HP -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                            <i class="bi bi-key fs-2 text-info"></i>
                        </div>
                        <h5 class="card-title mb-0">Kalung HP</h5>
                    </div>
                    <button type="button" class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#modalAksesoris">
                        Beli Kalung HP
                    </button>
                </div>
            </div>
        </div>

        <!-- Sarung Jempol -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-secondary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-hand-thumbs-up fs-2 text-secondary"></i>
                        </div>
                        <h5 class="card-title mb-0">Sarung Jempol</h5>
                    </div>
                    <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#modalAksesoris">
                        Beli Sarung Jempol
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Aksesoris -->
    <div class="modal fade" id="modalAksesoris" tabindex="-1" aria-labelledby="modalAksesorisLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAksesorisLabel">Pembelian Aksesoris</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="amount" class="form-label">Nominal Pembayaran</label>
                            <input type="number" class="form-control" id="amount" placeholder="Masukkan nominal" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">Konfirmasi Pembelian</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection