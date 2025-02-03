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
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
            <div class="d-flex align-items-center">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </div>
        </a>
        
        <!-- Fitur Users Section -->
        <a class="nav-link dropdown-toggle" href="#userMenu" data-bs-toggle="collapse" role="button">
            <div class="d-flex align-items-center justify-content-between w-100">
                <div>
                    <i class="bi bi-person"></i>
                    <span>Fitur Users</span>
                </div>
                <i class="bi bi-chevron-down dropdown-icon"></i>
            </div>
        </a>
        <div class="collapse" id="userMenu">
            <div class="dropdown-menu-items">
                <a class="nav-link {{ Request::is('profile/settings') ? 'active' : '' }}" href="{{ route('profile') }}">
                    <i class="bi bi-gear"></i>
                    <span>Setting Profile</span>
                </a>
                <a class="nav-link {{ Request::is('absenteeism') ? 'active' : '' }}" href="{{ route('absenteeism.absenteeism') }}"><i class="bi bi-clock"></i><span>Absensi</span></a> <!-- Tambahan Absensi -->

                <a class="nav-link {{ Request::is('reports') ? 'active' : '' }}" href="{{ route('reports.daily') }}">
                    <i class="bi bi-file-text"></i>
                    <span>Report</span>
                </a>
            </div>
        </div>

        <!-- Super Admin Section -->
        <a class="nav-link dropdown-toggle" href="#adminMenu" data-bs-toggle="collapse" role="button">
            <div class="d-flex align-items-center justify-content-between w-100">
                <div>
                    <i class="bi bi-person-badge"></i>
                    <span>Super Admin</span>
                </div>
                <i class="bi bi-chevron-down dropdown-icon"></i>
            </div>
        </a>
        <div class="collapse" id="adminMenu">
            <div class="dropdown-menu-items">
                <a class="nav-link" href="#">
                    <i class="bi bi-person-plus"></i>
                    <span>Add Users</span>
                </a>
                <a class="nav-link" href="#">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Menerima Report</span>
                </a>
            </div>
        </div>

        <!-- CRUD Section -->
        <a class="nav-link dropdown-toggle" href="#crudMenu" data-bs-toggle="collapse" role="button">
            <div class="d-flex align-items-center justify-content-between w-100">
                <div>
                    <i class="bi bi-database"></i>
                    <span>CRUD</span>
                </div>
                <i class="bi bi-chevron-down dropdown-icon"></i>
            </div>
        </a>
        <div class="collapse" id="crudMenu">
            <div class="dropdown-menu-items">
                <a class="nav-link" href="#"><i class="bi bi-people"></i><span>Users</span></a>
                <a class="nav-link" href="#"><i class="bi bi-phone"></i><span>Pulsa</span></a>
                <a class="nav-link" href="#"><i class="bi bi-wallet2"></i><span>E-wallet</span></a>
                <a class="nav-link" href="#"><i class="bi bi-cart"></i><span>Transaksi</span></a>
                <a class="nav-link" href="#"><i class="bi bi-credit-card"></i><span>Pembayaran</span></a>
                <a class="nav-link" href="#"><i class="bi bi-controller"></i><span>Top Up Game</span></a>
                <a class="nav-link" href="#"><i class="bi bi-ticket-perforated"></i><span>Voucher</span></a>
                <a class="nav-link" href="#"><i class="bi bi-box"></i><span>Aksesoris</span></a>
            </div>
        </div>


        <a class="nav-link" href="#">
            <div class="d-flex align-items-center">
                <i class="bi bi-bell"></i>
                <span>Notifikasi</span>
            </div>
        </a>
        <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="d-flex align-items-center">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </div>
        </a>
    </nav>
</div>