@extends('layouts.app')

@section('title', 'Data Kendaraan')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4 py-3">
                <h4 class="mb-0 fs-5 fw-bold">Data Kendaraan - AutoCare Pro</h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm fw-semibold">
                        Dasbor
                    </a>
                    <a href="{{ route('antrian.index') }}" class="btn btn-outline-light btn-sm fw-semibold">
                        Antrian Servis
                    </a>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('kendaraan.store') }}" method="POST" class="row g-3 mb-4">
                    @csrf
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold">Nomor Polisi</label>
                        <input type="text" name="plat" class="form-control" placeholder="B 1234 XYZ" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold">Merk / Model Kendaraan</label>
                        <input type="text" name="kendaraan" class="form-control" placeholder="Toyota Avanza" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold">Nama Pemilik</label>
                        <input type="text" name="pemilik" class="form-control" placeholder="Budi Santoso" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold">No. Telepon</label>
                        <div class="input-group">
                            <input type="text" name="telepon" class="form-control" placeholder="08123456789" required>
                            <button type="submit" class="btn btn-primary fw-semibold">Simpan</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small text-muted">
                            <tr>
                                <th>No</th>
                                <th>Nomor Polisi</th>
                                <th>Kendaraan</th>
                                <th>Pemilik</th>
                                <th>Telepon</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            @forelse ($daftarKendaraan as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="fw-bold text-primary">{{ $item['plat'] }}</td>
                                    <td>{{ $item['kendaraan'] }}</td>
                                    <td>{{ $item['pemilik'] }}</td>
                                    <td>{{ $item['telepon'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada data kendaraan.</td>
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