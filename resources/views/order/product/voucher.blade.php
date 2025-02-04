@extends('layouts.app')

@section('title', 'Voucher Konter HP')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Voucher Konter HP</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#purchaseModal">
                <i class="bi bi-cart-plus"></i> Input Pembelian
            </button>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach(['Telkomsel', 'Indosat', 'XL', 'Axis', 'Smartfren'] as $brand)
            @foreach([5000, 10000, 25000, 50000, 100000, 150000] as $nominal)
                <div class="col">
                    <div class="card h-100 border-primary">
                        <div class="card-header bg-primary text-white text-center">
                            <h5 class="mb-0">{{ $brand }}</h5>
                        </div>
                        <div class="card-body text-center">
                            <h4>Rp {{ number_format($nominal, 0, ',', '.') }}</h4>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#purchaseModal">
                                <i class="bi bi-bag-plus"></i> Beli Voucher
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>

<!-- Modal Input Pembelian -->
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="purchaseModalLabel">Input Pembelian Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Karyawan</label>
                        <input type="text" name="employee_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Pembeli</label>
                        <input type="text" name="buyer_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor HP Pembeli</label>
                        <input type="text" name="buyer_phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Brand Voucher</label>
                        <select name="brand" class="form-select" required>
                            <option>Telkomsel</option>
                            <option>Indosat</option>
                            <option>XL</option>
                            <option>Axis</option>
                            <option>Smartfren</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nominal Voucher</label>
                        <select name="nominal" class="form-select" required>
                            <option>5000</option>
                            <option>10000</option>
                            <option>25000</option>
                            <option>50000</option>
                            <option>100000</option>
                            <option>150000</option>
                        </select>
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
