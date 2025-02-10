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
                            <a href="#" class="btn btn-warning btn-sm">
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
</div>
@endsection
