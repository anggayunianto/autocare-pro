<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraans';
    protected $fillable = ['pelanggan_id', 'nomor_polisi', 'merk_model', 'tahun'];

    // Relasi: Kendaraan milik satu pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    // Relasi: Kendaraan bisa punya banyak data antrean servis
    public function antrians()
    {
        return $this->hasMany(Antrian::class);
    }
}
