@extends('layouts.app')

@section('title', 'User List - Alpin Cell')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="Users"></x-dashboard-header>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- User Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-primary text-white py-3 rounded-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex">
                            <form class="d-flex" method="GET" action="{{ route('indexuser') }}">
                                <input type="text" name="search" class="form-control form-control-sm shadow-sm" placeholder="Search by name or email" value="{{ request()->get('search') }}" autofocus>
                                <button type="submit" class="btn btn-light btn-sm ms-2 shadow-sm">
                                    <i class="fas fa-search"></i>
                                </button>                                                               
                            </form>
                        </div>

                        <!-- Per Page Dropdown -->
                        <form method="GET" action="{{ route('indexuser') }}" class="ms-auto d-flex align-items-center">
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm ms-2 shadow-sm dropdown-toggle" type="button" id="perPageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-file-alt"></i>
                                </button>
                                
                                <ul class="dropdown-menu" aria-labelledby="perPageDropdown">
                                    <li><button type="submit" name="perPage" value="5" class="dropdown-item {{ request()->get('perPage') == '5' ? 'active' : '' }}">5</button></li>
                                    <li><button type="submit" name="perPage" value="10" class="dropdown-item {{ request()->get('perPage') == '10' ? 'active' : '' }}">10</button></li>
                                    <li><button type="submit" name="perPage" value="15" class="dropdown-item {{ request()->get('perPage') == '15' ? 'active' : '' }}">15</button></li>
                                    <li><button type="submit" name="perPage" value="20" class="dropdown-item {{ request()->get('perPage') == '20' ? 'active' : '' }}">20</button></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="shadow-sm rounded-3">
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->role == 1)
                                                <span class="badge bg-success">Admin</span>
                                            @else
                                                <span class="badge bg-secondary">User</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('showuser', $user->id) }}" class="btn btn-sm btn-outline-primary rounded-3 p-2">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{route('useredit',$user->id)}}" class="btn btn-sm btn-outline-warning rounded-3 p-2">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('userdestroy', ['id' => $user->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Hapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="userId" value="{{auth()->id()}}">
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-3 p-2">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $users->appends(request()->input())->links('pagination::bootstrap-4') }}
                        </div>
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
    border-radius: 12px;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
}

.card-header {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    background: linear-gradient(135deg, #007bff, #0056b3);
}

.card-header h5 {
    font-weight: bold;
    font-size: 18px;
}

.table {
    border-radius: 12px;
    overflow: hidden;
}

.table thead {
    background-color: #f8f9fa;
    font-weight: bold;
}

.table tbody tr {
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.table tbody tr:hover {
    background-color: #e9f5ff;
    transform: scale(1.02);
}

.btn-outline-primary,
.btn-outline-warning,
.btn-outline-danger {
    border-radius: 50%;
    font-size: 16px;
    transition: all 0.3s ease;
    padding: 6px 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
}

.btn-outline-primary:hover {
    background-color: #007bff;
    color: white;
}

.btn-outline-warning:hover {
    background-color: #ffc107;
    color: white;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    color: white;
}

.form-control-sm,
.btn-sm {
    border-radius: 25px;
    transition: all 0.3s ease-in-out;
}

.form-control-sm:focus,
.btn-sm:focus {
    box-shadow: 0px 0px 10px rgba(0, 123, 255, 0.3);
}

.dropdown-menu {
    border-radius: 8px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
}

.dropdown-item {
    transition: background-color 0.3s ease;
}

.dropdown-item:hover {
    background-color: #f1f1f1;
}

.dropdown-item.active {
    background-color: #007bff;
    color: white;
}

</style>
@endsection
