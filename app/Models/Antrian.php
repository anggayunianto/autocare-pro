<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $table = 'antrians';
    protected $fillable = ['nomor_antrian', 'kendaraan_id', 'layanan_id', 'tanggal', 'status'];

    // Relasi: Antrian terhubung ke satu kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    // Relasi: Antrian terhubung ke satu jenis layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}