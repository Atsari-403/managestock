@extends('layouts.app')

@section('title', 'Daftar Paket - ' . $category->name)

@section('styles')
<link href="{{ asset('css/indexCategory.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="Paket - {{ $category->name }}"></x-dashboard-header>
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
                            <span class="badge bg-success">Stok: {{ $paket->stock ?? 'Tidak tersedia' }}</span>
                        </p>
                        <p class="card-text">
                            <strong>Harga:</strong> Rp {{ number_format($paket->price, 0, ',', '.') }} <br>
                            <strong>Keuntungan:</strong> Rp {{ number_format($paket->profit_margin, 0, ',', '.') }}
                        </p>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="#" class="btn btn-warning btn-sm edit-paket"
                                data-bs-toggle="modal"
                                data-bs-target="#form"
                                data-id="{{ $paket->id }}"
                                data-name="{{ $paket->name }}"
                                data-stock="{{ $paket->stock }}"
                                data-price="{{ $paket->price }}"
                                data-profit="{{ $paket->profit_margin }}">
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
                    
                        <div class="mb-3">
                            <label for="paketProfit" class="form-label">Keuntungan</label>
                            <input type="number" class="form-control" id="paketProfit" name="profit_margin" required>
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
            document.getElementById('paketProfit').value = profit;

            // Ubah action form sesuai dengan ID paket
            modalForm.setAttribute('action', `/product/category/paket/update/${id}`);
        });
    });
});

</script>
@endsection
