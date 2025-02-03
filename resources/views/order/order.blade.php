@extends('layouts.app')

@section('title', 'Orders - Alpin Cell')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">Orders</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Orders</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <button class="btn btn-primary d-flex align-items-center gap-2">
                        <i class="bi bi-download"></i>
                        Export Orders
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Types Menu -->
    <div class="row mb-4">
        <!-- Dummy Data with Icons -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="#" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-phone" style="font-size: 50px;"></i>
                        <h5 class="card-title">Pulsa</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="#" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-wallet2" style="font-size: 50px;"></i>
                        <h5 class="card-title">E-wallet</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="#" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-cart" style="font-size: 50px;"></i>
                        <h5 class="card-title">Transaksi</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="#" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-credit-card" style="font-size: 50px;"></i>
                        <h5 class="card-title">Pembayaran</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="#" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-controller" style="font-size: 50px;"></i>
                        <h5 class="card-title">Top Up Game</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="#" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-ticket-perforated" style="font-size: 50px;"></i>
                        <h5 class="card-title">Voucher</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="#" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-box" style="font-size: 50px;"></i>
                        <h5 class="card-title">Accessories</h5>
                    </div>
                </a>
            </div>
        </div>
        <!-- Additional Box for 'Lainnya' -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <a href="#" class="text-decoration-none">
                    <div class="card-body text-center">
                        <i class="bi bi-three-dots" style="font-size: 50px;"></i>
                        <h5 class="card-title">Lainnya</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="card-title mb-0">Order Details</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date & Time</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#ORD12345</td>
                            <td>2024-02-03 14:30</td>
                            <td>John Doe</td>
                            <td>Pulsa</td>
                            <td>Rp 50.000</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>
                                <button class="btn btn-sm btn-light" data-bs-toggle="tooltip" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-light" data-bs-toggle="tooltip" title="Print">
                                    <i class="bi bi-printer"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <nav class="mt-4">
                <ul class="pagination justify-content-end">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
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
