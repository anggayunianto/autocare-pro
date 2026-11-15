@extends('layouts.app')

@section('title', 'Dasbor')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1" style="color: #0f172a;">Dasbor Operasional</h2>
        <p class="text-muted small mb-0">Ringkasan data kendaraan dan antrian servis bengkel hari ini.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('kendaraan.index') }}" class="btn btn-outline-primary rounded-3 px-3 py-2 fw-semibold small">
            <i class="fa-solid fa-car me-1"></i> Data Kendaraan
        </a>
        <a href="{{ route('antrian.index') }}" class="btn btn-primary rounded-3 px-4 py-2 fw-semibold small shadow-sm">
            <i class="fa-solid fa-plus me-1"></i> Kelola Antrian
        </a>
    </div>
</div>

<!-- 4 Kartu Ringkasan -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card-panel p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="text-muted small fw-semibold">Total Kendaraan</span>
                    <h3 class="fw-bold mb-0 mt-1">{{ $totalKendaraan }} Unit</h3>
                </div>
                <div class="p-3 rounded-3 bg-primary bg-opacity-10 text-primary">
                    <i class="fa-solid fa-car fa-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-panel p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="text-muted small fw-semibold">Menunggu Antrian</span>
                    <h3 class="fw-bold mb-0 mt-1 text-warning">{{ $menunggu }} Unit</h3>
                </div>
                <div class="p-3 rounded-3 bg-warning bg-opacity-10 text-warning">
                    <i class="fa-solid fa-clock fa-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-panel p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="text-muted small fw-semibold">Sedang Diproses</span>
                    <h3 class="fw-bold mb-0 mt-1 text-info">{{ $diproses }} Unit</h3>
                </div>
                <div class="p-3 rounded-3 bg-info bg-opacity-10 text-info">
                    <i class="fa-solid fa-screwdriver-wrench fa-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-panel p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="text-muted small fw-semibold">Selesai Servis</span>
                    <h3 class="fw-bold mb-0 mt-1 text-success">{{ $selesai }} Unit</h3>
                </div>
                <div class="p-3 rounded-3 bg-success bg-opacity-10 text-success">
                    <i class="fa-solid fa-circle-check fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Daftar Antrian -->
<div class="card-panel p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Daftar Antrian Servis</h5>
        <a href="{{ route('antrian.index') }}" class="btn btn-sm btn-light border fw-semibold">Lihat Semua</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted small">
                <tr>
                    <th>No. Antrian</th>
                    <th>No. Polisi</th>
                    <th>Pemilik</th>
                    <th>Keluhan / Layanan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="small">
                @forelse ($daftarAntrian as $item)
                    <tr>
                        <td class="fw-bold text-primary">{{ $item['no_antrian'] }}</td>
                        <td class="fw-semibold">{{ $item['plat'] }}</td>
                        <td>{{ $item['pemilik'] }}</td>
                        <td>{{ $item['keluhan'] }}</td>
                        <td>
                            @if ($item['status'] === 'Selesai')
                                <span class="badge bg-success bg-opacity-15 text-success px-3 py-1 rounded-pill">Selesai</span>
                            @elseif ($item['status'] === 'Diproses')
                                <span class="badge bg-info bg-opacity-15 text-info px-3 py-1 rounded-pill">Diproses</span>
                            @else
                                <span class="badge bg-warning bg-opacity-15 text-warning px-3 py-1 rounded-pill">Menunggu</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada antrian servis.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection