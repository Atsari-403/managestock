<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="shortcut icon" href="{{ asset('image/logo.png') }}" type="image/x-icon">
    <title>Alpin Cell</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom Dashboard CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <!-- Tambahkan setelah tag body -->
<div class="sidebar-overlay"></div>

    <div class="dashboard-container">
        @include('layouts.sidebar')
        
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (performance.navigation.type === 2) {
                window.location.replace(window.location.href);
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>