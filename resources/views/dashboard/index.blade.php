@extends('layouts.app')

@section('title', 'Dashboard - Alpin Cell')

@section('styles')
<link href="{{ asset('css/dashboard/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-3">
    <!-- Header with animated border -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-0 d-flex align-items-center">
                        <i class="bi bi-graph-up me-2 text-primary"></i>
                        Dashboard
                    </h3>
                    <p class="text-muted mt-2 mb-0">aktivitas dan transaksi terkini</p>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards with equal height -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card bg-primary text-white">
                <div class="stats-card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0 fw-bold">RP {{$netDigital}}</h3>
                            <p class="text-white-70 mb-0">Transaksi QRIS Hari Ini</p>
                        </div>
                        <div class="stats-icon">
                            <i class="bi bi-phone"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card bg-success text-white">
                <div class="stats-card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0 fw-bold">RP {{$netCash}}</h3>
                            <p class="text-white-70 mb-0">Transaksi Cash Hari Ini</p>
                        </div>
                        <div class="stats-icon">
                            <i class="bi bi-cash"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card bg-info text-white">
                <div class="stats-card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0 fw-bold">Rp {{$totalPendapatanBersih}}</h3>
                            <p class="text-white-70 mb-0">Pendapatan Hari Ini</p>
                        </div>
                        <div class="stats-icon">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card bg-warning text-white">
                <div class="stats-card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0 fw-bold">{{$productTerjual}}</h3>
                            <p class="text-white-70 mb-0">Produk Terjual</p>
                        </div>
                        <div class="stats-icon">
                            <i class="bi bi-box"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <!-- Recent Transactions -->
            <div class="card data-card mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 d-flex align-items-center">
                        <i class="bi bi-receipt text-primary me-2"></i>
                        Transaksi Terbaru
                    </h5>
                    <a href="#" class="btn btn-primary btn-sm">
                        <i class="bi bi-eye me-1"></i> Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless table-hover custom-table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span>Pulsa 50k</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-check me-2 text-muted"></i>
                                            2024-02-02
                                        </div>
                                    </td>
                                    <td><strong>Rp 52.000</strong></td>
                                    <td>
                                        <span class="badge bg-success badge-status">
                                            <i class="bi bi-check-circle me-1"></i> Success
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm action-btn">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm action-btn">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span>Top Up PUBG</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-check me-2 text-muted"></i>
                                            2024-02-02
                                        </div>
                                    </td>
                                    <td><strong>Rp 100.000</strong></td>
                                    <td>
                                        <span class="badge bg-warning text-dark badge-status">
                                            <i class="bi bi-hourglass-split me-1"></i> Pending
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm action-btn">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm action-btn">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span>Aksesoris HP</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-check me-2 text-muted"></i>
                                            2024-02-02
                                        </div>
                                    </td>
                                    <td><strong>Rp 75.000</strong></td>
                                    <td>
                                        <span class="badge bg-success badge-status">
                                            <i class="bi bi-check-circle me-1"></i> Success
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm action-btn">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm action-btn">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white text-muted small py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-info-circle me-1"></i> Menampilkan 3 transaksi terbaru
                        </div>
                        <div>
                            Last updated: {{ now()->format('d M Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection