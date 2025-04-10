@extends('layouts.app')

@section('content')

@section('styles')
<link href="{{ asset('css/reports/attendance.css') }}" rel="stylesheet">
@endsection

<div class="container-fluid mt-4">
    <x-dashboard-header
       title="Attendance"
       description="Laporan kehadiran karyawan"
       icon="bi bi-person-workspace">
    </x-dashboard-header>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0"><i class="bi bi-calendar-check me-2"></i>Laporan Absensi</h4>
                        <button id="exportBtn" class="btn btn-sm btn-light"
                        onclick="window.location.href='{{ route('attendance.export', request()->all()) }}'">
                        <i class="bi bi-download me-1"></i> Export
                     </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card bg-light border-0 shadow-sm rounded-3">
                                <div class="card-body md-6">
                                    <h5 class="text-primary mb-3"><i class="bi bi-funnel me-2"></i>Filter Data</h5>
                                    <form action="#" method="GET" class="row g-3">
                                        <div class="col-md-3">
                                            <label for="user_id" class="form-label fw-bold"><i class="bi bi-person me-1"></i>User</label>
                                            <select name="user_id" id="user_id" class="form-select shadow-sm">
                                                <option value="">Semua User</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>                                            
                                        </div>
                                        <div class="col-md-3">
                                            <label for="status" class="form-label fw-bold"><i class="bi bi-check-circle me-1"></i>Status</label>
                                            <select name="status" id="status" class="form-select shadow-sm">
                                                <option value="">Semua Status</option>
                                                <option value="Hadir">Masuk</option>
                                                <option value="Izin">Izin</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="date_from" class="form-label fw-bold"><i class="bi bi-calendar-minus me-1"></i>Tanggal</label>
                                            <input type="date" class="form-control shadow-sm" id="date_from" name="date_from" placeholder="mm/dd/yy">
                                        </div>
                                        <div class="col-md-3 text-end">
                                            <button type="submit" class="btn btn-primary btn-gradient">
                                                <i class="bi bi-search me-1"></i> Filter
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-3">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead class="table-primary text-primary">
                                                <tr>
                                                    <th><i class="bi bi-calendar3 me-1"></i>Tanggal</th>
                                                    <th><i class="bi bi-person-badge me-1"></i>Nama</th>
                                                    <th><i class="bi bi-bookmark-check me-1"></i>Status</th>
                                                    <th><i class="bi bi-clock me-1"></i>Jam Masuk</th>
                                                    <th><i class="bi bi-clock-history me-1"></i>Jam Pulang</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($attendances as $attendance)
                                                    <tr class="align-middle">
                                                        <td>{{ $attendance->created_at->format('Y-m-d') }}</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar bg-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                                    {{ strtoupper(substr($attendance->user->name, 0, 2)) }}
                                                                </div>
                                                                {{ $attendance->user->name }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="badge 
                                                                {{ $attendance->status == 'Hadir' ? 'bg-success' :  'bg-danger' }} 
                                                                rounded-pill px-3">
                                                                <i class="bi bi-check-circle me-1"></i> {{ ucfirst($attendance->status) }}
                                                            </span>
                                                        </td>
                                                        <td><span class="text-success"><i class="bi bi-clock-fill me-1"></i>{{ $attendance->check_in ?? '-' }}</span></td>
                                                        <td><span class="text-danger"><i class="bi bi-clock-fill me-1"></i>{{ $attendance->check_out ?? '-' }}</span></td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center text-muted">Tidak ada data absensi.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>                                            
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <nav aria-label="Page navigation" class="mx-4">
                    <ul class="pagination">
                        {{-- Tombol Previous --}}
                        <li class="page-item {{ $attendances->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $attendances->previousPageUrl() }}" aria-label="Previous">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>
            
                        {{-- Tombol Angka Halaman --}}
                        @for ($i = 1; $i <= $attendances->lastPage(); $i++)
                            <li class="page-item {{ $attendances->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $attendances->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
            
                        {{-- Tombol Next --}}
                        <li class="page-item {{ $attendances->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $attendances->nextPageUrl() }}" aria-label="Next">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Add animation to page elements
        $('.card').addClass('animate__animated animate__fadeIn');
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
      
    });
</script>
@endsection