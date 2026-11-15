<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    // Menampilkan daftar kendaraan beserta data pemiliknya
    public function index()
    {
        $kendaraans = Kendaraan::with('pelanggan')->get();
        return view('kendaraan.index', compact('kendaraans'));
    }

    // Menampilkan form tambah kendaraan (perlu data pelanggan untuk pilihan dropdown)
    public function create()
    {
        $pelanggans = Pelanggan::all();
        return view('kendaraan.create', compact('pelanggans'));
    }

    // Menyimpan data kendaraan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required',
            'nomor_polisi' => 'required|unique:kendaraans,nomor_polisi',
            'merk_model' => 'required',
            'tahun' => 'required',
        ]);

        Kendaraan::create($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil ditambahkan!');
    }

    // Menampilkan form edit kendaraan
    public function edit(Kendaraan $kendaraan)
    {
        $pelanggans = Pelanggan::all();
        return view('kendaraan.edit', compact('kendaraan', 'pelanggans'));
    }

    // Mengupdate data kendaraan
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'pelanggan_id' => 'required',
            'nomor_polisi' => 'required|unique:kendaraans,nomor_polisi,' . $kendaraan->id,
            'merk_model' => 'required',
            'tahun' => 'required',
        ]);

        $kendaraan->update($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil diperbarui!');
    }

    // Menghapus data kendaraan
    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();
        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil dihapus!');
    }
}