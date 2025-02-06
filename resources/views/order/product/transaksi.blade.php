@extends('layouts.app')

@section('title', 'Transaksi')

@section('styles')
<link href="{{ asset('css/transaksi.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-0">Transaksi</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Transaction Options -->
    <div class="row mb-4">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Tarik Uang</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTarikUang">
                        Tarik Uang
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Transfer Antar Bank</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTransferBank">
                        Transfer Bank
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Tarik Uang -->
    <div class="modal fade" id="modalTarikUang" tabindex="-1" aria-labelledby="modalTarikUangLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTarikUangLabel">Tarik Uang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="providerTarik" class="form-label">Pilih Jenis Bank/E-Wallet</label>
                            <select class="form-select" id="providerTarik" required>
                                <option value="" disabled selected>Pilih</option>
                                <option value="dana">Dana</option>
                                <option value="bri">BRI</option>
                                <option value="bni">BNI</option>
                                <option value="mandiri">Mandiri</option>
                                <option value="bca">BCA</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="amountTarik" class="form-label">Jumlah Tarik Uang</label>
                            <input type="number" class="form-control" id="amountTarik" placeholder="Masukkan jumlah" required>
                        </div>

                        <div class="mb-3">
                            <p id="totalTarik" class="fw-bold">Total Bayar: Rp 0</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">Konfirmasi Tarik Uang</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Transfer Bank -->
    <div class="modal fade" id="modalTransferBank" tabindex="-1" aria-labelledby="modalTransferBankLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTransferBankLabel">Transfer Antar Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="providerTransfer" class="form-label">Pilih Bank/E-Wallet</label>
                            <select class="form-select" id="providerTransfer" required>
                                <option value="" disabled selected>Pilih</option>
                                <option value="dana">Dana</option>
                                <option value="bri">BRI</option>
                                <option value="bni">BNI</option>
                                <option value="mandiri">Mandiri</option>
                                <option value="bca">BCA</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="transferAmount" class="form-label">Jumlah Transfer</label>
                            <input type="number" class="form-control" id="transferAmount" placeholder="Masukkan jumlah" required>
                        </div>

                        <div class="mb-3">
                            <p id="totalTransfer" class="fw-bold">Total Bayar: Rp 0</p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">Konfirmasi Transfer</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="{{ asset('js/transaksi.js') }}"></script>
@endsection

