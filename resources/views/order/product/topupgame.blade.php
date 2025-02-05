@extends('layouts.app')

@section('title', 'Top Up Game - E-Wallet')

@section('styles')
<link href="{{ asset('css/topupgame.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">Top Up Game</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Top Up Game</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Game Grid -->
    <div class="row">
        <!-- Mobile Legends -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title mb-4 text-center">Mobile Legends</h5>
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalTopupGame" aria-expanded="false" aria-controls="modalTopupGame">
                        Top Up Mobile Legends
                    </button>
                </div>
            </div>
        </div>

        <!-- Free Fire -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title mb-4 text-center">Free Fire</h5>
                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#modalTopupGame" aria-expanded="false" aria-controls="modalTopupGame">
                        Top Up Free Fire
                    </button>
                </div>
            </div>
        </div>

        <!-- PUBG Mobile -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title mb-4 text-center">PUBG Mobile</h5>
                    <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#modalTopupGame" aria-expanded="false" aria-controls="modalTopupGame">
                        Top Up PUBG Mobile
                    </button>
                </div>
            </div>
        </div>

        <!-- Valorant -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title mb-4 text-center">Valorant</h5>
                    <button type="button" class="btn btn-purple w-100" data-bs-toggle="modal" data-bs-target="#modalTopupGame" aria-expanded="false" aria-controls="modalTopupGame">
                        Top Up Valorant
                    </button>
                </div>
            </div>
        </div>

        <!-- Genshin Impact -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title mb-4 text-center">Genshin Impact</h5>
                    <button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#modalTopupGame" aria-expanded="false" aria-controls="modalTopupGame">
                        Top Up Genshin Impact
                    </button>
                </div>
            </div>
        </div>

        <!-- Call of Duty Mobile -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title mb-4 text-center">Call of Duty Mobile</h5>
                    <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#modalTopupGame" aria-expanded="false" aria-controls="modalTopupGame">
                        Top Up Call of Duty Mobile
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Top Up Game -->
    <div class="modal fade" id="modalTopupGame" tabindex="-1" aria-labelledby="modalTopupGameLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTopupGameLabel">Top Up Game</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="gameID" class="form-label">Game ID</label>
                            <input type="text" class="form-control" id="gameID" placeholder="Masukkan Game ID" required>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Nominal Top Up</label>
                            <input type="number" class="form-control" id="amount" placeholder="Masukkan nominal" required>
                        </div>
                        <!-- Elemen untuk menampilkan total top up (nominal + fee 2000) -->
                        <div class="mb-3">
                            <p id="totalTopup" class="fw-bold">Total Top Up: Rp 0</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">Konfirmasi Top Up</button>
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
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fee = 2000; // Fee tetap Rp 2.000
    const amountInput = document.getElementById('amount');
    const totalTopupElement = document.getElementById('totalTopup');

    if (amountInput) {
        amountInput.addEventListener('input', function () {
            const userInput = this.value.replace(/[^\d.,]/g, ''); // Remove any non-numeric characters except for . and ,
            const amount = parseInt(userInput.replace(/[.,]/g, ''), 10) || 0;
            const total = amount + fee;
            totalTopupElement.textContent = 'Total Top Up: Rp ' + total.toLocaleString();
        });
    }
});
</script>
@endsection
