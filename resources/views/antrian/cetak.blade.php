<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Servis - {{ $antrian->nomor_antrian }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #fff; color: #000; font-family: monospace; }
        .invoice-box { max-width: 600px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="invoice-box my-5">
        <div class="text-center mb-4">
            <h3 class="fw-bold mb-0">AUTOCARE PRO WORKSHOP</h3>
            <p class="text-muted small mb-1">Jl. Otomotif Raya No. 45, Jakarta | Telp: 0812-3456-7890</p>
            <hr>
            <h5 class="fw-bold text-uppercase">NOTA BUKTI SERVIS KENDARAAN</h5>
        </div>

        <table class="table table-sm borderless mb-3">
            <tr>
                <td width="35%"><strong>No. Antrean</strong></td>
                <td>: <span class="badge bg-dark">{{ $antrian->nomor_antrian }}</span></td>
            </tr>
            <tr>
                <td><strong>Tanggal Servis</strong></td>
                <td>: {{ $antrian->tanggal }}</td>
            </tr>
            <tr>
                <td><strong>Nama Pelanggan</strong></td>
                <td>: {{ $antrian->kendaraan->pelanggan->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>No. Telepon</strong></td>
                <td>: {{ $antrian->kendaraan->pelanggan->telepon ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Kendaraan</strong></td>
                <td>: {{ $antrian->kendaraan->merk_model ?? '-' }} (<strong>{{ $antrian->kendaraan->nomor_polisi ?? '-' }}</strong>)</td>
            </tr>
            <tr>
                <td><strong>Status Pengerjaan</strong></td>
                <td>: <strong>{{ $antrian->status }}</strong></td>
            </tr>
        </table>

        <table class="table table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Jenis Layanan / Jasa</th>
                    <th>Biaya</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $antrian->layanan->nama_layanan ?? '-' }}</td>
                    <td class="text-end">Rp {{ number_format($antrian->layanan->biaya ?? 0, 0, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-end">Total Pembayaran:</th>
                    <th class="text-end text-success">Rp {{ number_format($antrian->layanan->biaya ?? 0, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>

        <div class="row mt-5 text-center">
            <div class="col-6 offset-6">
                <p class="mb-5">Hormat Kami,<br><strong>Kasir / Admin AutoCare Pro</strong></p>
                <br>
                <p class="fw-bold">( ........................................ )</p>
            </div>
        </div>

        <div class="text-center mt-4 no-print">
            <button onclick="window.print()" class="btn btn-primary btn-sm">Cetak Ulang Nota</button>
            <a href="{{ route('antrian.index') }}" class="btn btn-secondary btn-sm">Kembali ke Antrean</a>
        </div>
    </div>
</body>
</html>