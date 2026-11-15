@extends('layouts.app')

@section('title', 'Laporan Bengkel')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: #0f172a;">Laporan Operasional Bengkel</h3>
        <p class="text-muted small mb-0">Rekapitulasi data kendaraan dan status antrian servis AutoCare Pro.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm fw-semibold px-3">
            Dasbor
        </a>
        <button type="button" onclick="window.print()" class="btn btn-primary btn-sm fw-semibold px-4">
            <i class="fa-solid fa-print me-2"></i> Cetak Laporan
        </button>
    </div>
</div>

<!-- Rekap Antrian Servis -->
<div class="card-panel p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Rekap Antrian Servis ({{ count($daftarAntrian) }} Data)</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle small mb-0">
            <thead class="table-light">
                <tr>
                    <th>No. Antrian</th>
                    <th>Nomor Polisi</th>
                    <th>Nama Pemilik</th>
                    <th>Layanan / Keluhan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($daftarAntrian as $item)
                    <tr>
                        <td class="fw-bold text-primary">{{ $item['no_antrian'] }}</td>
                        <td class="fw-semibold">{{ $item['plat'] }}</td>
                        <td>{{ $item['pemilik'] }}</td>
                        <td>{{ $item['keluhan'] }}</td>
                        <td>{{ $item['status'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">Belum ada data antrian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Rekap Data Kendaraan -->
<div class="card-panel p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Rekap Kendaraan Terdaftar ({{ count($daftarKendaraan) }} Unit)</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle small mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nomor Polisi</th>
                    <th>Kendaraan</th>
                    <th>Pemilik</th>
                    <th>No. Telepon</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($daftarKendaraan as $i => $k)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="fw-semibold">{{ $k['plat'] }}</td>
                        <td>{{ $k['kendaraan'] }}</td>
                        <td>{{ $k['pemilik'] }}</td>
                        <td>{{ $k['telepon'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">Belum ada data kendaraan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection