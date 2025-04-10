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

    @if(session()->has('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
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
                <div class="position-absolute top-0 end-0 m-2">
                    <a href="#" class="text-warning me-2 edit-category-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#editCategoryModal"
                        data-id="{{ $categoryProduct->id }}"
                        data-name="{{ $categoryProduct->name }}">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ route('categoryproductdestroy', ['category_product_id' => $categoryProduct->id]) }}"
                          method="post"
                          class="delete-category-form d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                                class="btn btn-danger btn-sm border-0 p-0 delete-category-btn"
                                style="background: none;"
                                data-id="{{ $categoryProduct->id }}"
                                data-name="{{ $categoryProduct->name }}">
                            <i class="bi bi-trash-fill text-danger"></i>
                        </button>
                    </form>
                </div>

                <a href="{{ route('indexpaket', ['idProduct'=>$product->id,'category_product_id' => $categoryProduct->id]) }}" class="text-decoration-none">
                    <div class="card-content">
                        <h5 class="product-title">{{ $categoryProduct->name }}</h5>
                        <div class="button-container">
                            <a href="#" class="add-category-btn" data-bs-toggle="modal" 
                            data-bs-target="#form"
                            data-category-id="{{ $categoryProduct->id }}"
                            data-productId="{{$product->id}}">
                                <i class="bi bi-plus-lg me-1"></i>
                                Tambah Paket
                            </a>                            
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Modal Form Tambah Paket -->
    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="modalPulsaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPulsaLabel">Tambah Paket Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="paketForm" action="{{ route('storepaket') }}" method="POST">
                        @csrf
                        <input type="hidden" name="category_product_id" id="modalCategoryProductId">
                        <input type="hidden" name="product_id" id="modalProductId">
                    
                        <div class="mb-3">
                            <label for="paketName" class="form-label">Nama Paket</label>
                            <input type="text" class="form-control" id="paketName" name="name" required>
                        </div>
                    
                        @if (in_array($product->name, ['Voucher', 'Aksesoris', 'Kartu']))
                        <div class="mb-3">
                            <label for="paketStock" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="paketStock" name="stock" required>
                        </div>
                        @endif
                    
                        <div class="mb-3">
                            <label for="paketPrice" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="paketPrice" name="price" required>
                        </div>
                        <div class="mb-3">
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

    <!-- Modal Edit Kategori -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryLabel">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" method="POST">
                        @csrf
                        @method('POST')
                        
                        <input type="hidden" name="id" id="editCategoryId">
                        
                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="editCategoryName" name="name" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
<script src="{{ asset('js/order/category/category.js') }}"></script>
@endsection
