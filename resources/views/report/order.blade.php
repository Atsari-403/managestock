@extends('layouts.app')

@section('title', 'Riwayat Order - Alpin Cell')

@section('styles')
<link href="{{ asset('css/indexCategory.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="Riwayat Order"></x-dashboard-header>

    <!-- Filter Riwayat Order -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="#">
                <div class="row">
                    <!-- Filter Berdasarkan User -->
                    <div class="col-md-4">
                        <label for="user_id" class="form-label">Filter berdasarkan User</label>
                        <select name="user_id" id="user_id" class="form-select">
                            <option value="">Semua User</option>
                            <option value="1">User 1</option>
                            <option value="2">User 2</option>
                            <option value="3">User 3</option>
                        </select>
                    </div>

                    <!-- Filter Berdasarkan Paket -->
                    <div class="col-md-4">
                        <label for="paket_id" class="form-label">Filter berdasarkan Paket</label>
                        <select name="paket_id" id="paket_id" class="form-select">
                            <option value="">Semua Paket</option>
                            <option value="1">Paket Silver</option>
                            <option value="2">Paket Gold</option>
                            <option value="3">Paket Platinum</option>
                        </select>
                    </div>

                    <!-- Filter Berdasarkan Tanggal -->
                    <div class="col-md-4">
                        <label for="date" class="form-label">Filter berdasarkan Tanggal</label>
                        <input type="date" name="date" id="date" class="form-control">
                    </div>

                    <div class="col-md-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Riwayat Order -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Paket</th>
                            <th>Qty</th>
                            <th>Total Harga</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>User 1</td>
                            <td>Paket Silver</td>
                            <td>2</td>
                            <td>Rp 50.000</td>
                            <td>Transfer</td>
                            <td><span class="badge bg-success">Selesai</span></td>
                            <td>15 Feb 2025 10:30</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>User 2</td>
                            <td>Paket Gold</td>
                            <td>1</td>
                            <td>Rp 75.000</td>
                            <td>Cash</td>
                            <td><span class="badge bg-warning">Menunggu</span></td>
                            <td>14 Feb 2025 15:45</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>User 3</td>
                            <td>Paket Platinum</td>
                            <td>3</td>
                            <td>Rp 120.000</td>
                            <td>Transfer</td>
                            <td><span class="badge bg-success">Selesai</span></td>
                            <td>13 Feb 2025 08:15</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Dummy -->
            <div class="d-flex justify-content-center mt-3">
                <nav>
                    <ul class="pagination">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
