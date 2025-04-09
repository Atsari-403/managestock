@extends('layouts.app')

@section('title', 'Dashboard - Alpin Cell')

@section('styles')
<link href="{{ asset('css/dashboard/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-3">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title mb-0 d-flex align-items-center">
                            <i class="bi bi-graph-up me-2 text-primary"></i> Dashboard
                        </h3>
                        <p class="text-muted mt-2">Aktivitas dan transaksi terkini</p>
                    </div>
                    @if(auth()->user()->role == 1)
                    <div class="badge bg-danger p-3">
                        <i class="bi bi-person-gear"></i> Admin Mode
                    </div>
                    @endif
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik hanya ditampilkan jika bukan admin -->
    @if(auth()->user()->role == 1)
    <div class="row mb-4">
        <!-- Seluruh Pendapatan Hari Ini -->
        <div class="row mb-4">
            <!-- Seluruh Pendapatan Hari Ini -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="stats-card bg-primary text-white ">
                    <div class="stats-card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0 fw-bold">Rp {{number_format($pendapatanHariIni ?? 0, 0, ',', '.')}}</h3>
                                <p class="text-white-70 mb-0">Seluruh Setoran cash Hari Ini</p>
                            </div>
                            <div class="stats-icon"><i class="bi bi-cash-stack"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Produk Terjual Hari Ini -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="stats-card bg-success text-white">
                    <div class="stats-card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0 fw-bold">{{$produkTerjualHariIni ?? 0}}</h3>
                                <p class="text-white-70 mb-0">Produk Terjual Hari Ini</p>
                            </div>
                            <div class="stats-icon"><i class="bi bi-box-seam"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <!-- Pendapatan Per User Diletakkan di Bawah -->

<div class="row">
    <div class="col-12">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-dark text-white py-3">
                <h5 class="mb-0 text-center">
                    <i class="fas fa-chart-line me-2"></i>Pendapatan Per User Hari Ini
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-admin table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%;">No</th>
                                <th class="text-start" style="width: 30%;">Nama User</th>
                                <th class="text-center" style="width: 30%;">Email</th>
                                <th class="text-center" style="width: 30%;">Pendapatan Hari Ini</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendapatanPerUser as $index => $user)
                            <tr>
                                <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                <td class="text-start">
                                    <span class="d-block">{{ $user->name }}</span>
                                </td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">
                                    <span class="badge badge-income bg-success text-white">
                                        Rp {{ number_format($user->total_pendapatan, 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center empty-state py-4">
                                    <i class="fas fa-chart-pie me-2"></i>Tidak ada data pendapatan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<!-- Tampilan untuk staff tetap seperti sebelumnya -->
 
<!-- Statistik Transaksi Staff -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card bg-primary text-white shadow">
            <div class="stats-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0 fw-bold">Rp {{ number_format($transaksi->total_digital ?? 0, 0, ',', '.') }}</h3>
                        <p class="text-white-70 mb-0">Transaksi QRIS Hari Ini</p>
                    </div>
                    <div class="stats-icon"><i class="bi bi-phone"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card bg-success text-white shadow">
            <div class="stats-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0 fw-bold">Rp {{ number_format($transaksi->total_cash ?? 0, 0, ',', '.') }}</h3>
                        <p class="text-white-70 mb-0">Transaksi Cash Hari Ini</p>
                    </div>
                    <div class="stats-icon"><i class="bi bi-cash"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card bg-info text-white shadow">
            <div class="stats-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0 fw-bold">
                            Rp {{ number_format(max(0, $transaksi->total_stor ?? 0), 0, ',', '.') }}
                        </h3>
                        <p class="text-white-70 mb-0">Setoran Hari Ini</p>
                    </div>
                    <div class="stats-icon"><i class="bi bi-currency-dollar"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card bg-warning text-white shadow">
            <div class="stats-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0 fw-bold">{{ $productTerjual }}</h3>
                        <p class="text-white-70 mb-0">Produk Terjual</p>
                    </div>
                    <div class="stats-icon"><i class="bi bi-box"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Transaksi Terakhir -->
 <div class="card shadow-lg border-0">
    <div class="card-header bg-dark text-white py-3">
        <h5 class="mb-0 text-center">
            <i class="fas fa-receipt me-2"></i>Transaksi Terakhir
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-employee table-hover mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10%;">No</th>
                        <th class="text-center" style="width: 25%;">Paket</th>
                        <th class="text-center" style="width: 20%;">Metode Pembayaran</th>
                        <th class="text-center" style="width: 25%;">Total Pembayaran (Rp)</th>
                        <th class="text-center" style="width: 20%;">Waktu Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksiTerakhir as $index => $transaksi)
                    <tr>
                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $transaksi->paket->name ?? '-' }}</td>
                        <td class="text-center">
                            <span class="badge badge-method {{ $transaksi->payment_method == 1 ? 'bg-success' : 'bg-info' }}">
                                {{ $transaksi->payment_method == 1 ? 'Tunai' : 'Transfer' }}
                            </span>                            
                        </td>
                        <td class="text-center fw-bold text-success">
                            Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            {{ $transaksi->created_at->format('d M Y, H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center empty-state py-4">
                            <i class="fas fa-box-open me-2"></i>Belum ada transaksi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch("/dashboard/chart-data")
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.date);
                const sales = data.map(item => item.total_sales);

                const ctx = document.getElementById("salesChart").getContext("2d");
                new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Total Penjualan",
                            data: sales,
                            borderColor: "rgb(75, 192, 192)",
                            backgroundColor: "rgba(75, 192, 192, 0.2)",
                            borderWidth: 2,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: "Tanggal"
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: "Total Penjualan (Rp)"
                                }
                            }
                        }
                    }
                });
            });
    });
</script>
@endsection

