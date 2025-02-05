@extends('layouts.app')

@section('title', 'Pembayaran Pascabayar')

@section('styles')
<link href="{{ asset('css/pembayaran.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="Pembayaran Pascabayar"></x-dashboard-header>

    <!-- Payment Grid -->
    <div class="row">
        <!-- PDAM -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                            <i class="bi bi-water fs-2 text-info"></i>
                        </div>
                        <h5 class="card-title mb-0">PDAM</h5>
                    </div>
                    <button type="button" class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#modalPembayaran" aria-expanded="false" aria-controls="modalPembayaran">
                        Bayar PDAM
                    </button>
                </div>
            </div>
        </div>

        <!-- PLN -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                            <i class="bi bi-lightning fs-2 text-warning"></i>
                        </div>
                        <h5 class="card-title mb-0">PLN</h5>
                    </div>
                    <button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#modalPembayaran" aria-expanded="false" aria-controls="modalPembayaran">
                        Bayar PLN
                    </button>
                </div>
            </div>
        </div>

        <!-- BPJS -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="bi bi-heart fs-2 text-success"></i>
                        </div>
                        <h5 class="card-title mb-0">BPJS</h5>
                    </div>
                    <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#modalPembayaran" aria-expanded="false" aria-controls="modalPembayaran">
                        Bayar BPJS
                    </button>
                </div>
            </div>
        </div>

        <!-- Indihome -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                            <i class="bi bi-wifi fs-2 text-danger"></i>
                        </div>
                        <h5 class="card-title mb-0">Indihome</h5>
                    </div>
                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#modalPembayaran" aria-expanded="false" aria-controls="modalPembayaran">
                        Bayar Indihome
                    </button>
                </div>
            </div>
        </div>

        <!-- Angsuran Kredit -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-secondary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-credit-card fs-2 text-secondary"></i>
                        </div>
                        <h5 class="card-title mb-0">Angsuran Kredit</h5>
                    </div>
                    <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#modalPembayaran" aria-expanded="false" aria-controls="modalPembayaran">
                        Bayar Angsuran
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Pembayaran -->
    <div class="modal fade" id="modalPembayaran" tabindex="-1" aria-labelledby="modalPembayaranLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPembayaranLabel">Pembayaran Pascabayar</h5>
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
                            <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection