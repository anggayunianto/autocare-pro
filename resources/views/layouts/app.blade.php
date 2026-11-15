<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AutoCare Pro') — Sistem Manajemen Bengkel</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #0f172a;
            color: #94a3b8;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar .brand {
            padding: 1.35rem 1.5rem;
            color: #ffffff;
            font-weight: 700;
            font-size: 1.15rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .sidebar .nav-link {
            color: #94a3b8;
            padding: 0.7rem 1.25rem;
            margin: 0.2rem 0.75rem;
            border-radius: 0.6rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(59, 130, 246, 0.16);
            color: #60a5fa;
        }
        .sidebar-user {
            background: rgba(30, 41, 59, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 0.75rem;
        }
        .main-wrapper {
            margin-left: 250px;
            padding: 1.75rem 2rem;
        }
        .topbar-panel {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.9rem;
            padding: 0.75rem 1.25rem;
        }
        .card-panel {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }
        @media print {
            .sidebar, .topbar-panel, .no-print {
                display: none !important;
            }
            .main-wrapper {
                margin-left: 0 !important;
                padding: 0 !important;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Kiri -->
    <aside class="sidebar">
        <div>
            <div class="brand d-flex align-items-center justify-content-between">
                <span><i class="fa-solid fa-car-wrench text-primary me-2"></i>AutoCare<span class="text-primary">Pro</span></span>
            </div>

            <div class="mt-3">
                <small class="text-uppercase px-4 fw-semibold" style="font-size: 0.68rem; letter-spacing: 0.08em;">Menu Utama</small>
                <nav class="nav flex-column mt-2">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-gauge-high"></i> Dasbor
                    </a>
                    <a class="nav-link {{ request()->routeIs('kendaraan.*') ? 'active' : '' }}" href="{{ route('kendaraan.index') }}">
                        <i class="fa-solid fa-car"></i> Data Kendaraan
                    </a>
                    <a class="nav-link {{ request()->routeIs('antrian.*') ? 'active' : '' }}" href="{{ route('antrian.index') }}">
                        <i class="fa-solid fa-list-ol"></i> Antrian Servis
                    </a>
                    <a class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}" href="{{ route('laporan.index') }}">
                        <i class="fa-solid fa-file-lines"></i> Laporan Bengkel
                    </a>
                </nav>

                <div class="border-top border-secondary border-opacity-25 my-3 mx-3"></div>
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fa-solid fa-house"></i> Halaman Depan
                    </a>
                </nav>
            </div>
        </div>

        <!-- Tampilan Info Pengguna & Tombol Login/Logout di Bawah Sidebar -->
        <div class="p-3 border-top border-secondary border-opacity-25">
            @if (auth()->check() || session()->has('pengguna_login'))
                <div class="sidebar-user p-3 mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-primary bg-opacity-20 text-primary d-flex align-items-center justify-content-center fw-bold" style="width: 36px; height: 36px;">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="overflow-hidden">
                            <div class="text-white small fw-semibold text-truncate">
                                {{ session('pengguna_login.nama') ?? auth()->user()->name ?? 'Admin AutoCare' }}
                            </div>
                            <div class="text-secondary text-truncate" style="font-size: 0.72rem;">
                                {{ session('pengguna_login.email') ?? auth()->user()->email ?? 'admin@autocare.test' }}
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100 fw-semibold">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Keluar (Logout)
                    </button>
                </form>
            @else
                <div class="sidebar-user p-3 mb-2 text-center">
                    <div class="text-white small fw-semibold mb-1">Mode Tamu</div>
                    <div class="text-secondary" style="font-size: 0.74rem;">Silakan masuk untuk akses penuh</div>
                </div>
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm w-100 fw-semibold">
                    <i class="fa-solid fa-right-to-bracket me-1"></i> Masuk (Login)
                </a>
            @endif
        </div>
    </aside>

    <!-- Konten Utama -->
    <div class="main-wrapper">
        <!-- Baris Atas (Topbar) dengan Status Login & Tombol Cepat -->
        <div class="topbar-panel d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <div class="d-flex align-items-center gap-2 small text-muted">
                <i class="fa-solid fa-screwdriver-wrench text-primary"></i>
                <span>Sistem Informasi Bengkel <strong>AutoCare Pro</strong></span>
            </div>

            <div class="d-flex align-items-center gap-2">
                @if (auth()->check() || session()->has('pengguna_login'))
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill small fw-semibold">
                        <i class="fa-solid fa-circle-user me-1"></i>
                        {{ session('pengguna_login.nama') ?? auth()->user()->name ?? 'Admin AutoCare' }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold">
                            <i class="fa-solid fa-right-from-bracket me-1"></i> Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-primary rounded-pill px-3 fw-semibold">
                        <i class="fa-solid fa-right-to-bracket me-1"></i> Masuk
                    </a>
                @endif
            </div>
        </div>

        @if (session('sukses'))
            <div class="alert alert-success border-0 shadow-sm rounded-3">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('sukses') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>