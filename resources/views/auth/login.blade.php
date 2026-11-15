<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — AutoCare Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #070c17;
            --panel-bg: rgba(15, 23, 42, 0.86);
            --card-border: rgba(148, 163, 184, 0.15);
            --input-bg: rgba(7, 12, 23, 0.9);
            --accent-blue: #3b82f6;
            --accent-cyan: #06b6d4;
            --accent-amber: #f59e0b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
        }

        /* Grid latar belakang bengkel digital */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(59, 130, 246, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.05) 1px, transparent 1px);
            background-size: 38px 38px;
            mask-image: radial-gradient(circle at center, black 35%, transparent 85%);
            pointer-events: none;
            z-index: 0;
        }

        .ambient-glow {
            position: fixed;
            border-radius: 50%;
            filter: blur(95px);
            pointer-events: none;
            z-index: 0;
            opacity: 0.42;
            animation: driftGlow 11s ease-in-out infinite alternate;
        }

        .glow-left {
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, #2563eb, transparent 70%);
            top: -90px;
            left: -70px;
        }

        .glow-right {
            width: 360px;
            height: 360px;
            background: radial-gradient(circle, #06b6d4, transparent 70%);
            bottom: -100px;
            right: -60px;
            animation-delay: -4s;
        }

        @keyframes driftGlow {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(40px, 30px) scale(1.1); }
        }

        @keyframes sceneEnter {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.985);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes spinGear {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes spinGearReverse {
            from { transform: rotate(360deg); }
            to { transform: rotate(0deg); }
        }

        @keyframes carHover {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-4px); }
        }

        @keyframes roadScroll {
            from { transform: translateX(0); }
            to { transform: translateX(-80px); }
        }

        @keyframes spotlightPulse {
            0%, 100% { opacity: 0.22; }
            50% { opacity: 0.48; }
        }

        .main-shell {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 980px;
            animation: sceneEnter 0.65s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        .portal-card {
            background: var(--panel-bg);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid var(--card-border);
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow:
                0 28px 60px -15px rgba(0, 0, 0, 0.7),
                inset 0 1px 0 rgba(255, 255, 255, 0.08);
        }

        /* Panel Kiri: Visual Mobil & Bengkel */
        .workshop-stage {
            background:
                radial-gradient(circle at 25% 20%, rgba(59, 130, 246, 0.22), transparent 55%),
                radial-gradient(circle at 80% 80%, rgba(6, 182, 212, 0.16), transparent 55%),
                linear-gradient(165deg, #0f1c36 0%, #091122 100%);
            border-bottom: 1px solid var(--card-border);
            position: relative;
            overflow: hidden;
        }

        @media (min-width: 992px) {
            .workshop-stage {
                border-bottom: none;
                border-right: 1px solid var(--card-border);
            }
        }

        .gear-spin {
            display: inline-block;
            animation: spinGear 14s linear infinite;
        }

        .gear-spin-reverse {
            display: inline-block;
            animation: spinGearReverse 10s linear infinite;
        }

        .car-stage-box {
            background: rgba(7, 12, 23, 0.65);
            border: 1px solid rgba(148, 163, 184, 0.14);
            border-radius: 1.15rem;
            position: relative;
            overflow: hidden;
        }

        .spotlight-beam {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 220px;
            height: 130px;
            background: radial-gradient(ellipse at top, rgba(56, 189, 248, 0.35), transparent 72%);
            animation: spotlightPulse 3.6s ease-in-out infinite;
            pointer-events: none;
        }

        .car-float {
            animation: carHover 3.2s ease-in-out infinite;
            filter: drop-shadow(0 12px 18px rgba(14, 165, 233, 0.25));
        }

        .wheel-spin {
            transform-box: fill-box;
            transform-origin: center;
            animation: spinGear 2.4s linear infinite;
        }

        .road-strip {
            height: 26px;
            background: linear-gradient(180deg, #111827 0%, #090e1a 100%);
            border-top: 1px solid rgba(148, 163, 184, 0.16);
            position: relative;
            overflow: hidden;
        }

        .road-dashes {
            position: absolute;
            top: 11px;
            left: 0;
            width: 200%;
            height: 3px;
            background-image: repeating-linear-gradient(
                90deg,
                rgba(56, 189, 248, 0.55) 0px,
                rgba(56, 189, 248, 0.55) 28px,
                transparent 28px,
                transparent 56px
            );
            animation: roadScroll 1.8s linear infinite;
        }

        .bay-pill {
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(148, 163, 184, 0.14);
            border-radius: 0.75rem;
            padding: 0.55rem 0.75rem;
            font-size: 0.76rem;
        }

        /* Panel Kanan: Form Login */
        .brand-icon-wrap {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.22), rgba(6, 182, 212, 0.18));
            border: 1px solid rgba(59, 130, 246, 0.35);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            pointer-events: none;
            transition: color 0.2s ease;
        }

        .form-control {
            background-color: var(--input-bg);
            border: 1px solid rgba(148, 163, 184, 0.18);
            color: #f8fafc;
            padding: 0.72rem 2.75rem 0.72rem 2.65rem;
            border-radius: 0.8rem;
            font-size: 0.92rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control::placeholder {
            color: #64748b;
        }

        .form-control:focus {
            background-color: rgba(15, 23, 42, 0.96);
            border-color: var(--accent-blue);
            color: #ffffff;
            box-shadow: 0 0 0 3.5px rgba(59, 130, 246, 0.22);
        }

        .input-wrap:focus-within .input-icon {
            color: #60a5fa;
        }

        .btn-toggle-pass {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: #64748b;
            padding: 0.25rem 0.45rem;
            border-radius: 0.5rem;
            transition: color 0.2s ease, background 0.2s ease;
        }

        .btn-toggle-pass:hover {
            color: #e2e8f0;
            background: rgba(255, 255, 255, 0.06);
        }

        .btn-login {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 50%, #06b6d4 100%);
            background-size: 200% auto;
            border: none;
            border-radius: 0.85rem;
            padding: 0.78rem 1.25rem;
            font-weight: 700;
            box-shadow: 0 12px 26px -6px rgba(37, 99, 235, 0.48);
            transition: background-position 0.4s ease, transform 0.18s ease, box-shadow 0.25s ease;
        }

        .btn-login:hover {
            background-position: right center;
            transform: translateY(-2px);
            box-shadow: 0 16px 30px -6px rgba(59, 130, 246, 0.58);
        }

        .demo-card {
            background: rgba(7, 12, 23, 0.65);
            border: 1px dashed rgba(148, 163, 184, 0.24);
            border-radius: 0.85rem;
        }

        .link-home {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .link-home:hover {
            color: #f8fafc;
        }
    </style>
</head>
<body class="p-3 p-md-4">
    <div class="ambient-glow glow-left"></div>
    <div class="ambient-glow glow-right"></div>

    <div class="main-shell">
        <div class="portal-card">
            <div class="row g-0">
                <!-- KOLOM KIRI: VISUAL BENGKEL & MOBIL -->
                <div class="col-lg-6 workshop-stage p-4 p-sm-5 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="badge rounded-pill px-3 py-2 fw-semibold" style="background: rgba(59, 130, 246, 0.18); color: #7dd3fc; border: 1px solid rgba(56, 189, 248, 0.3); font-size: 0.75rem;">
                                <i class="fa-solid fa-warehouse me-1"></i> Workshop Control Center
                            </span>
                            <div class="text-info d-flex align-items-center gap-2 small">
                                <i class="fa-solid fa-gear gear-spin"></i>
                                <i class="fa-solid fa-gear gear-spin-reverse text-primary"></i>
                            </div>
                        </div>

                        <h2 class="fw-extrabold fs-3 mb-2 lh-sm">
                            Bengkel Terpadu & <span class="text-info">Antrian Kendaraan</span> Real-Time
                        </h2>
                        <p class="text-secondary small mb-4">
                            Pantau unit mobil masuk, proses servis mekanik, hingga cetak laporan bengkel dalam satu sistem.
                        </p>
                    </div>

                    <!-- Ilustrasi Bengkel & Mobil -->
                    <div class="car-stage-box p-3 pt-4 mb-4">
                        <div class="spotlight-beam"></div>

                        <div class="d-flex justify-content-between align-items-center px-2 mb-2 position-relative" style="z-index: 2;">
                            <span class="small fw-semibold text-light">
                                <i class="fa-solid fa-screwdriver-wrench text-warning me-1"></i> Service Bay #01
                            </span>
                            <span class="badge bg-success bg-opacity-20 text-success rounded-pill px-2.5 py-1" style="font-size: 0.7rem;">
                                <i class="fa-solid fa-circle me-1" style="font-size: 6px;"></i> Bengkel Aktif
                            </span>
                        </div>

                        <!-- SVG Garasi Bengkel + Mobil Sedan Modern -->
                        <div class="text-center position-relative" style="z-index: 2;">
                            <svg viewBox="0 0 420 155" class="w-100" style="max-height: 155px;" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Atap & Struktur Garasi Bengkel -->
                                <path d="M24 44L210 10L396 44V135H24V44Z" fill="#0b1528" stroke="#1e3a5f" stroke-width="2"/>
                                <rect x="52" y="48" width="316" height="82" rx="6" fill="#081020" stroke="#1e293b" stroke-width="1.5"/>
                                <!-- Garis pintu rolling door bengkel -->
                                <line x1="60" y1="62" x2="360" y2="62" stroke="#1e293b" stroke-width="1.5"/>
                                <line x1="60" y1="76" x2="360" y2="76" stroke="#1e293b" stroke-width="1.5"/>
                                <line x1="60" y1="90" x2="360" y2="90" stroke="#1e293b" stroke-width="1.5"/>
                                <line x1="60" y1="104" x2="360" y2="104" stroke="#1e293b" stroke-width="1.5"/>
                                <!-- Papan nama bengkel di atas -->
                                <rect x="135" y="23" width="150" height="18" rx="4" fill="#172554" stroke="#3b82f6" stroke-width="1"/>
                                <text x="210" y="35" text-anchor="middle" fill="#93c5fd" font-size="8.5" font-weight="700" font-family="Plus Jakarta Sans, sans-serif">AUTOCARE WORKSHOP</text>

                                <!-- Mobil Utama Melayang Halus -->
                                <g class="car-float">
                                    <!-- Bayangan di lantai -->
                                    <ellipse cx="210" cy="131" rx="92" ry="6" fill="rgba(56, 189, 248, 0.18)"/>

                                    <!-- Bodi Mobil -->
                                    <path d="M126 112L136 93C140 86 147 82 155 82H172L188 65C193 60 200 58 208 58H245C254 58 262 62 267 69L278 82H295C304 82 311 88 313 97L316 112H126Z"
                                          fill="url(#carBodyGrad)" stroke="#7dd3fc" stroke-width="1.5"/>

                                    <!-- Kaca Jendela Mobil -->
                                    <path d="M179 81L192 66C196 63 201 61 207 61H243C249 61 254 64 258 68L268 81H179Z"
                                          fill="#0f172a" stroke="#38bdf8" stroke-width="1"/>
                                    <line x1="226" y1="61" x2="226" y2="81" stroke="#38bdf8" stroke-width="1.2"/>

                                    <!-- Lampu Depan & Belakang -->
                                    <rect x="302" y="92" width="11" height="6" rx="2" fill="#fde047"/>
                                    <rect x="128" y="92" width="9" height="6" rx="2" fill="#f87171"/>

                                    <!-- Roda Depan & Belakang -->
                                    <g transform="translate(165, 113)" class="wheel-spin">
                                        <circle r="15" fill="#090e1a" stroke="#94a3b8" stroke-width="2.5"/>
                                        <circle r="7" fill="#38bdf8"/>
                                        <line x1="-12" y1="0" x2="12" y2="0" stroke="#cbd5e1" stroke-width="1.5"/>
                                        <line x1="0" y1="-12" x2="0" y2="12" stroke="#cbd5e1" stroke-width="1.5"/>
                                    </g>
                                    <g transform="translate(275, 113)" class="wheel-spin">
                                        <circle r="15" fill="#090e1a" stroke="#94a3b8" stroke-width="2.5"/>
                                        <circle r="7" fill="#38bdf8"/>
                                        <line x1="-12" y1="0" x2="12" y2="0" stroke="#cbd5e1" stroke-width="1.5"/>
                                        <line x1="0" y1="-12" x2="0" y2="12" stroke="#cbd5e1" stroke-width="1.5"/>
                                    </g>
                                </g>

                                <defs>
                                    <linearGradient id="carBodyGrad" x1="126" y1="58" x2="316" y2="115" gradientUnits="userSpaceOnUse">
                                        <stop offset="0%" stop-color="#2563eb"/>
                                        <stop offset="55%" stop-color="#0284c7"/>
                                        <stop offset="100%" stop-color="#06b6d4"/>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>

                        <!-- Jalur Jalan Bengkel Bergerak -->
                        <div class="road-strip rounded-bottom-3 mt-1">
                            <div class="road-dashes"></div>
                        </div>
                    </div>

                    <!-- Indikator Bay Bengkel -->
                    <div class="row g-2">
                        <div class="col-4">
                            <div class="bay-pill">
                                <div class="text-secondary" style="font-size: 0.68rem;">Bay 01</div>
                                <div class="fw-semibold text-white text-truncate">Tune Up</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bay-pill">
                                <div class="text-secondary" style="font-size: 0.68rem;">Bay 02</div>
                                <div class="fw-semibold text-info text-truncate">Ganti Oli</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bay-pill">
                                <div class="text-secondary" style="font-size: 0.68rem;">Bay 03</div>
                                <div class="fw-semibold text-success text-truncate">Spooring</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: FORM LOGIN -->
                <div class="col-lg-6 p-4 p-sm-5 d-flex flex-column justify-content-center">
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="brand-icon-wrap text-primary">
                                <i class="fa-solid fa-car-side fa-lg"></i>
                            </div>
                            <div>
                                <h4 class="fw-extrabold mb-0">AutoCare<span class="text-primary">Pro</span></h4>
                                <span class="text-secondary small">Portal Masuk Petugas Bengkel</span>
                            </div>
                        </div>
                        <p class="text-secondary small mb-0">
                            Silakan masukkan email dan kata sandi akun Anda untuk membuka dasbor.
                        </p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 py-2.5 px-3 small rounded-3 d-flex align-items-center gap-2 mb-3" style="background: rgba(239, 68, 68, 0.16); color: #fca5a5;">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST" id="loginForm">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-light">Alamat Email</label>
                            <div class="input-wrap">
                                <i class="fa-solid fa-envelope input-icon"></i>
                                <input
                                    type="email"
                                    name="email"
                                    id="emailInput"
                                    value="{{ old('email', 'admin@autocare.test') }}"
                                    class="form-control"
                                    placeholder="admin@autocare.test"
                                    required
                                    autofocus
                                >
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-light">Kata Sandi</label>
                            <div class="input-wrap">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <input
                                    type="password"
                                    name="password"
                                    id="passwordInput"
                                    value="password123"
                                    class="form-control"
                                    placeholder="••••••••"
                                    required
                                >
                                <button type="button" class="btn-toggle-pass" id="togglePassword" title="Lihat / Sembunyikan Kata Sandi">
                                    <i class="fa-solid fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label small text-secondary" for="remember">
                                    Ingat sesi login
                                </label>
                            </div>
                            <span class="badge bg-primary bg-opacity-15 text-primary rounded-pill px-2.5 py-1" style="font-size: 0.72rem;">
                                <i class="fa-solid fa-wrench me-1"></i> Mode Admin
                            </span>
                        </div>

                        <button type="submit" class="btn btn-login text-white w-100 mb-3" id="submitBtn">
                            <span id="submitText"><i class="fa-solid fa-right-to-bracket me-2"></i>Masuk ke Dasbor Bengkel</span>
                        </button>
                    </form>

                    <div class="demo-card p-3 mb-3">
                        <div class="d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <div class="small fw-semibold text-light">Kredensial Demo Bengkel</div>
                                <div class="text-secondary" style="font-size: 0.75rem;">admin@autocare.test • password123</div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 fw-semibold" id="fillDemoBtn">
                                Isi Otomatis
                            </button>
                        </div>
                    </div>

                    <div class="text-center pt-1">
                        <a href="{{ route('home') }}" class="link-home small">
                            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Halaman Depan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');
        const toggleIcon = document.getElementById('toggleIcon');

        toggleBtn.addEventListener('click', () => {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';
            toggleIcon.classList.toggle('fa-eye', !isHidden);
            toggleIcon.classList.toggle('fa-eye-slash', isHidden);
        });

        document.getElementById('fillDemoBtn').addEventListener('click', () => {
            document.getElementById('emailInput').value = 'admin@autocare.test';
            passwordInput.value = 'password123';
        });

        document.getElementById('loginForm').addEventListener('submit', () => {
            const btn = document.getElementById('submitBtn');
            const text = document.getElementById('submitText');
            btn.disabled = true;
            text.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Memproses...';
        });
    </script>
</body>
</html>