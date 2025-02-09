@extends('layouts.app')

@section('title', 'Product - Pulsa')

@section('styles')
<link href="{{ asset('css/pulsa.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="{{$product->name}}"></x-dashboard-header>


    <!-- Product Providers -->
    <div class="row mb-4">
        {{-- dinamis --}}
        @foreach ($categoryProducts as $categoryProduct)
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{$categoryProduct->name}}</h5>
                    <div>
                        <!-- Tombol Edit -->
                        <a href="#" class="btn btn-warning btn-sm me-2">
                            <i class="bi bi-pencil-square"></i> <!-- Ikon Edit -->
                        </a>
        
                        <!-- Tombol Hapus -->
                        <form action="#" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                <i class="bi bi-trash"></i> <!-- Ikon Hapus -->
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPulsa" data-provider="Telkomsel">
                        Add Nominal
                    </button>
                </div>
            </div>
        </div>
        @endforeach
        

    <!-- Modal Form to Input Phone Number and Price -->
    <div class="modal fade" id="modalPulsa" tabindex="-1" aria-labelledby="modalPulsaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPulsaLabel">Isi Nomor Telepon dan Nominal Pulsa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="phoneNumber" placeholder="Masukkan nomor telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="userPrice" class="form-label">Masukkan Nominal Pulsa</label>
                            <input type="number" class="form-control" id="userPrice" placeholder="Masukkan harga" required>
                        </div>
                        <div class="mb-3">
                            <p id="totalPrice" class="fw-bold">Total Harga: Rp 0</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">Konfirmasi Pembelian</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userPriceInput = document.getElementById('userPrice');
        const totalPriceElement = document.getElementById('totalPrice');

        userPriceInput.addEventListener('input', function () {
            const userPrice = parseInt(this.value) || 0; // Get the user input or default to 0
            const totalPrice = userPrice + 2000; // Add 2000 to the user input
            totalPriceElement.textContent = 'Total Harga: Rp ' + totalPrice.toLocaleString(); // Update the total price display
        });
    });
</script>
@endsection

@endsection