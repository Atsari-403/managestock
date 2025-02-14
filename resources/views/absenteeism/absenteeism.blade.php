@extends('layouts.app')

@section('title', 'Absensi - Alpin Cell')

@section('content')
<div class="container-fluid mt-4">
    <x-dashboard-header title="Attendance"></x-dashboard-header>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row gap-4">
                <!-- Absen Kehadiran -->
                <div class="card shadow-lg border-0 rounded-4 p-4 text-center flex-fill">
                    <h4 class="mb-3 text-success">Absen Kehadiran</h4>
                    <p class="text-muted">Klik tombol di bawah untuk absen.</p>
                    <button class="btn btn-success w-100 mb-2 fw-bold btn-hover" onclick="swafoto('masuk')">
                        <i class="bi bi-camera"></i> Swafoto & Absen Masuk
                    </button>
                    <button class="btn btn-warning w-100 fw-bold btn-hover" onclick="izinAbsen()">
                        <i class="bi bi-file-earmark-text"></i> Izin / Sakit
                    </button>
                </div>

                <!-- Absen Pulang -->
                <div class="card shadow-lg border-0 rounded-4 p-4 text-center flex-fill">
                    <h4 class="mb-3 text-danger">Absen Pulang</h4>
                    <p class="text-muted">Klik tombol di bawah untuk mencatat kepulangan.</p>
                    <button class="btn btn-danger w-100 fw-bold btn-hover" onclick="swafoto('pulang')">
                        <i class="bi bi-camera"></i> Swafoto & Absen Pulang
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
                    <li class="list-group-item">Status: <span id="status-absen" class="fw-bold text-primary">Belum Absen</span></li>
                    <li class="list-group-item">Jam Masuk: <span id="jam-masuk" class="fw-bold">-</span></li>
                    <li class="list-group-item">Jam Pulang: <span id="jam-pulang" class="fw-bold">-</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function swafoto(type) {
        alert(`Silakan lakukan swafoto untuk absen ${type}`);
        document.getElementById(`jam-${type}`).textContent = new Date().toLocaleTimeString();
        document.getElementById("status-absen").textContent = "Hadir";
    }

    function izinAbsen() {
        let alasan = prompt("Masukkan alasan izin atau sakit:");
        if (alasan) {
            alert("Izin berhasil diajukan.");
            document.getElementById("status-absen").textContent = "Izin: " + alasan;
        }
    }
</script>
@endsection

@section('styles')
<style>
    .btn-hover:hover {
        transform: scale(1.05);
        transition: 0.3s ease-in-out;
    }
</style>
@endsection
