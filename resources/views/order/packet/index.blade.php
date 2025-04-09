@extends('layouts.app')

@section('title', 'Daftar Paket - ' . $category->name)

@section('styles')
<link href="{{ asset('css/indexCategory.css') }}" rel="stylesheet">
<link href="{{ asset('css/order/packet/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="{{ $category->name }}"></x-dashboard-header>
    
    @if(session()->has('success'))
    <div class="alert alert-success d-none">{{ session('success') }}</div>
    @endif
    
    @if ($pakets->isEmpty())
        <div class="alert alert-warning text-center">Tidak ada paket dalam kategori ini.</div>
    @else
        <div class="row g-4">
            @foreach ($pakets as $paket)
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm border-0 rounded-lg">
                    <div class="card-body">
                        <h5 class="card-title text-primary fw-bold">{{ $paket->name }}</h5>
                        <p class="card-text">
                            @php
                                $stock = $paket->stock ?? null;
                            @endphp

                            @if (is_null($stock))
                                <span class="badge badge-stock">Alpin Cell</span>
                            @elseif ($stock === 0)
                                <span class="badge badge-stock" style="background-color: red;">Stok: {{ $stock }}</span>
                            @else
                                <span class="badge badge-stock">Stok: {{ $stock }}</span>
                            @endif
                        </p>
                        <p class="card-text">
                            <strong>Harga:</strong> Rp {{ number_format($paket->price+$paket->margin, 0, ',', '.') }} <br>
                        </p>
                        <div class="d-flex justify-content-between mt-3">
                            <div class="d-flex justify-content-between">
                                <!-- Tombol Edit -->
                                <a href="#" class="btn btn-warning btn-sm edit-paket me-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#form"
                                    data-id="{{ $paket->id }}"
                                    data-name="{{ $paket->name }}"
                                    data-stock="{{ $paket->stock }}"
                                    data-price="{{ $paket->price }}"
                                    data-margin="{{ $paket->margin }}"
                                    data-nameProduct="{{$product->name}}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                            
                                <!-- Tombol Tambah Stok -->
                                @if (in_array($product->name, ['Aksesoris', 'Kartu', 'Voucher']))
                                    <button class="btn btn-success btn-sm add-stock"
                                        data-bs-toggle="modal"
                                        data-bs-target="#tambahStockModal"
                                        data-id="{{ $paket->id }}"
                                        data-name="{{ $paket->name }}">
                                        <i class="bi bi-plus-circle"></i> Add Stok
                                    </button>
                                @endif
                            </div>                            

                            <form action="{{route('destroypaket',['id'=>$paket->id])}}" method="post" onsubmit="return confirm('Hapus paket ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    
    <!-- Modal Tambah Stok -->
    <div class="modal fade" id="tambahStockModal" tabindex="-1" aria-labelledby="tambahStockLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahStockLabel">Tambah Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tambahStockForm" method="POST">
                        @csrf
                        <input type="hidden" name="packet_id" id="packet_id">

                        <div class="mb-3">
                            <label for="paketNameDisplay" class="form-label">Nama Paket</label>
                            <input type="text" class="form-control" id="paketNameDisplay" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="quantity_changed" class="form-label">Tambahkan Stok</label>
                            <input type="number" class="form-control" id="quantity_changed" name="quantity_changed" required min="1">
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Tambah Stok</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Update Paket -->
    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="modalPulsaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPulsaLabel">Tambah Paket Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="paketForm" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id">
                    
                        <div class="mb-3">
                            <label for="paketName" class="form-label">Nama Paket</label>
                            <input type="text" class="form-control" id="paketName" name="name" required>
                        </div>
                    
                        <div class="mb-3" id="StockInput">
                            <label for="paketStock" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="paketStock" name="stock" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="paketPrice" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="paketPrice" name="price" required>
                        </div>

                        <div class="mb-3" id="InputMargin">
                            <label for="paketMargin" class="form-label">Admin</label>
                            <input type="number" class="form-control" id="paketMargin" name="margin" required>
                        </div>
                    
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Simpan Paket</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/order/packet/index.js') }}"></script>
@endsection