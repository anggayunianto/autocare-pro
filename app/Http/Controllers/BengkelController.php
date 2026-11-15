<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BengkelController extends Controller
{
    private function ambilKendaraan(Request $request): array
    {
        return $request->session()->get('kendaraan', [
            ['id' => 1, 'plat' => 'B 1204 VYZ', 'kendaraan' => 'Toyota Avanza 1.5G', 'pemilik' => 'Budi Santoso', 'telepon' => '0812-3456-7890'],
            ['id' => 2, 'plat' => 'D 4021 KNY', 'kendaraan' => 'Honda Civic Turbo', 'pemilik' => 'Siti Aminah', 'telepon' => '0813-4567-8901'],
            ['id' => 3, 'plat' => 'B 8891 RKL', 'kendaraan' => 'Mitsubishi Xpander', 'pemilik' => 'Ahmad Fauzi', 'telepon' => '0857-1122-3344'],
            ['id' => 4, 'plat' => 'F 1920 ABC', 'kendaraan' => 'Suzuki Ertiga GX', 'pemilik' => 'Rina Kartika', 'telepon' => '0821-9988-7766'],
            ['id' => 5, 'plat' => 'B 2745 UJM', 'kendaraan' => 'Daihatsu Terios R', 'pemilik' => 'Dedi Kurniawan', 'telepon' => '0819-5544-3322'],
            ['id' => 6, 'plat' => 'B 7712 PLK', 'kendaraan' => 'Honda HR-V SE', 'pemilik' => 'Nadia Putri', 'telepon' => '0812-8877-6655'],
            ['id' => 7, 'plat' => 'A 5032 ZXC', 'kendaraan' => 'Toyota Innova Zenix', 'pemilik' => 'Hendra Wijaya', 'telepon' => '0811-2233-4455'],
            ['id' => 8, 'plat' => 'B 9103 QWE', 'kendaraan' => 'Mazda CX-5 Elite', 'pemilik' => 'Farhan Maulana', 'telepon' => '0878-6655-4433'],
        ]);
    }

    private function ambilAntrian(Request $request): array
    {
        return $request->session()->get('antrian', [
            ['id' => 1, 'no_antrian' => 'A-01', 'plat' => 'B 1204 VYZ', 'pemilik' => 'Budi Santoso', 'keluhan' => 'Servis Berkala 20.000 KM & Tune Up', 'status' => 'Selesai'],
            ['id' => 2, 'no_antrian' => 'A-02', 'plat' => 'D 4021 KNY', 'pemilik' => 'Siti Aminah', 'keluhan' => 'Ganti Oli Mesin & Filter Oli', 'status' => 'Selesai'],
            ['id' => 3, 'no_antrian' => 'A-03', 'plat' => 'B 8891 RKL', 'pemilik' => 'Ahmad Fauzi', 'keluhan' => 'Pengecekan Kampas Rem & Spooring', 'status' => 'Selesai'],
            ['id' => 4, 'no_antrian' => 'A-04', 'plat' => 'F 1920 ABC', 'pemilik' => 'Rina Kartika', 'keluhan' => 'AC Kurang Dingin & Isi Freon', 'status' => 'Diproses'],
            ['id' => 5, 'no_antrian' => 'A-05', 'plat' => 'B 2745 UJM', 'pemilik' => 'Dedi Kurniawan', 'keluhan' => 'Ganti Aki & Cek Kelistrikan', 'status' => 'Diproses'],
            ['id' => 6, 'no_antrian' => 'A-06', 'plat' => 'B 7712 PLK', 'pemilik' => 'Nadia Putri', 'keluhan' => 'Bunyi pada Kaki-Kaki Depan', 'status' => 'Menunggu'],
            ['id' => 7, 'no_antrian' => 'A-07', 'plat' => 'A 5032 ZXC', 'pemilik' => 'Hendra Wijaya', 'keluhan' => 'Servis Rutin & Balancing Ban', 'status' => 'Menunggu'],
            ['id' => 8, 'no_antrian' => 'A-08', 'plat' => 'B 9103 QWE', 'pemilik' => 'Farhan Maulana', 'keluhan' => 'Ganti Minyak Rem & Cek Kopling', 'status' => 'Menunggu'],
        ]);
    }

    public function dashboard(Request $request)
    {
        $kendaraan =$this->ambilKendaraan($request);$antrian = $this->ambilAntrian($request);

        return view('dashboard', [
            'totalKendaraan' => count($kendaraan),
            'menunggu' => collect($antrian)->where('status', 'Menunggu')->count(),
            'diproses' => collect($antrian)->where('status', 'Diproses')->count(),
            'selesai' => collect($antrian)->where('status', 'Selesai')->count(),
            'daftarAntrian' => $antrian,
        ]);
    }

    public function kendaraan(Request $request)
    {
        return view('kendaraan.index', [
            'daftarKendaraan' => $this->ambilKendaraan($request),
        ]);
    }

    public function simpanKendaraan(Request $request)
    {
        $data =$request->validate([
            'plat' => 'required|string|max:20',
            'kendaraan' => 'required|string|max:100',
            'pemilik' => 'required|string|max:100',
            'telepon' => 'required|string|max:25',
        ]);

        $list = $this->ambilKendaraan($request);
        $data['id'] = count($list) + 1;
        $list[] =$data;

        $request->session()->put('kendaraan',$list);

        return redirect()->route('kendaraan.index')->with('sukses', 'Data kendaraan berhasil ditambahkan.');
    }

    public function antrian(Request $request)
    {
        return view('antrian.index', [
            'daftarKendaraan' => $this->ambilKendaraan($request),
            'daftarAntrian' => $this->ambilAntrian($request),
        ]);
    }

    public function simpanAntrian(Request $request)
    {
        $data =$request->validate([
            'plat' => 'required|string|max:20',
            'pemilik' => 'required|string|max:100',
            'keluhan' => 'required|string|max:255',
        ]);

        $list = $this->ambilAntrian($request);
        $nomor = count($list) + 1;
        $list[] = [
            'id' => $nomor,
            'no_antrian' => 'A-' . str_pad((string) $nomor, 2, '0', STR_PAD_LEFT),
            'plat' => $data['plat'],
            'pemilik' => $data['pemilik'],
            'keluhan' => $data['keluhan'],
            'status' => 'Menunggu',
        ];

        $request->session()->put('antrian',$list);

        return redirect()->route('antrian.index')->with('sukses', 'Antrian servis baru berhasil dibuat.');
    }

    public function updateStatusAntrian(Request $request, int$id)
    {
        $request->validate(['status' => 'required\vert{}in:Menunggu,Diproses,Selesai']);$list = $this->ambilAntrian($request);

        foreach ($list as &$item) {
            if ($item['id'] ===$id) {
                $item['status'] =$request->input('status');
            }
        }

        $request->session()->put('antrian',$list);

        return redirect()->route('antrian.index')->with('sukses', 'Status antrian diperbarui.');
    }

    public function laporan(Request $request)
    {
        return view('laporan.index', [
            'daftarKendaraan' => $this->ambilKendaraan($request),
            'daftarAntrian' => $this->ambilAntrian($request),
        ]);
    }
}