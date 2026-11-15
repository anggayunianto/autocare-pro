<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoCare Pro — Sistem Manajemen Bengkel & Antrian Kendaraan</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0f172a;
            --bg-card: #1e293b;
            --border-subtle: rgba(255, 255, 255, 0.08);
            --accent-blue: #3b82f6;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .navbar-modern {
            background: rgba(15, 23, 42, 0.88);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-subtle);
        }
        .hero-section {
            padding: 6.5rem 0 3.5rem 0;
        }
        .lencana-utama {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.35);
            font-weight: 600;
            font-size: 0.82rem;
        }
        .panel-pratinjau {
            background: linear-gradient(180deg, #1e293b 0%, #162032 100%);
            border: 1px solid var(--border-subtle);
            border-radius: 1.25rem;
            box-shadow: 0 24px 48px -12px rgba(0, 0, 0, 0.45);
        }
        .kartu-fitur {
            background: rgba(30, 41, 59, 0.65);
            border: 1px solid var(--border-subtle);
            border-radius: 1rem;
            transition: transform 0.2s ease, border-color 0.2s ease;
        }
        .kartu-fitur:hover {
            transform: translateY(-4px);
            border-color: rgba(59, 130, 246, 0.45);
        }
        .wadah-ikon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
        }
        .kotak-mini {
            background: rgba(15, 23, 42, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 0.85rem;
        }
    </style>
</head>
<body>

    <!-- Navigasi Atas -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-modern py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-4" href="{{ route('home') }}">
                <span class="wadah-ikon bg-primary bg-opacity-15 text-primary" style="width: 38px; height: 38px; font-size: 1rem;">
                    <i class="fa-solid fa-car-wrench"></i>
                </span>
                <span>AutoCare<span class="text-primary">Pro</span></span>
            </a>

            <div class="d-flex align-items-center gap-2">
                @if (auth()->check() || session()->has('pengguna_login'))
                    <span class="badge bg-success bg-opacity-15 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill d-none d-md-inline-flex align-items-center gap-2 small">
                        <i class="fa-solid fa-user-check"></i>
                        {{ session('pengguna_login.nama') ?? auth()->user()->name ?? 'Admin AutoCare' }}
                    </span>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill px-4 fw-semibold btn-sm shadow-sm d-flex align-items-center gap-2">
                        <i class="fa-solid fa-gauge-high"></i> Buka Dasbor
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger rounded-pill px-3 fw-semibold btn-sm d-flex align-items-center gap-2">
                            <i class="fa-solid fa-right-from-bracket"></i> Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill px-4 fw-semibold btn-sm border-secondary d-flex align-items-center gap-2">
                        <i class="fa-solid fa-right-to-bracket"></i> Masuk
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill px-4 fw-semibold btn-sm shadow-sm d-flex align-items-center gap-2">
                        <i class="fa-solid fa-gauge-high"></i> Dasbor
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Bagian Utama -->
    <main class="container hero-section">
        <div class="row align-items-center g-5">
            <!-- Kolom Kiri: Judul, Status Login & Ajakan -->
            <div class="col-lg-6 text-center text-lg-start">
                <span class="badge lencana-utama rounded-pill px-3 py-2 mb-3">
                    <i class="fa-solid fa-shield-halved me-1"></i> Sistem Manajemen Bengkel & Antrian
                </span>
                <h1 class="display-5 fw-bold mb-3 lh-tight">
                    Kelola Servis, Jadwal, dan Antrian Bengkel Lebih <span class="text-primary">Terstruktur</span>.
                </h1>
                <p class="text-secondary lead mb-4" style="max-width: 540px;">
                    Aplikasi terpadu untuk mencatat data kendaraan pelanggan, memantau status pengerjaan mekanik secara langsung, hingga mencetak laporan operasional bengkel.
                </p>

                <!-- Tampilan Kartu Akses Login -->
                <div class="kotak-mini p-3 mb-4 text-start" style="max-width: 540px;">
                    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                        <div>
                            <div class="small fw-semibold text-white">
                                <i class="fa-solid fa-lock text-primary me-1"></i>
                                @if (auth()->check() || session()->has('pengguna_login'))
                                    Anda masuk sebagai <span class="text-info">{{ session('pengguna_login.email') ?? auth()->user()->email ?? 'admin@autocare.test' }}</span>
                                @else
                                    Akses Petugas / Admin Bengkel
                                @endif
                            </div>
                            <div class="text-secondary" style="font-size: 0.78rem;">
                                Masuk ke akun untuk mengelola data kendaraan, antrian servis, dan laporan.
                            </div>
                        </div>
                        @if (auth()->check() || session()->has('pengguna_login'))
                            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-success rounded-pill px-3 fw-semibold flex-shrink-0">
                                Ke Dasbor
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-sm btn-primary rounded-pill px-3 fw-semibold flex-shrink-0">
                                Login Sekarang
                            </a>
                        @endif
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                    @if (auth()->check() || session()->has('pengguna_login'))
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg rounded-pill px-5 fw-semibold shadow">
                            <i class="fa-solid fa-gauge-high me-2"></i> Buka Dasbor Bengkel
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-pill px-5 fw-semibold shadow">
                            <i class="fa-solid fa-right-to-bracket me-2"></i> Masuk ke Aplikasi
                        </a>
                    @endif
                    <a href="#fitur" class="btn btn-outline-light btn-lg rounded-pill px-4 fw-semibold border-secondary">
                        Lihat Fitur
                    </a>
                </div>
            </div>

            <!-- Kolom Kanan: Kartu Pratinjau Operasional -->
            <div class="col-lg-6">
                <div class="panel-pratinjau p-4">
                    <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom border-secondary border-opacity-50">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success bg-opacity-20 text-success px-3 py-1 rounded-pill small fw-semibold">
                                <i class="fa-solid fa-circle me-1" style="font-size: 7px;"></i> Sistem Aktif
                            </span>
                            <span class="text-secondary small d-none d-sm-inline">Ringkasan Operasional</span>
                        </div>
                        <span class="text-secondary small fw-medium">AutoCare Pro</span>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-sm-4">
                            <div class="kotak-mini p-3 h-100">
                                <span class="text-secondary small d-block">Antrian Hari Ini</span>
                                <h4 class="fw-bold text-white mb-1 mt-1">8 Unit</h4>
                                <span class="text-success small fw-medium">
                                    <i class="fa-solid fa-arrow-trend-up me-1"></i>Terjadwal
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="kotak-mini p-3 h-100">
                                <span class="text-secondary small d-block">Sedang Dikerjakan</span>
                                <h4 class="fw-bold text-primary mb-1 mt-1">3 Unit</h4>
                                <span class="text-secondary small">Ditangani mekanik</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="kotak-mini p-3 h-100">
                                <span class="text-secondary small d-block">Selesai Servis</span>
                                <h4 class="fw-bold text-success mb-1 mt-1">14 Unit</h4>
                                <span class="text-secondary small">Siap diambil</span>
                            </div>
                        </div>
                    </div>

                    <div class="kotak-mini p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-semibold text-white">Antrian Berjalan</span>
                            <span class="badge bg-primary bg-opacity-15 text-primary rounded-pill px-2 py-1 small">Terpantau</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-2 border-top border-secondary border-opacity-25">
                            <div class="d-flex align-items-center gap-3">
                                <div class="wadah-ikon bg-primary bg-opacity-15 text-primary" style="width: 38px; height: 38px; font-size: 0.95rem;">
                                    <i class="fa-solid fa-car"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold small text-white">B 1204 VYZ — Toyota Avanza</div>
                                    <div class="text-secondary" style="font-size: 0.78rem;">Pemilik: Budi Santoso • Servis Berkala</div>
                                </div>
                            </div>
                            <span class="badge bg-warning bg-opacity-20 text-warning rounded-pill px-3 py-1 small fw-semibold">Diproses</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-2 border-top border-secondary border-opacity-25">
                            <div class="d-flex align-items-center gap-3">
                                <div class="wadah-ikon bg-success bg-opacity-15 text-success" style="width: 38px; height: 38px; font-size: 0.95rem;">
                                    <i class="fa-solid fa-car"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold small text-white">D 4021 KNY — Honda Civic</div>
                                    <div class="text-secondary" style="font-size: 0.78rem;">Pemilik: Siti Aminah • Ganti Oli & Cek Kaki</div>
                                </div>
                            </div>
                            <span class="badge bg-info bg-opacity-20 text-info rounded-pill px-3 py-1 small fw-semibold">Menunggu</span>
                        </div>
                    </div>

                    <div class="kotak-mini p-3">
                        <div class="d-flex justify-content-between align-items-center small mb-2">
                            <span class="text-secondary fw-medium">Kapasitas Ruang Servis Hari Ini</span>
                            <span class="fw-bold text-white">75%</span>
                        </div>
                        <div class="progress bg-dark" style="height: 8px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Fitur Utama -->
        <section class="row g-4 mt-5 pt-4" id="fitur">
            <div class="col-md-4">
                <div class="p-4 kartu-fitur h-100">
                    <div class="wadah-ikon bg-primary bg-opacity-15 text-primary mb-3">
                        <i class="fa-solid fa-car"></i>
                    </div>
                    <h5 class="fw-bold text-white mb-2">Pendataan Kendaraan</h5>
                    <p class="text-secondary small mb-0">Catat nomor polisi, identitas pemilik, jenis kendaraan, dan riwayat servis secara rapi dan terpusat.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 kartu-fitur h-100">
                    <div class="wadah-ikon bg-warning bg-opacity-15 text-warning mb-3">
                        <i class="fa-solid fa-list-ol"></i>
                    </div>
                    <h5 class="fw-bold text-white mb-2">Pengelolaan Antrian</h5>
                    <p class="text-secondary small mb-0">Atur urutan dan perbarui status antrian dari menunggu, diproses mekanik, hingga selesai dengan cepat.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 kartu-fitur h-100">
                    <div class="wadah-ikon bg-success bg-opacity-15 text-success mb-3">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                    <h5 class="fw-bold text-white mb-2">Laporan & Cetak Dokumen</h5>
                    <p class="text-secondary small mb-0">Sajikan rekap data kendaraan dan antrian bengkel dalam format laporan siap cetak untuk kebutuhan operasional maupun tugas.</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="py-4 mt-5 border-top border-secondary border-opacity-25" style="background: #0b1120;">
        <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 text-secondary small">
            <div>&copy; {{ date('Y') }} <strong class="text-white">AutoCare Pro</strong>. Sistem Manajemen Bengkel & Antrian Kendaraan.</div>
            <div>Dibangun dengan Laravel & Bootstrap</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>