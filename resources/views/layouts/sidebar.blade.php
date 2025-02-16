<!-- Overlay untuk mobile -->
<div class="sidebar-overlay"></div>

<!-- Mobile Nav -->
<nav class="mobile-nav d-md-none">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="me-2" width="40" height="40">
            <h4 class="text-white mb-0">Alpin Cell</h4>
        </div>
        <div class="hamburger-icon" id="sidebarToggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
    <div class="d-flex align-items-center mb-4">
        <img src="{{ asset('image/logo.png') }}" alt="Logo" class="me-2" width="40" height="40">
        <h3 class="text-white mb-0">Alpin Cell</h3>
    </div>
    <nav class="nav flex-column">
        <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
        @if (auth()->check()&&auth()->user()->role == 1)
          <!-- User CRUD Section -->
        <a class="nav-link dropdown-toggle" href="#userMenu" data-bs-toggle="collapse" role="button">
            <div class="d-flex align-items-center justify-content-between w-100">
                <div>
                    <i class="bi bi-person"></i>
                    <span>User</span>
                </div>
                <i class="bi bi-chevron-down dropdown-icon"></i>
            </div>
        </a>
        <div class="collapse" id="userMenu">
            <div class="dropdown-menu-items">
                <a class="nav-link" href="{{route('indexuser')}}"><i class="bi bi-person-lines-fill"></i><span>Users</span></a>
                <a class="nav-link" href="{{route('createuser')}}"><i class="bi bi-person-plus"></i><span>Add User</span></a>
            </div>
        </div>

         <!-- Product CRUD Section -->
        <a class="nav-link {{ Request::routeIs('productindex') ? 'active' : '' }}" href="{{ route('productindex') }}">
            <i class="bi bi-bag-plus"></i>
            <span>Create Product</span>
        </a>

        <!-- History Section (Dropdown) -->
        <a class="nav-link dropdown-toggle" href="#historyMenu" data-bs-toggle="collapse" role="button">
            <div class="d-flex align-items-center justify-content-between w-100">
                <div>
                    <i class="bi bi-clock-history"></i>
                    <span>Riwayat</span>
                </div>
                <i class="bi bi-chevron-down dropdown-icon"></i>
            </div>
        </a>
        <div class="collapse" id="historyMenu">
            <div class="dropdown-menu-items">
                <a class="nav-link {{ Request::routeIs('historyStock') ? 'active' : '' }}" href="{{ route('historyStock') }}">
                    <i class="bi bi-box"></i>
                    <span>Stok</span>
                </a>
                <a class="nav-link {{ Request::routeIs('historyOrder') ? 'active' : '' }}" href="{{route('historyOrder')}}">
                    <i class="bi bi-cart"></i>
                    <span>Order</span>
                </a>
                <!-- Tambahkan fitur tambahan di sini jika ada -->
            </div>
        </div>
        @endif
      
        
      
        <!-- Orders CRUD Section -->
        <a class="nav-link {{ Request::routeIs('indexorder') ? 'active' : '' }}" href="{{ route('indexorder') }}">
                <i class="bi bi-boxes"></i>
                <span>Orders</span>
        </a>

        <a class="nav-link {{ Request::routeIs('absenteeism.absenteeism') ? 'active' : '' }}" href="{{ route('absenteeism.absenteeism') }}">
            <i class="bi bi-clock"></i><span>Absensi</span>
        </a>
        
        <a class="nav-link {{ Request::routeIs('reports.daily') ? 'active' : '' }}" href="{{ route('reports.daily') }}">
            <i class="bi bi-file-text"></i>
            <span>Report</span>
        </a>
        
        <a class="nav-link {{ Request::routeIs('setting') ? 'active' : '' }}" href="{{ route('setting', ['id' => Auth::user()->id]) }}">
            <i class="bi bi-gear"></i>
            <span>Setting Profile</span>
        </a>
                
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="d-flex align-items-center">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </div>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form> 
        <div class="border-top pt-3 mt-4">
            <div class="d-flex align-items-center">
                <a href="{{ route('showuser', Auth::user()->id) }}">
                <img src="{{ Auth::user()->picture ? Auth::user()->picture : asset('image/avatar.png') }}" 
                     alt="User Picture" class="rounded-circle" width="40" height="40"></a>
                <div class="ms-2">
                    <p class="mb-0">{{ Auth::user()->name }}</p>
                </div>
                
            </div>
        </div>               
    </nav>
</div>