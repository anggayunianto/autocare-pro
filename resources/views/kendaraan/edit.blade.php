<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kendaraan - AutoCare Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Edit Data Kendaraan</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Pemilik (Pelanggan)</label>
                                <select name="pelanggan_id" class="form-control" required>
                                    <option value="">-- Pilih Pelanggan --</option>
                                    @foreach($pelanggans as $p)
                                        <option value="{{ $p->id }}" {{ $kendaraan->pelanggan_id == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama }} ({{ $p->telepon }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomor Polisi</label>
                                <input type="text" name="nomor_polisi" value="{{ $kendaraan->nomor_polisi }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Merk / Model Kendaraan</label>
                                <input type="text" name="merk_model" value="{{ $kendaraan->merk_model }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tahun Kendaraan</label>
                                <input type="text" name="tahun" value="{{ $kendaraan->tahun }}" class="form-control" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Update Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>