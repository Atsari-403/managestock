@extends('layouts.app')

@section('title', 'Riwayat Order - Alpin Cell')

@section('styles')
<link href="{{ asset('css/riwayatOrder.css') }}" rel="stylesheet">
<style>
    /* Custom pagination styles */
    .pagination {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 5px;
    }
    
    .pagination .page-item {
        margin: 2px;
    }
    
    .pagination .page-item .page-link {
        border-radius: 4px;
        min-width: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px;
        font-size: 0.875rem;
    }
    
    /* Hide page numbers on smaller screens, just keep prev/next and active */
    @media (max-width: 576px) {
        .pagination .page-item:not(.active):not(.disabled):not(.prev):not(.next) {
            display: none;
        }
        
        .pagination .page-item.active {
            order: 2;
        }
        
        .pagination .page-item.prev {
            order: 1;
        }
        
        .pagination .page-item.next {
            order: 3;
        }
        
        .pagination .page-item.active .page-link:after {
            content: " / {{ $orders->lastPage() }}";
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header with animated border -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-0 d-flex align-items-center">
                        <i class="bi bi-clock-history me-2 text-primary"></i>
                        Riwayat Order
                    </h3>
                    <p class="text-muted mt-2 mb-0">Menampilkan seluruh riwayat transaksi order</p>
                </div>
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Riwayat Order with improved UI -->
    <div class="card filter-card mb-4 border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">
                <i class="bi bi-funnel text-primary me-2"></i>
                Filter Riwayat Order
            </h5>
        </div>
        <div class="card-body">
            <form method="GET" action="#">
                <div class="row g-3">
                    <!-- Filter Berdasarkan User -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user_id" class="form-label text-muted">
                                <i class="bi bi-person me-1"></i> Filter berdasarkan User
                            </label>
                            <select name="user_id" id="user_id" class="form-select shadow-sm">
                                <option value="">Semua User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>                        
                        </div>
                    </div>

                    <!-- Filter Berdasarkan Paket -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paket_id" class="form-label text-muted">
                                <i class="bi bi-box me-1"></i> Filter berdasarkan Paket
                            </label>
                            <select name="paket_id" id="paket_id" class="form-select shadow-sm">
                                <option value="">Semua Paket</option>
                                @foreach ($pakets as $paket)
                                    <option value="{{ $paket->id }}" {{ request('paket_id') == $paket->id ? 'selected' : '' }}>
                                        {{ $paket->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Filter Berdasarkan Tanggal -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date" class="form-label text-muted">
                                <i class="bi bi-calendar-date me-1"></i> Filter berdasarkan Tanggal
                            </label>
                            <input type="date" name="date" id="date" class="form-control shadow-sm" value="{{ request('date') }}">
                        </div>
                    </div>

                    <div class="col-md-12 d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary btn-filter">
                            <i class="bi bi-funnel"></i> Filter Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Riwayat Order with enhanced styling -->
    <div class="card data-card mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-table text-primary me-2"></i>
                Data Riwayat Order
            </h5>
            <span class="badge bg-primary">{{ $orders->total() }} Entri</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-hover custom-table align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col">User</th>
                            <th scope="col">Paket</th>
                            <th scope="col" class="text-center">Qty</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Metode Pembayaran</th>
                            <th scope="col">Action</th>
                            <th scope="col">Tanggal dan Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm bg-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                            {{ substr($order->user->name, 0, 1) }}
                                        </div>
                                        <span>{{ $order->user->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $order->paket->name ?? 'Paket Tidak Tersedia' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">{{ $order->qty }}</span>
                                </td>
                                <td>
                                    <strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong>
                                </td>
                                <td>
                                    <span class="badge {{ $order->payment_method ? 'bg-success' : 'bg-info' }} badge-payment">
                                        <i class="bi {{ $order->payment_method ? 'bi-cash' : 'bi-credit-card' }} me-1"></i>
                                        {{ $order->payment_method ? 'Tunai' : 'Transfer' }}
                                    </span>
                                </td>
                                <td>
                                    @if($order->action === null)
                                        <span class="badge bg-secondary badge-payment">Bukan Transaksi</span>
                                    @elseif($order->action)
                                        <span class="badge bg-warning text-dark badge-payment">
                                            <i class="bi bi-arrow-up-circle me-1"></i> Tarik Tunai
                                        </span>
                                    @else
                                        <span class="badge bg-primary badge-payment">
                                            <i class="bi bi-arrow-down-circle me-1"></i> Transfer
                                        </span>
                                    @endif
                                </td>                                
                                <td>
                                    <div class="d-flex align-items-center">
                                        {{ $order->created_at->format('d M Y') }}
                                        <span class="ms-2 text-muted small">{{ $order->created_at->format('H:i') }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="text-center">
                                        <i class="bi bi-clipboard-x text-muted" style="font-size: 3rem;"></i>
                                        <p class="mt-3 mb-0">Tidak ada riwayat order ditemukan</p>
                                        <p class="text-muted small">Coba atur ulang filter untuk melihat data</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination dengan kemampuan responsif -->
            @if($orders->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{-- Tombol Previous --}}
                        <li class="page-item prev {{ $orders->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $orders->previousPageUrl() }}" aria-label="Previous">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>
                        
                        {{-- Tampilkan halaman pertama jika tidak di halaman pertama dan dengan jarak lebih dari 2 --}}
                        @if($orders->currentPage() > 3)
                            <li class="page-item d-none d-sm-flex">
                                <a class="page-link" href="{{ $orders->url(1) }}">1</a>
                            </li>
                            
                            @if($orders->currentPage() > 4)
                                <li class="page-item disabled d-none d-sm-flex">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                        @endif
                        
                        {{-- Tampilkan halaman sebelum, halaman aktif, dan halaman setelah --}}
                        @for($i = max(1, $orders->currentPage() - 1); $i <= min($orders->lastPage(), $orders->currentPage() + 1); $i++)
                            <li class="page-item {{ $i == $orders->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        
                        {{-- Tampilkan halaman terakhir jika tidak di halaman terakhir dan dengan jarak lebih dari 2 --}}
                        @if($orders->currentPage() < $orders->lastPage() - 2)
                            @if($orders->currentPage() < $orders->lastPage() - 3)
                                <li class="page-item disabled d-none d-sm-flex">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                            
                            <li class="page-item d-none d-sm-flex">
                                <a class="page-link" href="{{ $orders->url($orders->lastPage()) }}">{{ $orders->lastPage() }}</a>
                            </li>
                        @endif
                        
                        {{-- Tombol Next --}}
                        <li class="page-item next {{ $orders->currentPage() == $orders->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $orders->nextPageUrl() }}" aria-label="Next">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection