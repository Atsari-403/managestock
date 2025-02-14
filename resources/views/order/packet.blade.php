@extends('layouts.app')

@section('title', 'Daftar Paket - ' . $category->name)

@section('styles')
<link href="{{ asset('css/indexCategory.css') }}" rel="stylesheet">
<!-- Tambahkan Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<style>
    /* Styling untuk Card Paket */
    .card {
        transition: all 0.3s ease-in-out;
        border-radius: 12px;
        overflow: hidden;
        border: none;
        position: relative; /* Supaya tombol Beli bisa diposisikan di dalamnya */
    }

    /* Hover Efek */
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
    }

    /* Judul Paket */
    .card-title {
        font-size: 18px;
        font-weight: bold;
        font-family: 'Poppins', sans-serif;
        color: rgba(0, 123, 255, 0.85); /* Biru lebih soft */
    }

    /* Badge Stok */
    .badge-stock {
        background-color: #28a745;
        color: rgba(255, 255, 255, 0.85);
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 14px;
    }

    /* Harga */
    .card-text strong {
        color: rgba(33, 37, 41, 0.85);
        font-weight: 600;
    }

    /* Tombol Beli */
    .btn-buy {
        background: linear-gradient(135deg, #007bff, #00d4ff);
        color: rgba(255, 255, 255, 0.9);
        font-weight: bold;
        border: none;
        padding: 8px 15px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s ease-in-out;
        position: absolute;
        bottom: 15px;
        right: 15px;
    }

    .btn-buy:hover {
        background: linear-gradient(135deg, #0056b3, #00a3cc);
        color: white;
    }

    /* Ikon dalam tombol */
    .btn-buy i {
        font-size: 18px;
    }
    .w-60 {
        width: 60%;
    }

     /* Custom Modal Style */
    #purchaseModal .modal-content {
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    }

    #purchaseModal .modal-title {
        color: #007bff;
        font-weight: bold;
    }

    #purchaseModal .form-select, 
    #purchaseModal .form-control {
        border-radius: 10px;
    }

</style>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="{{ $category->name }}"></x-dashboard-header>

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
    @if ($pakets->isEmpty())
        @if ($product && !in_array($product->name, ["Aksesoris", "Kartu", "Voucher"]))
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{"Custome ". $category->name ?? 'Paket Custom' }}</h5>
                    <form action="#" method="post">
                        @csrf
                        <div class="mb-3">
                            <span class="badge badge-stock">Alpin Cell</span>
                        </div>
                        <div class="mb-1">
                            <input type="number" class="form-control w-60 custom-price-input" name="harga" id="harga" placeholder="harga" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-n2">
                            <button class="btn btn-buy" data-bs-toggle='modal' data-bs-target='#purchaseModal'>
                                <i class="bi bi-cart"></i> Beli
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @else
            <div class="alert alert-warning text-center">Tidak ada Paket dalam Category ini.</div>
        @endif
    @else
        <div class="row g-4">
            @if ($product && !in_array($product->name, ["Aksesoris", "Kartu", "Voucher"]))
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{"Custome ". $category->name ?? 'Paket Custom' }}</h5>
                        <form action="#" method="post">
                            @csrf
                            <div class="mb-3">
                                <span class="badge badge-stock">Alpin Cell</span>
                            </div>
                            <div class="mb-1">
                                <input type="number" class="form-control w-60 custom-price-input" name="harga" id="harga" placeholder="harga" required>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-n2">
                                <button class="btn btn-buy" data-bs-toggle='modal' data-bs-target='#purchaseModal'>
                                    <i class="bi bi-cart"></i> Beli
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @foreach ($pakets as $paket)
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $paket->name }}</h5>
                        <p class="card-text">
                            @php
                                $stock = $paket->stock ?? null;
                            @endphp

                            @if (is_null($stock))
                                <span class="badge badge-stock">Alpin Cell</span>
                            @elseif ($stock === 0)
                                <span class="badge badge-stock" style="background-color: red;">Stok: {{ $stock }}</span>
                            @else
                                <span class="badge badge-stock">Stok: {{ $stock }}</span>
                            @endif
                        </p>
                        <p class="card-text">
                            <strong>Harga:</strong> Rp {{ number_format($paket->price , 0, ',', '.') }} <br>
                        </p>
                        <!-- Tombol Beli di sudut kanan bawah -->
                        <button class="btn btn-buy" data-bs-toggle='modal' data-bs-target='#purchaseModal'">
                            <i class="bi bi-cart"></i> Beli
                        </button>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Modal Form Pembayaran -->
            <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-topped">
                    <div class="modal-content">
                        <!-- Header Modal -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="purchaseModalLabel">Form Pembelian</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Form Pembelian -->
                        <div class="modal-body">
                            <form action="" method="POST">
                                @csrf
                                <!-- Metode Pembayaran -->
                                <div class="mb-3">
                                    <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                    <select class="form-select" name="payment_method" id="payment_method" required>
                                        <option value="" disabled selected>Pilih metode pembayaran</option>
                                        <option value="1">Transfer</option>
                                        <option value="0">Tunai</option>
                                    </select>
                                </div>

                                <!-- Aksi -->
                                <div class="mb-3">
                                    <label for="action" class="form-label">Aksi</label>
                                    <select class="form-select" name="action" id="action" required>
                                        <option value="" disabled selected>Pilih aksi</option>
                                        <option value="tarik_tunai">Tarik Tunai</option>
                                        <option value="transfer">Transfer</option>
                                    </select>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle"></i> Submit Pembelian
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        @endif
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
