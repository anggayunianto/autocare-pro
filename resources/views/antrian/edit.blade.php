<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Antrean - AutoCare Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Edit Data Antrean Servis</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('antrian.update', $antrian->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Nomor Antrean</label>
                                <input type="text" name="nomor_antrian" value="{{ $antrian->nomor_antrian }}" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pilih Kendaraan (Pelanggan)</label>
                                <select name="kendaraan_id" class="form-control" required>
                                    <option value="">-- Pilih Kendaraan & Pemilik --</option>
                                    @foreach($kendaraans as $k)
                                        <option value="{{ $k->id }}" {{ $antrian->kendaraan_id == $k->id ? 'selected' : '' }}>
                                            {{ $k->nomor_polisi }} - {{ $k->merk_model }} (Pemilik: {{ $k->pelanggan->nama ?? '-' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Layanan Servis</label>
                                <select name="layanan_id" class="form-control" required>
                                    <option value="">-- Pilih Layanan --</option>
                                    @foreach($layanans as $l)
                                        <option value="{{ $l->id }}" {{ $antrian->layanan_id == $l->id ? 'selected' : '' }}>
                                            {{ $l->nama_layanan }} (Rp {{ number_format($l->biaya, 0, ',', '.') }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Servis</label>
                                <input type="date" name="tanggal" value="{{ $antrian->tanggal }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status Pengerjaan</label>
                                <select name="status" class="form-control" required>
                                    <option value="Menunggu" {{ $antrian->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="Proses" {{ $antrian->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="Selesai" {{ $antrian->status == 'Selesai' ? 'selected' : '' }}>Selesai</p>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('antrian.index') }}" class="btn btn-secondary">Kembali</a>
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