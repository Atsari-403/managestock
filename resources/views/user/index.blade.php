@extends('layouts.app')

@section('title', 'User List - Alpin Cell')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <x-dashboard-header title="Users"></x-dashboard-header>

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
                                            <a href="{{ route('showuser', $user->id) }}" class="btn btn-sm btn-outline-primary rounded-3 p-2"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-sm btn-outline-warning rounded-3 p-2"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-sm btn-outline-danger rounded-3 p-2"><i class="fas fa-trash"></i></a>
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
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .table thead {
        background-color: #f8f9fa;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    .btn-outline-primary, .btn-outline-warning, .btn-outline-danger {
        border-radius: 50%;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #e7f1ff;
    }

    .btn-outline-warning:hover {
        background-color: #fff3cd;
    }

    .btn-outline-danger:hover {
        background-color: #f8d7da;
    }

    .form-control-sm, .btn-sm {
        border-radius: 25px;
    }

    .form-control-sm:focus, .btn-sm:focus {
        box-shadow: none;
    }

    .dropdown-menu {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
    }

    .dropdown-item {
        color: #495057;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }

    .dropdown-item.active {
        background-color: #007bff;
        color: white;
    }
</style>
@endsection
