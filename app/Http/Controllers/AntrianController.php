<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Kendaraan;
use App\Models\Layanan;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    // Menampilkan daftar antrean servis
    public function index()
    {
        $antrians = Antrian::with(['kendaraan.pelanggan', 'layanan'])->get();
        return view('antrian.index', compact('antrians'));
    }

    // Menampilkan form tambah antrean
    public function create()
    {
        $kendaraans = Kendaraan::with('pelanggan')->get();
        $layanans = Layanan::all();
        
        // Generate nomor antrean otomatis (misal: ANT-001, dst)
        $lastAntrian = Antrian::latest()->first();
        $nextNumber = $lastAntrian ? $lastAntrian->id + 1 : 1;
        $nomorAntrian = 'ANT-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return view('antrian.create', compact('kendaraans', 'layanans', 'nomorAntrian'));
    }

    // Menyimpan data antrean baru
    public function store(Request $request)
    {
        $request->validate([
            'nomor_antrian' => 'required|unique:antrians,nomor_antrian',
            'kendaraan_id' => 'required',
            'layanan_id' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required',
        ]);

        Antrian::create($request->all());

        return redirect()->route('antrian.index')->with('success', 'Data antrean berhasil ditambahkan!');
    }

    // Menampilkan form edit antrean
    public function edit(Antrian $antrian)
    {
        $kendaraans = Kendaraan::with('pelanggan')->get();
        $layanans = Layanan::all();
        return view('antrian.edit', compact('antrian', 'kendaraans', 'layanans'));
    }

    // Mengupdate data antrean
    public function update(Request $request, Antrian $antrian)
    {
        $request->validate([
            'nomor_antrian' => 'required|unique:antrians,nomor_antrian,' . $antrian->id,
            'kendaraan_id' => 'required',
            'layanan_id' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required',
        ]);

        $antrian->update($request->all());

        return redirect()->route('antrian.index')->with('success', 'Data antrean berhasil diperbarui!');
    }

    // Menghapus data antrean
    public function destroy(Antrian $antrian)
    {
        $antrian->delete();
        return redirect()->route('antrian.index')->with('success', 'Data antrean berhasil dihapus!');
    }

    // Menampilkan halaman cetak struk nota servis
    public function cetak(Antrian $antrian)
    {
        return view('antrian.cetak', compact('antrian'));
    }
}