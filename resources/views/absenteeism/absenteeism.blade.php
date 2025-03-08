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
                        @if($attendance && $attendance->check_in) disabled @endif>
                        Absen Masuk
                    </button>
                </div>

                <!-- Absen Pulang -->
                <div class="card shadow-lg border-0 rounded-4 p-4 text-center flex-fill">
                    <h4 class="mb-3 text-danger">Absen Pulang</h4>
                    <p class="text-muted">Klik tombol di bawah untuk mencatat kepulangan.</p>
                    <button class="btn btn-danger w-100 fw-bold btn-hover-danger" 
                        onclick="getLocationAndSubmit('checkout')" 
                        @if(!$attendance || $attendance->check_out) disabled @endif>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function getLocationAndSubmit(action) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                let latitude = position.coords.latitude;
                let longitude = position.coords.longitude;

                Swal.fire({
                    title: "Konfirmasi Absen",
                    text: `Lokasi Anda: ${latitude}, ${longitude}. Lanjutkan?`,
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Lanjutkan",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {                        
                        fetch(`{{ url('/attendance/') }}/${action}`, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                            },
                            body: JSON.stringify({
                                lat: latitude,
                                long: longitude
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire("Berhasil!", `Absen ${action} berhasil dicatat.`, "success")
                                .then(() => location.reload()); // Reload halaman setelah absen
                        })
                        .catch(error => {
                            Swal.fire("Gagal!", "Terjadi kesalahan saat melakukan absen.", "error");
                        });
                    }
                });
            },
            function (error) {
                Swal.fire("Gagal!", "Tidak dapat mengakses lokasi Anda. Pastikan GPS aktif!", "error");
            }
        );
    } else {
        Swal.fire("Error", "Peramban tidak mendukung geolokasi!", "error");
    }
}

function izinAbsen() {
    Swal.fire({
        title: 'Ajukan Izin',
        input: 'text',
        inputLabel: 'Masukkan alasan izin atau sakit',
        inputValidator: (value) => {
            if (!value) return "Alasan harus diisi!";
        },
        showCancelButton: true,
        confirmButtonText: 'Kirim',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) {
            console.log("mengirim data keterangan:",{reason: result.value});
            fetch("/izin", {  
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ reason: result.value })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire("Berhasil!", data.message, "success").then(() => location.reload());
                } else {
                    Swal.fire("Gagal!", data.message, "error");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire("Gagal!", "Terjadi kesalahan saat mengajukan izin.", "error");
            });
        }
    });
}



</script>
@endsection
