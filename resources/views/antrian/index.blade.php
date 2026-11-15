@extends('layouts.app')

@section('title', 'Data Antrean Servis')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4 py-3">
                <h4 class="mb-0 fs-5 fw-bold">Data Antrean Servis - AutoCare Pro</h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm fw-semibold">Dasbor</a>
                    <a href="{{ route('kendaraan.index') }}" class="btn btn-outline-light btn-sm fw-semibold">Data Kendaraan</a>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('antrian.store') }}" method="POST" class="row g-3 mb-4">
                    @csrf
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold">Nomor Polisi</label>
                        <input type="text" name="plat" class="form-control" placeholder="B 1234 XYZ" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold">Nama Pemilik</label>
                        <input type="text" name="pemilik" class="form-control" placeholder="Nama Pelanggan" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Keluhan / Jenis Servis</label>
                        <input type="text" name="keluhan" class="form-control" placeholder="Servis Berkala / Ganti Oli" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100 fw-semibold">Tambah</button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small text-muted">
                            <tr>
                                <th>No. Antrian</th>
                                <th>Nomor Polisi</th>
                                <th>Pemilik</th>
                                <th>Keluhan</th>
                                <th>Status</th>
                                <th class="text-end">Ubah Status</th>
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
                                    <td class="text-end">
                                        <form action="{{ route('antrian.status', $item['id']) }}" method="POST" class="d-inline-flex gap-1">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <option value="Menunggu" {{ $item['status'] === 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                <option value="Diproses" {{ $item['status'] === 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="Selesai" {{ $item['status'] === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada antrean servis.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection