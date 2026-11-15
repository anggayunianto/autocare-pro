<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Layanan - AutoCare Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Data Layanan / Jasa - AutoCare Pro</h4>
                        <div>
                            <a href="{{ route('pelanggan.index') }}" class="btn btn-light btn-sm fw-bold me-1">Pelanggan</a>
                            <a href="{{ route('kendaraan.index') }}" class="btn btn-light btn-sm fw-bold me-2">Kendaraan</a>
                            <a href="{{ route('layanan.create') }}" class="btn btn-success btn-sm fw-bold">+ Tambah Layanan</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Layanan</th>
                                    <th>Biaya (Rp)</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($layanans as $index => $l)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $l->nama_layanan }}</td>
                                    <td>Rp {{ number_format($l->biaya, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('layanan.destroy', $l->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                            <a href="{{ route('layanan.edit', $l->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada data layanan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>