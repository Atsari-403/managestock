@extends('layouts.app')

@section('title', 'User List - Alpin Cell')

@section('styles')
<link href="{{ asset('css/user/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
     <x-dashboard-header 
        title="User Management"
        description="kelola user yang terdaftar di sistem"  
        icon="people">
    </x-dashboard-header>
    
    <!-- Alert Scripts -->
    @if(session()->has('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK",
                customClass: {
                    confirmButton: 'btn btn-danger px-4',
                    popup: 'animated fadeInDown faster rounded-lg'
                },
                buttonsStyling: false
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
                confirmButtonText: "OK",
                customClass: {
                    confirmButton: 'btn btn-success px-4',
                    popup: 'animated fadeInDown faster rounded-lg'
                },
                buttonsStyling: false
            });
        });
    </script>
    @endif
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- User Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-gradient-primary text-white py-2 rounded-top-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div class="d-flex mb-2 mt-2">
                            <form class="d-flex position-relative" method="GET" action="{{ route('indexuser') }}">
                                <input type="text" name="search" class="form-control form-control-sm bg-light border-0 shadow-sm ps-3 pe-3 " 
                                    placeholder="Search..." value="{{ request()->get('search') }}" autofocus>
                                <button type="submit" class="btn shadow-sm position-absolute end-0 top-0 h-100 px-3 text-primary bg-transparent">
                                    <i class="fas fa-search fa-lg"></i>
                                </button>                                                               
                            </form>
                        </div>

                        <div class="d-flex align-items-center">
                            <form method="GET" action="{{ route('indexuser') }}" class="ms-auto d-flex align-items-center">
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm shadow-sm dropdown-toggle d-flex align-items-center" 
                                        type="button" id="perPageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-file-alt me-2"></i>
                                        <span>{{ request()->get('perPage', 10) }} items</span>
                                    </button>
                                    
                                    <ul class="dropdown-menu dropdown-menu-end shadow-lg animated fadeInUp faster" aria-labelledby="perPageDropdown">
                                        <li><h6 class="dropdown-header">Show entries</h6></li>
                                        <li><button type="submit" name="perPage" value="5" class="dropdown-item {{ request()->get('perPage') == '5' ? 'active' : '' }}">5 items</button></li>
                                        <li><button type="submit" name="perPage" value="10" class="dropdown-item {{ request()->get('perPage') == '10' || !request()->has('perPage') ? 'active' : '' }}">10 items</button></li>
                                        <li><button type="submit" name="perPage" value="15" class="dropdown-item {{ request()->get('perPage') == '15' ? 'active' : '' }}">15 items</button></li>
                                        <li><button type="submit" name="perPage" value="20" class="dropdown-item {{ request()->get('perPage') == '20' ? 'active' : '' }}">20 items</button></li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th class="py-2">Name</th>
                                    <th class="py-2">Email</th>
                                    <th class="py-2">Role</th>
                                    <th class="text-center py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="row-hover-effect">
                                        <td class="py-2 fw-medium">{{ $user->name }}</td>
                                        <td class="py-2 text-muted">{{ $user->email }}</td>
                                        <td class="py-2">
                                            @if ($user->role == 1)
                                                <span class="badge bg-gradient-success px-3 py-2 rounded-pill">Admin</span>
                                            @else
                                                <span class="badge bg-gradient-secondary px-3 py-2 rounded-pill">User</span>
                                            @endif
                                        </td>
                                        <td class="text-center py-2">
                                            <div class="action-buttons d-inline-flex gap-2">
                                                <a href="{{ route('showuser', $user->id) }}" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="View User">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{route('useredit',$user->id)}}" class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip" title="Edit User">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('userdestroy', ['id' => $user->id]) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="userId" value="{{auth()->id()}}">
                                                    <button type="button" class="btn btn-outline-danger btn-sm delete-confirm" data-bs-toggle="tooltip" title="Delete User">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $users->appends(request()->input())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Delete confirmation with SweetAlert2
        const deleteButtons = document.querySelectorAll('.delete-confirm');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Hapus user ini?',
                    text: "Tindakan ini tidak dapat dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-danger me-2',
                        cancelButton: 'btn btn-secondary',
                        popup: 'animated fadeInDown faster rounded-lg'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
