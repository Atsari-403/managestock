@extends('layouts.app')

@section('title', 'Daftar Paket - ' . $category->name)

@section('styles')
<link href="{{ asset('css/indexCategory.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<style>
    .card {
        transition: all 0.3s ease-in-out;
        border-radius: 12px;
        overflow: hidden;
        border: none;
        position: relative;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
        font-family: 'Poppins', sans-serif;
        color: rgba(0, 123, 255, 0.85);
    }

    .badge-stock {
        background-color: #28a745;
        color: rgba(255, 255, 255, 0.85);
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 14px;
    }

    .btn-buy {
        background: linear-gradient(135deg, #007bff, #00d4ff);
        color: rgba(255, 255, 255, 0.9);
        font-weight: bold;
        border: none;
        padding: 8px 15px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s ease-in-out;
        position: absolute;
        bottom: 15px;
        right: 15px;
    }

    .btn-buy:hover {
        background: linear-gradient(135deg, #0056b3, #00a3cc);
    }

    .w-60 {
        width: 60%;
    }

    #purchaseModal .modal-content {
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    }

    #purchaseModal .modal-title {
        color: #007bff;
        font-weight: bold;
    }

    #purchaseModal .form-select, 
    #purchaseModal .form-control {
        border-radius: 10px;
    }

</style>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <x-dashboard-header title="{{ $category->name }}"></x-dashboard-header>

    @if(session()->has('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endif

    @if ($pakets->isEmpty() && (!isset($product) || in_array($product->name, ["Aksesoris", "Kartu", "Voucher"])))
        <div class="alert alert-warning text-center">Tidak ada Paket dalam Category ini.</div>
    @else
        <div class="row g-4">
            @if (isset($product) && !in_array($product->name, ["Aksesoris", "Kartu", "Voucher"]))
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ "Custom " . ($category->name ?? 'Paket Custom') }}</h5>
                        <div class="mb-3">
                            <span class="badge badge-stock">Alpin Cell</span>
                        </div>
                        <div class="mb-1">
                            <input type="number" class="form-control w-60 custom-price-input" name="harga" placeholder="Masukkan harga" required>
                        </div>
                        <button class="btn btn-buy" data-bs-toggle="modal" data-productName="{{$product->name}}" data-bs-target="#purchaseModal" disabled>
                            <i class="bi bi-cart"></i> Beli
                        </button>
                    </div>
                </div>
            </div>
            @endif

            @foreach ($pakets as $paket)
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $paket->name }}</h5>
                        <p class="card-text">
                            <span class="badge badge-stock {{ $paket->stock === 0 ? 'bg-danger' : '' }}">
                                {{ $paket->stock === 0 ? 'Stok: 0' : 'Stok: ' . $paket->stock }}
                            </span>
                        </p>
                        <p class="card-text">
                            <strong>Harga:</strong> Rp {{ number_format($paket->price, 0, ',', '.') }}
                        </p>
                        <button class="btn btn-buy" data-bs-toggle="modal" data-productName="{{$product->name}}" data-bs-target="#purchaseModal" data-harga="{{ $paket->price }}">
                            <i class="bi bi-cart"></i> Beli
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Modal Form Pembelian -->
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-topped">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="purchaseModalLabel">Form Pembelian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="modalPrice" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="modalPrice" name="modalPrice" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Metode Pembayaran</label>
                        <select class="form-select" name="payment_method" id="payment_method" required>
                            <option value="" disabled selected>Pilih metode pembayaran</option>
                            <option value="transfer">Transfer</option>
                            <option value="tunai">Tunai</option>
                        </select>
                    </div>

                    <!-- Aksi -->
                    <div class="mb-3" id="money">
                        <label for="action" class="form-label">Aksi</label>
                        <select class="form-select" name="action" id="action" required>
                            <option value="" disabled selected>Pilih aksi</option>
                            <option value="tarik_tunai">Tarik Tunai</option>
                            <option value="transfer">Transfer</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Submit Pembelian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
   document.addEventListener("DOMContentLoaded", function () {
    const bank = ["E-Wallet", "Transaksi"];
    
    // Event listener untuk setiap tombol "Beli"
    document.querySelectorAll(".btn-buy").forEach(button => {
        button.addEventListener("click", function () {
            let productName = button.getAttribute("data-productName");
            let money = document.getElementById("money");
            let action = document.getElementById("action");

            // Cek apakah productName termasuk dalam daftar bank
            if (!bank.includes(productName)) {
                money.style.display = "none";  // Sembunyikan form pembayaran
                action.removeAttribute("required"); // Hapus required
            } else {
                money.style.display = "block"; // Tampilkan kembali jika sesuai
                action.setAttribute("required", "required"); // Tambahkan kembali required
            }

            // Set harga di modal
            document.getElementById("modalPrice").value = "Rp " + 
                new Intl.NumberFormat("id-ID").format(button.dataset.harga);
        });
    });

    // Event listener untuk input harga
    document.querySelectorAll(".custom-price-input").forEach(input => {
        input.addEventListener("input", function () {
            let harga = Math.max(0, parseFloat(input.value) || 0);
            let btnBeli = input.closest(".card-body").querySelector(".btn-buy");

            // Pastikan btnBeli tidak null sebelum mengaksesnya
            if (btnBeli) {
                btnBeli.disabled = harga <= 0;
                btnBeli.dataset.harga = harga;
            }
        });
    });
});

</script>
@endsection
