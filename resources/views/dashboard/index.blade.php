@extends('layouts.app')

@section('title', 'Dashboard - Alpin Cell')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4 mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">Dashboard</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex align-items-center">
                    <div class="dropdown me-3">
                        <button class="btn btn-light position-relative" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                3
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Notifikasi Baru</a></li>
                            <li><a class="dropdown-item" href="#">Pesanan Baru</a></li>
                            <li><a class="dropdown-item" href="#">Update Sistem</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-counter bg-primary">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">145</h3>
                        <p class="text-white-50 mb-0">Total Pelanggan</p>
                    </div>
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-counter bg-success">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">Rp 5.2M</h3>
                        <p class="text-white-50 mb-0">Total Pendapatan</p>
                    </div>
                    <i class="bi bi-wallet2"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-counter bg-info">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">234</h3>
                        <p class="text-white-50 mb-0">Transaksi Hari Ini</p>
                    </div>
                    <i class="bi bi-cart"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-counter bg-warning">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">15</h3>
                        <p class="text-white-50 mb-0">Produk Terjual</p>
                    </div>
                    <i class="bi bi-box"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Recent Transactions -->
        <div class="card border-0 shadow-sm">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Transaksi Terbaru</h5>
                        <button class="btn btn-primary btn-sm">Lihat Semua</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pelanggan</th>
                                    <th>Produk</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1234</td>
                                    <td>John Doe</td>
                                    <td>Pulsa 50k</td>
                                    <td>2024-02-02</td>
                                    <td>Rp 52.000</td>
                                    <td><span class="badge bg-success">Success</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1235</td>
                                    <td>Jane Smith</td>
                                    <td>Top Up PUBG</td>
                                    <td>2024-02-02</td>
                                    <td>Rp 100.000</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1236</td>
                                    <td>Bob Johnson</td>
                                    <td>Aksesoris HP</td>
                                    <td>2024-02-02</td>
                                    <td>Rp 75.000</td>
                                    <td><span class="badge bg-success">Success</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

            <!-- Recent Activities -->
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Aktivitas Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="activity-list">
                        <div class="activity-item d-flex align-items-start mb-3">
                            <div class="activity-icon bg-primary text-white rounded-circle p-2 me-3">
                                <i class="bi bi-person"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-medium">John Doe menambahkan transaksi baru</p>
                                <small class="text-muted">2 menit yang lalu</small>
                            </div>
                        </div>
                        <div class="activity-item d-flex align-items-start mb-3">
                            <div class="activity-icon bg-success text-white rounded-circle p-2 me-3">
                                <i class="bi bi-check"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-medium">Pembayaran berhasil dikonfirmasi</p>
                                <small class="text-muted">5 menit yang lalu</small>
                            </div>
                        </div>
                        <div class="activity-item d-flex align-items-start">
                            <div class="activity-icon bg-warning text-white rounded-circle p-2 me-3">
                                <i class="bi bi-box"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-medium">Stok produk telah diperbarui</p>
                                <small class="text-muted">10 menit yang lalu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .activity-icon {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .btn-light {
        background-color: #f8f9fa;
        border-color: #f8f9fa;
    }

    .btn-light:hover {
        background-color: #e9ecef;
        border-color: #e9ecef;
    }
</style>
@endsection