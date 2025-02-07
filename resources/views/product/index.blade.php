@extends('layouts.app')

@section('title', 'Product List - Alpin Cell')

@section('content')
<div class="container-fluid mt-4">
    <x-dashboard-header title="Product List"></x-dashboard-header>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Available Products</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card border-0 shadow-sm rounded-3">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    {{-- <p class="text-muted">Created at: {{ $product->created_at->format('d M Y') }}</p> --}}
                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{-- {{ $products->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .btn-outline-primary {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }
</style>
@endsection
