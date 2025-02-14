@extends('layouts.app')

@section('title', 'Daftar Paket - ' . $category->name)

@section('styles')
<link href="{{ asset('css/indexCategory.css') }}" rel="stylesheet">
<style>
    /* Styling untuk Card Paket */
    .card {
        transition: all 0.3s ease-in-out;
        border-radius: 12px;
        overflow: hidden;
        border: none;
        position: relative; /* Supaya tombol Beli bisa diposisikan di dalamnya */
    }

    /* Hover Efek */
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
    }

    /* Judul Paket */
    .card-title {
        font-size: 18px;
        font-weight: bold;
        font-family: 'Poppins', sans-serif;
        color: rgba(0, 123, 255, 0.85); /* Biru lebih soft */
    }

    /* Badge Stok */
    .badge-stock {
        background-color: #28a745;
        color: rgba(255, 255, 255, 0.85);
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 14px;
    }

    /* Harga */
    .card-text strong {
        color: rgba(33, 37, 41, 0.85);
        font-weight: 600;
    }

    /* Tombol Beli */
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
        color: white;
    }

    /* Ikon dalam tombol */
    .btn-buy i {
        font-size: 18px;
    }
    .w-60 {
        width: 60%;
    }

</style>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
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
                            <strong>Harga:</strong> Rp {{ number_format($paket->price, 0, ',', '.') }} <br>
                        </p>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="#" class="btn btn-warning btn-sm edit-paket"
                                data-bs-toggle="modal"
                                data-bs-target="#form"
                                data-id="{{ $paket->id }}"
                                data-name="{{ $paket->name }}"
                                data-stock="{{ $paket->stock }}"
                                data-price="{{ $paket->price }}">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

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
                    
                        <div class="mb-3">
                            <label for="paketStock" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="paketStock" name="stock" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="paketPrice" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="paketPrice" name="price" required>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-paket');
    const modalForm = document.getElementById('paketForm');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Ambil data dari tombol yang diklik
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const stock = this.getAttribute('data-stock');
            const price = this.getAttribute('data-price');
            const profit = this.getAttribute('data-profit');

            // Isi modal dengan data paket yang dipilih
            document.getElementById('id').value = id;
            document.getElementById('paketName').value = name;
            document.getElementById('paketStock').value = stock;
            document.getElementById('paketPrice').value = price;

            // Ubah action form sesuai dengan ID paket
            modalForm.setAttribute('action', `/product/category/paket/update/${id}`);
        });
    });
});

</script>
@endsection
