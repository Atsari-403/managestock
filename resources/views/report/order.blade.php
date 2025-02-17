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
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>                        
                    </div>

                    <!-- Filter Berdasarkan Paket -->
                    <div class="col-md-4">
                        <label for="paket_id" class="form-label">Filter berdasarkan Paket</label>
                        <select name="paket_id" id="paket_id" class="form-select">
                            <option value="">Semua Paket</option>
                            @foreach ($pakets as $paket)
                                <option value="{{ $paket->id }}" {{ request('paket_id') == $paket->id ? 'selected' : '' }}>
                                    {{ $paket->name }}
                                </option>
                            @endforeach
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
                            <th>Action</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->paket->name }}</td>
                                <td>{{ $order->qty }}</td>
                                <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                <td>{{ $order->payment_method ? 'Tunai' : 'Transfer' }}</td>
                                <td>
                                    {{ $order->action === null ? 'Bukan Transaksi' : ($order->action ? 'Tarik Tunai' : 'Transfer') }}
                                </td>                                
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada riwayat order ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                    
                </table>
            </div>

            <!-- Pagination Dummy -->
            <div class="d-flex justify-content-center mt-3">
                {{ $orders->appends(request()->input())->links('pagination::bootstrap-4') }}
            </div>           
        </div>
    </div>
</div>
@endsection
