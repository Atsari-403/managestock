@extends('layouts.app')

@section('title', 'Riwayat Perubahan Stok - Alpin Cell')

@section('styles')
<link href="{{ asset('css/indexCategory.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="Riwayat Perubahan Stok"></x-dashboard-header>

    <!-- Filter Berdasarkan Paket -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{route('historyStock')}}">
                <div class="row">
                    <div class="col-md-6">
                        <label for="packet_id" class="form-label">Filter berdasarkan Nama Produk</label>
                        <select name="packet_id" id="packet_id" class="form-select">
                            <option value="">Semua Paket</option>
                            @foreach($packets as $packet)
                                <option value="{{ $packet->id }}" {{ request('packet_id') == $packet->id ? 'selected' : '' }}>
                                    {{ $packet->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Riwayat Stok -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Paket</th>
                            <th>Stok Sebelumnya</th>
                            <th>Stok Baru</th>
                            <th>Perubahan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stockHistories as $history)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $history->packet->name }}</td>
                            <td>{{ $history->previous_stock }}</td>
                            <td>{{ $history->new_stock }}</td>
                            <td class="{{ $history->quantity_changed > 0 ? 'text-success' : 'text-danger' }}">
                                {{ $history->quantity_changed > 0 ? '+' : '' }}{{ $history->quantity_changed }}
                            </td>
                            <td>{{ $history->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada riwayat perubahan stok.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
