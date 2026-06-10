<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBank Petugas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #eaf6f0;
            color: #1f2937;
        }

        .navbar {
            background-color: #1b513e;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .navbar-menu a {
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            transition: opacity 0.2s;
        }

        .navbar-menu a:hover {
            opacity: 0.8;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.2s;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .container-wrapper {
            display: flex;
            min-height: calc(100vh - 70px);
        }

        .sidebar {
            width: 280px;
            background-color: #1b513e;
            color: white;
            padding: 2rem 1rem;
            box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .sidebar-menu a,
        .sidebar-menu button {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            text-align: left;
            background: none;
            border: none;
            color: white;
            text-decoration: none;
            border-radius: 0.375rem;
            cursor: pointer;
            font-size: 0.95rem;
            transition: background-color 0.2s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu button:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu a.active {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .page-header {
            background-color: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.25rem;
        }

        .page-subtitle {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .alert {
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .alert-info {
            background-color: #cfe2ff;
            color: #084298;
            border: 1px solid #b6d4fe;
        }

        @media (max-width: 768px) {
            .container-wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 1rem;
            }

            .sidebar-menu {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
            }

            .navbar-menu {
                gap: 1rem;
            }

            .main-content {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-title">🌱 EcoBank Petugas</div>
        <div class="navbar-menu">
            <a href="{{ route('petugas.dashboard') }}">Dashboard</a>
            <a href="{{ route('petugas.profile') }}">Profil</a>
            <div class="navbar-user">
                <span>{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-menu">
                <a href="{{ route('petugas.dashboard') }}" class="@if(Route::currentRouteName() === 'petugas.dashboard') active @endif">
                    📊 Dashboard
                </a>
                <a href="{{ route('petugas.setoran.index') }}" class="@if(Route::currentRouteName() === 'petugas.setoran.index') active @endif">
                    📦 Setoran Sampah
                </a>
                <a href="{{ route('petugas.penjemputan.index') }}" class="@if(Route::currentRouteName() === 'petugas.penjemputan.index') active @endif">
                    🚚 Penjemputan
                </a>
                <a href="{{ route('petugas.riwayat') }}" class="@if(Route::currentRouteName() === 'petugas.riwayat') active @endif">
                    📋 Riwayat
                </a>
                <hr style="border-color: rgba(255,255,255,0.2); margin: 1rem 0;">
                <a href="{{ route('petugas.profile') }}" class="@if(Route::currentRouteName() === 'petugas.profile') active @endif">
                    👤 Profil Saya
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">@yield('page_title', 'Petugas')</h1>
                <p class="page-subtitle">@yield('page_subtitle', 'Kelola tugas-tugas operasional')</p>
            </div>

            <!-- Alerts -->
            @if ($errors->any())
            <div class="alert alert-error">
                <strong>Terjadi kesalahan!</strong>
                <ul style="margin-top: 0.5rem; padding-left: 1.5rem;">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-error">
                ✗ {{ session('error') }}
            </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </main>
    </div>

    <script>
        // Auto-hide alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.3s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }, 5000);
        });
    </script>
</body>

</html>