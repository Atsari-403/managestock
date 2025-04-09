@extends('layouts.app')

@section('content')

@section('styles')
<link href="{{ asset('css/reports/income.css') }}" rel="stylesheet">
@endsection

<div class="container-fluid mt-4">
    <x-dashboard-header
       title="Laporan Setoran"
       description="Laporan Setoran karyawan"
       icon="bi bi-currency-dollar">
    </x-dashboard-header>

    
    <!-- Main Report Card -->
    <div class="row fade-in-up" style="animation-delay: 0.5s">
        
        
        <div class="col-12">
            <div class="card main-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0"><i class="bi bi-bar-chart-line me-2"></i>Laporan Setoran</h4>
                    {{-- <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-primary btn-custom">
                            <i class="bi bi-envelope me-1"></i> Lapor ke Admin
                        </button>
                    </div> --}}
                    <div class="text-end mb-3">
                        <a href="{{ route('transactions.export', request()->all()) }}" class="btn btn-success btn-custom">
                            <i class="bi bi-file-earmark-excel me-1"></i> Export ke Excel
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card filter-card">
                                <div class="card-body">
                                    <h5 class="mb-3 text-primary"><i class="bi bi-funnel me-2"></i>Filter Data</h5>
                                    <form action="{{route('reports.income')}}" method="GET" class="row g-3">
                                        <div class="col-md-6">
                                            <label for="user_id" class="form-label fw-semibold">
                                                <i class="bi bi-person me-1"></i>User
                                            </label>
                                            <select name="user_id" id="user_id" class="form-select custom-form-control">
                                                <option value="">Semua User</option>
                                                @foreach ($users as $user)
                                                <option value="{{$user->id}}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="date_from" class="form-label fw-semibold">
                                                <i class="bi bi-calendar-event me-1"></i>Tanggal
                                            </label>
                                            <input type="date" class="form-control custom-form-control" id="date_from" name="date_from">
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
                                    <th><i class="bi bi-person-badge me-2"></i>Nama</th>
                                    <th><i class="bi bi-calendar me-2"></i>Tanggal</th>
                                    <th><i class="bi bi-cash-stack me-2"></i>Setoran</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)    
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">KA</div>
                                            <span>{{$transaction->user->name}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">{{ $transaction->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold text-success">Rp {{ number_format($transaction->total_stor ?? 0, 0, ',', '.')}}</span>
                                    </td>
                                   
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Tidak ada data Setoran.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    
                   <!-- Pagination Section -->
<div class="d-flex justify-content-between align-items-center mt-4">
    <div>
        @if ($transactions->count() > 0)
            <span class="text-muted">
                Menampilkan {{ $transactions->firstItem() }}-{{ $transactions->lastItem() }} dari {{ $transactions->total() }} data
            </span>
        @else
            <span class="text-muted">Tidak ada data yang tersedia.</span>
        @endif

    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            {{-- Tombol Previous --}}
            <li class="page-item {{ $transactions->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $transactions->previousPageUrl() }}" aria-label="Previous">
                    <i class="bi bi-chevron-left"></i>
                </a>
            </li>

            {{-- Tombol Angka Halaman --}}
            @for ($i = 1; $i <= $transactions->lastPage(); $i++)
                <li class="page-item {{ $transactions->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $transactions->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- Tombol Next --}}
            <li class="page-item {{ $transactions->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $transactions->nextPageUrl() }}" aria-label="Next">
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