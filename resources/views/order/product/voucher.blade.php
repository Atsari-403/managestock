@extends('layouts.app')

@section('title', 'Voucher Konter HP')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">Voucher Konter HP</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Voucher Konter HP</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Tampilkan provider saja -->
    <div class="row mb-4">
        @foreach(['Telkomsel', 'Indosat', 'XL', 'Axis', 'Smartfren', 'Tri'] as $brand)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">{{ $brand }}</h5>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#purchaseModal" data-brand="{{ $brand }}">
                            <i class="bi bi-bag-plus"></i> Beli Voucher
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal Input Pembelian Voucher -->
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> 
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="purchaseModalLabel">Input Pembelian Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <!-- Menyimpan data provider yang dipilih -->
                    <input type="hidden" name="brand" id="selectedBrand">
                    
                    <div class="mb-3">
                        <label for="type" class="form-label">Jenis Voucher</label>
                        <input type="text" class="form-control" id="type" name="type" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga Voucher</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


