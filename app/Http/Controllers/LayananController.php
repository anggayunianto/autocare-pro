<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    // Menampilkan daftar layanan
    public function index()
    {
        $layanans = Layanan::all();
        return view('layanan.index', compact('layanans'));
    }

    // Menampilkan form tambah layanan
    public function create()
    {
        return view('layanan.create');
    }

    // Menyimpan data layanan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required',
            'biaya' => 'required|numeric',
        ]);

        Layanan::create($request->all());

        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil ditambahkan!');
    }

    // Menampilkan form edit layanan
    public function edit(Layanan $layanan)
    {
        return view('layanan.edit', compact('layanan'));
    }

    // Mengupdate data layanan
    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'nama_layanan' => 'required',
            'biaya' => 'required|numeric',
        ]);

        $layanan->update($request->all());

        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil diperbarui!');
    }

    // Menghapus data layanan
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil dihapus!');
    }
}