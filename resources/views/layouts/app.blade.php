<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Hajusrakendused')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #00c8e3;
            --primary-hover: #00a7bf;
            --background-color: #121212;
            --secondary-bg: #1e1e1e;
            --text-color: #f5f5f5;
            --border-color: #333;
        }
        
        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Inter', sans-serif;
        }
        
        .bg-custom-dark {
            background-color: var(--secondary-bg);
        }
        
        .text-cyan {
            color: var(--primary-color);
        }
        
        .btn-cyan {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #000;
        }
        
        .btn-cyan:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            color: #000;
        }
        
        .btn-outline-cyan {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .btn-outline-cyan:hover {
            background-color: var(--primary-color);
            color: #000;
        }
        
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }
        
        .navbar-brand span {
            color: var(--primary-color);
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--text-color) !important;
            margin: 0 10px;
            transition: color 0.3s;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
        }
        
        .alert {
            border-radius: 0.5rem;
            border: none;
        }
        
        .card {
            background-color: var(--secondary-bg);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
        }
        
        .card-header {
            background-color: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid var(--border-color);
        }
        
        .table {
            color: var(--text-color);
        }
        
        .table th, 
        .table td,
        .table thead th {
            color: var(--text-color) !important;
        }
        
        .table-striped > tbody > tr:nth-of-type(odd),
        .table-striped > tbody > tr:nth-of-type(even) {
            color: var(--text-color);
            background-color: var(--secondary-bg);
        }
        
        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.1);
        }
        
        .text-muted, 
        small, 
        .card-body p.text-muted,
        .text-muted small {
            color: var(--text-color) !important;
        }
        
        .leaflet-popup-content {
            color: #000;
        }
        
        .form-control,
        .form-select,
        .input-group-text {
            background-color: var(--secondary-bg);
            color: var(--text-color);
            border-color: var(--border-color);
        }
        
        .form-control:focus,
        .form-select:focus {
            background-color: var(--secondary-bg);
            color: var(--text-color);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(0, 200, 227, 0.25);
        }
        
        input[type="number"] {
            background-color: var(--secondary-bg);
            color: var(--text-color);
        }
        

        .card-img-top {
            height: 200px;
            object-fit: cover;
            background-color: var(--secondary-bg);
        }
        

        .form-control:-webkit-autofill,
        .form-control:-webkit-autofill:hover,
        .form-control:-webkit-autofill:focus,
        .form-select:-webkit-autofill,
        .form-select:-webkit-autofill:hover,
        .form-select:-webkit-autofill:focus {
            -webkit-text-fill-color: var(--text-color);
            -webkit-box-shadow: 0 0 0px 1000px var(--secondary-bg) inset;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-custom-dark">
        <div class="container">
            <a class="navbar-brand" href="/current/public/index.php">Hajusrakendused</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    style="border-color: var(--primary-color);">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/current/public/index.php">
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('markers*') ? 'active' : '' }}" href="{{ route('markers.index') }}">
                            <i class="bi bi-map"></i> Maps
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('blogs*') ? 'active' : '' }}" href="{{ route('blogs.index') }}">
                            <i class="bi bi-journal-richtext"></i> Blogs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                            <i class="bi bi-shop"></i> Shop
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('cart*') ? 'active' : '' }}" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart"></i> Cart
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html> 