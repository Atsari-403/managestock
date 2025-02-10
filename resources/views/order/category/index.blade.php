@extends('layouts.app')

@section('title', 'Product - Pulsa')

@section('styles')
<link href="{{ asset('css/indexCategory.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="{{ $product->name }}"></x-dashboard-header>

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
    @endif

    <!-- Product Providers -->
    @if ($categoryProducts->isEmpty())
        <div class="alert alert-warning text-center">Tidak ada Kategori dalam Product ini.</div>
    @else
    <div class="row g-4">
        @foreach ($categoryProducts as $categoryProduct)
        <div class="col-md-3 col-sm-6">
            <div class="product-card position-relative">
                <!-- Ikon Edit & Delete di sudut kanan atas -->
                <div class="position-absolute top-0 end-0 m-2">
                    <a href="#" class="text-warning me-2">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ route('categoryproductdestroy', ['category_product_id' => $categoryProduct->id]) }}" method="post" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm border-0 p-0" style="background: none;">
                            <i class="bi bi-trash-fill text-danger"></i>
                        </button>
                    </form>                    
                </div>

                <a href="{{ route('indexpaket', ['category_product_id' => $categoryProduct->id]) }}" class="text-decoration-none">
                    <div class="card-content">
                        <h5 class="product-title">{{ $categoryProduct->name }}</h5>
                        <div class="button-container">
                            <a href="#" class="add-category-btn" data-bs-toggle="modal" 
                            data-bs-target="#form"
                            data-category-id="{{ $categoryProduct->id }}">
                                <i class="bi bi-plus-lg me-1"></i>
                                Tambah Paket
                            </a>                            
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div> <!-- Tutup div row g-4 -->
    @endif

    <!-- Modal Form Tambah Paket -->
    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="modalPulsaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPulsaLabel">Tambah Paket Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="paketForm" action="{{ route('storepaket') }}" method="POST">
                        @csrf
                        <input type="hidden" name="category_product_id" id="modalCategoryProductId">
                    
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

</div> <!-- Tutup div container-fluid -->
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const addPackageButtons = document.querySelectorAll('.add-category-btn');
    const modalCategoryInput = document.getElementById('modalCategoryProductId');

    addPackageButtons.forEach(button => {
        button.addEventListener('click', function () {
            const categoryId = this.getAttribute('data-category-id');
            modalCategoryInput.value = categoryId; 
        });
    });
});
</script>
@endsection
