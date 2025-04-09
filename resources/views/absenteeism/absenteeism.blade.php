@extends('layouts.app')

@section('title', 'Absensi - Alpin Cell')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header
       title="Attendance"
       description="Absensi kehadiran karyawan"
       icon="bi bi-person-workspace">
    </x-dashboard-header>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row gap-4">
                <!-- Absen Masuk -->
                <div class="card shadow-lg border-0 rounded-4 p-4 text-center flex-fill">
                    <h4 class="mb-3 text-primary">Absen Masuk</h4>
                    <p class="text-muted">Klik tombol di bawah untuk absen masuk.</p>
                    <button class="btn btn-primary w-100 mb-2 fw-bold btn-hover-primary" 
                        onclick="getLocationAndSubmit('checkin')" 
                        @if($attendance && $attendance->check_in||(optional($attendance)->status == 'Izin')) disabled @endif>
                        Absen Masuk
                    </button>
                </div>

                <!-- Absen Pulang -->
                <div class="card shadow-lg border-0 rounded-4 p-4 text-center flex-fill">
                    <h4 class="mb-3 text-danger">Absen Pulang</h4>
                    <p class="text-muted">Klik tombol di bawah untuk mencatat kepulangan.</p>
                    <button class="btn btn-danger w-100 fw-bold btn-hover-danger" 
                        onclick="getLocationAndSubmit('checkout')" 
                        @if(!$attendance || $attendance->check_out||$attendance->status != 'Hadir') disabled @endif>
                        Absen Pulang
                    </button>
                </div>

                <!-- Izin/Sakit -->
                <div class="card shadow-lg border-0 rounded-4 p-4 text-center flex-fill">
                    <h4 class="mb-3 text-warning">Izin / Sakit</h4>
                    <p class="text-muted">Klik tombol di bawah untuk mengajukan izin.</p>
                    <button class="btn btn-warning w-100 fw-bold btn-hover-warning"  
                        @if($attendance) disabled @endif 
                        onclick="izinAbsen()">
                        <i class="bi bi-file-earmark-text"></i> Izin / Sakit
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Ringkasan Absensi -->
    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <h5 class="fw-bold">Ringkasan Absensi Hari Ini</h5>
                <ul class="list-group list-group-flush">
                    @if (!$attendance)
                    <li class="list-group-item">Status: <span class="fw-bold text-primary">Belum Absen</span></li>
                    <li class="list-group-item">Jam Masuk: <span class="fw-bold">-</span></li>
                    <li class="list-group-item">Jam Pulang: <span class="fw-bold">-</span></li>
                @elseif ($attendance->status === "Hadir")
                    <li class="list-group-item">Status: <span class="fw-bold text-primary">{{ $attendance->status }}</span></li>
                    <li class="list-group-item">Jam Masuk: <span class="fw-bold">{{ $attendance->check_in ?? '-' }}</span></li>
                    <li class="list-group-item">Jam Pulang: <span class="fw-bold">{{ $attendance->check_out ?? '-' }}</span></li>
                @else
                    <li class="list-group-item">Status: <span class="fw-bold text-danger">{{ $attendance->status }}</span></li>
                    <li class="list-group-item">Absen: <span class="fw-bold">{{ $attendance->check_in ?? '-' }}</span></li>
                    <li class="list-group-item">Keterangan: <span class="fw-bold">{{ $attendance->reason ?? '-' }}</span></li>
                @endif                
                </ul>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/absen.js') }}"></script>
@endsection
@endsection
