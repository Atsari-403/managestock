@extends('layouts.app')

@section('title', 'Top Up Game - E-Wallet')

@section('styles')
<link href="{{ asset('css/topupgame.css') }}" rel="stylesheet">
@endsection


@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="Top Up Game"></x-dashboard-header>

    <!-- Game Grid -->
    <div class="row">
        <!-- Mobile Legends -->
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-phone fs-2 text-primary"></i>
                        </div>
                        <h5 class="card-title mb-0">Mobile Legends</h5>
                    </div>
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
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                            <i class="bi bi-fire fs-2 text-danger"></i>
                        </div>
                        <h5 class="card-title mb-0">Free Fire</h5>
                    </div>
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
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="bi bi-controller fs-2 text-success"></i>
                        </div>
                        <h5 class="card-title mb-0">PUBG Mobile</h5>
                    </div>
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
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-purple bg-opacity-10 p-3 me-3">
                            <i class="bi bi-shield fs-2 text-purple"></i>
                        </div>
                        <h5 class="card-title mb-0">Valorant</h5>
                    </div>
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
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                            <i class="bi bi-globe fs-2 text-warning"></i>
                        </div>
                        <h5 class="card-title mb-0">Genshin Impact</h5>
                    </div>
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
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-secondary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-shield-shaded fs-2 text-secondary"></i>
                        </div>
                        <h5 class="card-title mb-0">Call of Duty Mobile</h5>
                    </div>
                    <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#modalTopupGame" aria-expanded="false" aria-controls="modalTopupGame">
                        Top Up Call of Duty Mobile
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Top Up Game (Collapse) -->
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