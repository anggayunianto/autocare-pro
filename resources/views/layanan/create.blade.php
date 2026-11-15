<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Layanan - AutoCare Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Tambah Layanan Baru</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('layanan.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Layanan / Servis</label>
                                <input type="text" name="nama_layanan" class="form-control" placeholder="Contoh: Service Ringan / Ganti Oli" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Biaya (Rp)</label>
                                <input type="number" name="biaya" class="form-control" placeholder="Contoh: 50000" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('layanan.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-success">Simpan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>