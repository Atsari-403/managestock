@extends('layouts.app')

@section('content')

@section('styles')
<link href="{{ asset('css/reports/income.css') }}" rel="stylesheet">
@endsection

<div class="container-fluid mt-4">
    <x-dashboard-header
       title="Laporan Pendapatan"
       description="Laporan pendapatan karyawan dan produk"
       icon="bi bi-currency-dollar">
    </x-dashboard-header>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-4 mb-md-0 fade-in-up" style="animation-delay: 0.1s">
            <div class="card stat-card primary-gradient text-white income-icon">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Total Pendapatan</h5>
                        <div class="icon-circle bg-white bg-opacity-25 rounded-circle p-2">
                            <i class="bi bi-currency-dollar fs-4"></i>
                        </div>
                    </div>
                    <h3 class="counter-value mt-3 mb-0">Rp.0</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 mb-md-0 fade-in-up" style="animation-delay: 0.2s">
            <div class="card stat-card success-gradient text-white sales-icon">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Total Penjualan</h5>
                        <div class="icon-circle bg-white bg-opacity-25 rounded-circle p-2">
                            <i class="bi bi-cart-check fs-4"></i>
                        </div>
                    </div>
                    <h3 class="counter-value mt-3 mb-0">Rp.0</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 mb-md-0 fade-in-up" style="animation-delay: 0.3s">
            <div class="card stat-card info-gradient text-white product-icon">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Produk Terjual</h5>
                        <div class="icon-circle bg-white bg-opacity-25 rounded-circle p-2">
                            <i class="bi bi-box fs-4"></i>
                        </div>
                    </div>
                    <h3 class="counter-value mt-3 mb-0">Rp.0</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 mb-md-0 fade-in-up" style="animation-delay: 0.4s">
            <div class="card stat-card warning-gradient text-white average-icon">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Rata-rata Penjualan</h5>
                        <div class="icon-circle bg-white bg-opacity-25 rounded-circle p-2">
                            <i class="bi bi-graph-up fs-4"></i>
                        </div>
                    </div>
                    <h3 class="counter-value mt-3 mb-0">Rp.0</h3>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Report Card -->
    <div class="row fade-in-up" style="animation-delay: 0.5s">
        <div class="col-12">
            <div class="card main-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0"><i class="bi bi-bar-chart-line me-2"></i>Laporan Pendapatan</h4>
                    {{-- <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-primary btn-custom">
                            <i class="bi bi-envelope me-1"></i> Lapor ke Admin
                        </button>
                    </div> --}}
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card filter-card">
                                <div class="card-body">
                                    <h5 class="mb-3 text-primary"><i class="bi bi-funnel me-2"></i>Filter Data</h5>
                                    <form action="#" method="GET" class="row g-3">
                                        <div class="col-md-3">
                                            <label for="stock_id" class="form-label fw-semibold"><i class="bi bi-box-seam me-1"></i>Stok</label>
                                            <select name="stock_id" id="stock_id" class="form-select custom-form-control">
                                                <option value="">Semua Produk</option>
                                                <option value="1">Voucher Telkomsel</option>
                                                <option value="2">Top Up game</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="user_id" class="form-label fw-semibold"><i class="bi bi-person me-1"></i>User</label>
                                            <select name="user_id" id="user_id" class="form-select custom-form-control">
                                                <option value="">Semua User</option>
                                                <option value="1">Karyawan A</option>
                                                <option value="2">Karyawan B</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="date_from" class="form-label fw-semibold"><i class="bi bi-calendar-event me-1"></i>Dari Tanggal</label>
                                            <input type="date" class="form-control custom-form-control" id="date_from" name="date_from">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="date_to" class="form-label fw-semibold"><i class="bi bi-calendar-event-fill me-1"></i>Sampai Tanggal</label>
                                            <input type="date" class="form-control custom-form-control" id="date_to" name="date_to">
                                        </div>
                                        <div class="col-12 mt-3 text-end">
                                            <button type="submit" class="btn btn-primary btn-custom">
                                                <i class="bi bi-search me-1"></i> Filter
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Table Section with Improved Design -->
                    <div class="table-responsive">
                        <table class="table table-custom table-hover">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-box me-2"></i>Produk</th>
                                    <th><i class="bi bi-person-badge me-2"></i>Karyawan</th>
                                    <th><i class="bi bi-calendar me-2"></i>Tanggal</th>
                                    <th><i class="bi bi-cash-stack me-2"></i>Pendapatan</th>
                                    <th><i class="bi bi-cart me-2"></i>Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="bi bi-box text-primary"></i>
                                            </div>
                                            <div>
                                                <span class="fw-medium d-block">Top up Dana 5Ok</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">KA</div>
                                            <span>Karyawan A</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">01/01/2023</span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold text-success">Rp 100,000</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary badge-custom">5 unit</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="bi bi-box text-primary"></i>
                                            </div>
                                            <div>
                                                <span class="fw-medium d-block">Voucher 30 GB Internet</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-info text-white rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">KB</div>
                                            <span>Karyawan B</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">02/01/2023</span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold text-success">Rp 200,000</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary badge-custom">10 unit</span>
                                    </td>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>
                            <span class="text-muted">Menampilkan 1-2 dari 2 data</span>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                        <i class="bi bi-chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Animated counter effect
        $('.counter-value').each(function() {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 1500,
                easing: 'swing',
                step: function(now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
        
        // Tooltip initialization
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection