{{-- resources/views/layouts/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | {{ config('app.name') }}</title>

    <!-- Bootstrap 5 + Icons -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .logo-box {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: white;
            font-weight: bold;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: .6rem;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: white;
            font-weight: 600;
            border-radius: 50%;
        }

        .top-bar {
            background: #212529;
            color: white;
        }

        .menu-bar {
            background: #343a40;
        }

        .menu-bar .nav-link {
            color: #dee2e6 !important;
            font-weight: 500;
            padding: .75rem 1rem !important;
        }

        .menu-bar .nav-link:hover,
        .menu-bar .nav-link.active {
            color: white !important;
            background: #495057;
        }

        /* Mobile menu dropdown */
        @media (max-width: 991.98px) {
            .mobile-menu .dropdown-menu {
                background: #343a40;
                border: none;
                box-shadow: 0 4px 6px rgba(0, 0, 0, .1);
            }

            .mobile-menu .dropdown-item {
                color: #dee2e6 !important;
                padding: .75rem 1.5rem;
            }

            .mobile-menu .dropdown-item:hover,
            .mobile-menu .dropdown-item.active {
                background: #495057;
                color: white !important;
            }
        }
    </style>
    @stack('style')@stack('styles')
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

    {{-- ==================== ROW 1 – LOGO + USER ==================== --}}
    <header class="top-bar shadow-sm">
        <div class="container-fluid px-4 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Left: Logo + Title -->
                <div class="d-flex align-items-center gap-2">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none">
                        <div
                            class="logo-box bg-indigo-600 text-white fw-bold px-3 py-1 rounded-lg shadow-sm text-uppercase">
                            RTO
                        </div>
                        <span class="ms-2 fs-5 fw-semibold tracking-wide d-none d-md-inline">Devices</span>
                    </a>
                </div>


                <!-- Right: User Info + Dropdown -->
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end text-white d-none d-sm-block">
                        <div class="fw-semibold">{{ Auth::user()->name }}</div>
                        <small class="opacity-75">
                            {{ Auth::user()->role ?? 'User' }} • {{ Auth::user()->branch ?? 'Main Branch' }}
                        </small>
                    </div>

                    <div class="dropdown">
                        <a href="#"
                            class="text-white text-decoration-none dropdown-toggle d-flex align-items-center gap-2"
                            data-bs-toggle="dropdown">
                            <div class="user-avatar d-flex align-items-center justify-content-center">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="#">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- ==================== ROW 2 – HORIZONTAL MENU (collapsible) ==================== --}}
    <nav class="menu-bar shadow-sm">
        <div class="container-fluid px-4">

            <!-- Desktop: pills -->
            <ul class="nav nav-pills d-none d-lg-flex">
                @php
                    $menu = [
                        ['name' => 'Home', 'route' => 'tenant.dashboard'],
                        ['name' => 'Device Mgmt', 'route' => 'tenant.device-mgmt'],
                        ['name' => 'Inventory', 'route' => 'tenant.inventory'],
                        ['name' => 'Enrollment', 'route' => 'tenant.enrollment'],
                        ['name' => 'Reports', 'route' => 'tenant.reports'],
                        ['name' => 'Admin', 'route' => 'tenant.admin'],
                        ['name' => 'Support', 'route' => 'tenant.support'],
                    ];
                @endphp

                @foreach($menu as $item)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}"
                            href="{{ route($item['route'], ['tenant_domain' => $tenant->subdomain ?? request()->route('tenant_domain')]) }}">
                            {{ $item['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <!-- Mobile: hamburger dropdown -->
            <div class="d-lg-none mobile-menu">
                <div class="dropdown w-100">
                    <button class="btn btn-dark w-100 d-flex justify-content-between align-items-center dropdown-toggle"
                        type="button" data-bs-toggle="dropdown">
                        <!-- <span>Menu</span> -->
                        <i class="bi bi-list"></i>
                    </button>
                    <ul class="dropdown-menu w-100">
                        @foreach($menu as $item)
                            <li>
                                <a class="dropdown-item {{ request()->routeIs($item['route'] . '*') ? 'active' : '' }}"
                                    href="#">
                                    {{ $item['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    {{-- ==================== MAIN CONTENT ==================== --}}
    <main class="flex-grow-1 container-fluid py-4">
        @yield('content')
    </main>

    {{-- ==================== FOOTER ==================== --}}
    <footer class="bg-white border-top py-4 mt-auto">
        <div class="container-fluid text-center text-muted small">
            <div class="row">
                <div class="col-md-6 text-md-start">
                    © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </div>
                <div class="col-md-6 text-md-end">
                    Powered by <strong class="text-primary">Laravel</strong> &
                    <strong class="text-info">Bootstrap 5</strong>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('script')@stack('scripts')
</body>

</html>