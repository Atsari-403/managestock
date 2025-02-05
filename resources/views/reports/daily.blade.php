@extends('layouts.app')

@section('title', 'Daily Report - Alpin Cell')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header  title="Report"></x-dashboard-header>

    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Date Range</label>
                            <div class="input-group">
                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                                <span class="input-group-text">to</span>
                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Transaction Type</label>
                            <select class="form-select">
                                <option value="all">All Types</option>
                                <option value="pulsa">Pulsa</option>
                                <option value="game">Top Up Game</option>
                                <option value="accessories">Accessories</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option value="all">All Status</option>
                                <option value="success">Success</option>
                                <option value="pending">Pending</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                        <!-- Report Type (Daily, Monthly, Yearly) -->
                        <div class="col-md-2">
                            <label class="form-label">Report Type</label>
                            <select class="form-select">
                                <option value="daily">Daily</option>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Apply Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-counter bg-primary">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">Rp 5.2M</h3>
                        <p class="text-white-50 mb-0">Total Revenue</p>
                    </div>
                    <i class="bi bi-currency-dollar"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-counter bg-success">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">234</h3>
                        <p class="text-white-50 mb-0">Transactions</p>
                    </div>
                    <i class="bi bi-cart"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-counter bg-info">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">95%</h3>
                        <p class="text-white-50 mb-0">Success Rate</p>
                    </div>
                    <i class="bi bi-graph-up"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card-counter bg-warning">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">45</h3>
                        <p class="text-white-50 mb-0">New Customers</p>
                    </div>
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="card-title mb-0">Transaction Details</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Date & Time</th>
                            <th>Customer</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#TRX12345</td>
                            <td>2024-02-03 14:30</td>
                            <td>John Doe</td>
                            <td>Pulsa</td>
                            <td>Rp 50.000</td>
                            <td><span class="badge bg-success">Success</span></td>
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
.card-counter {
    padding: 20px;
    border-radius: 8px;
    color: #fff;
    transition: transform 0.2s;
}

.card-counter:hover {
    transform: translateY(-5px);
}

.card-counter i {
    font-size: 32px;
    opacity: 0.8;
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