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
                        <button id="exportBtn" class="btn btn-sm btn-light">
                            <i class="bi bi-download me-1"></i> Export
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card bg-light border-0 shadow-sm rounded-3">
                                <div class="card-body">
                                    <h5 class="text-primary mb-3"><i class="bi bi-funnel me-2"></i>Filter Data</h5>
                                    <form action="#" method="GET" class="row g-3">
                                        <div class="col-md-3">
                                            <label for="user_id" class="form-label fw-bold"><i class="bi bi-person me-1"></i>User</label>
                                            <select name="user_id" id="user_id" class="form-select shadow-sm">
                                                <option value="">Semua User</option>
                                                <option value="1">joko</option>
                                                <option value="2">haryanto</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="status" class="form-label fw-bold"><i class="bi bi-check-circle me-1"></i>Status</label>
                                            <select name="status" id="status" class="form-select shadow-sm">
                                                <option value="">Semua Status</option>
                                                <option value="present">Masuk</option>
                                                <option value="late">Pulang</option>
                                                <option value="absent">Izin</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="date_from" class="form-label fw-bold"><i class="bi bi-calendar-minus me-1"></i>Dari Tanggal</label>
                                            <input type="date" class="form-control shadow-sm" id="date_from" name="date_from">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="date_to" class="form-label fw-bold"><i class="bi bi-calendar-plus me-1"></i>Sampai Tanggal</label>
                                            <input type="date" class="form-control shadow-sm" id="date_to" name="date_to">
                                        </div>
                                        <div class="col-12 mt-3 text-end">
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
                                <div class="card-body">
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
                                                <tr class="align-middle">
                                                    <td>2022-01-01</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar bg-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">JD</div>
                                                            John Doe
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-success rounded-pill px-3"><i class="bi bi-check-circle me-1"></i>Masuk</span></td>
                                                    <td><span class="text-success"><i class="bi bi-clock-fill me-1"></i>08:00</span></td>
                                                    <td><span class="text-danger"><i class="bi bi-clock-fill me-1"></i>17:00</span></td>
                                                </tr>
                                                <tr class="align-middle">
                                                    <td>2022-01-02</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar bg-info text-white rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">JD</div>
                                                            Jane Doe
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-warning rounded-pill px-3"><i class="bi bi-exclamation-circle me-1"></i>Pulang</span></td>
                                                    <td><span class="text-success"><i class="bi bi-clock-fill me-1"></i>08:00</span></td>
                                                    <td><span class="text-danger"><i class="bi bi-clock-fill me-1"></i>17:00</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        // Add animation to page elements
        $('.card').addClass('animate__animated animate__fadeIn');
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Export functionality
        $('#exportBtn').on('click', function() {
            let params = new URLSearchParams(window.location.search);
            params.append('export', 'excel');
            window.location.href = "{{ route('reports.attendance.export') }}?" + params.toString();
        });
    });
</script>
@endsection