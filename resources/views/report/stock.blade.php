@extends('layouts.app')

@section('title', 'Riwayat Perubahan Stok - Alpin Cell')

@section('styles')
<link href="{{ asset('css/historyStock.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header with animated border -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-0 d-flex align-items-center">
                        <i class="bi bi-box-seam me-2 text-primary"></i>
                        Riwayat Perubahan Stok
                    </h3>
                    <p class="text-muted mt-2 mb-0">Menampilkan seluruh perubahan stok produk</p>
                </div>
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Berdasarkan Paket with improved UI -->
    <div class="card filter-card mb-4 border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">
                <i class="bi bi-funnel text-primary me-2"></i>
                Filter Perubahan Stok
            </h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{route('historyStock')}}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="packet_id" class="form-label text-muted">
                                <i class="bi bi-box me-1"></i> Filter berdasarkan Nama Produk
                            </label>
                            <select name="packet_id" id="packet_id" class="form-select shadow-sm">
                                <option value="">Semua Paket</option>
                                @foreach($packets as $packet)
                                    <option value="{{ $packet->id }}" {{ request('packet_id') == $packet->id ? 'selected' : '' }}>
                                        {{ $packet->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary btn-filter">
                                <i class="bi bi-funnel"></i> Filter Data
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Riwayat Stok with enhanced styling -->
    <div class="card data-card mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-clipboard-data text-primary me-2"></i>
                Data Riwayat Perubahan Stok
            </h5>
            <span class="badge bg-primary">{{ $stockHistories->count() }} Entri</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-hover custom-table align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col">Paket</th>
                            <th scope="col" class="text-center">Stok Sebelumnya</th>
                            <th scope="col" class="text-center">Stok Baru</th>
                            <th scope="col" class="text-center">Perubahan</th>
                            <th scope="col">Tanggal dan Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stockHistories as $history)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    {{ $history->packet->name }}
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-secondary stock-badge">{{ $history->previous_stock }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-dark stock-badge">{{ $history->new_stock }}</span>
                            </td>
                            <td class="text-center">
                                <span class="{{ $history->quantity_changed > 0 ? 'stock-change-positive' : 'stock-change-negative' }}">
                                    <i class="bi {{ $history->quantity_changed > 0 ? 'bi-arrow-up-circle-fill' : 'bi-arrow-down-circle-fill' }} me-1"></i>
                                    {{ $history->quantity_changed > 0 ? '+' : '' }}{{ $history->quantity_changed }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    {{ $history->created_at->format('d M Y') }}
                                    <span class="ms-2 text-muted small">{{ $history->created_at->format('H:i') }}</span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-center">
                                    <i class="bi bi-clipboard-x text-muted" style="font-size: 3rem;"></i>
                                    <p class="mt-3 mb-0">Tidak ada riwayat perubahan stok.</p>
                                    <p class="text-muted small">Coba atur ulang filter untuk melihat data</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination block if available -->
            @if(method_exists($stockHistories, 'hasPages') && $stockHistories->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    {{ $stockHistories->appends(request()->input())->links('pagination::bootstrap-4') }}
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection