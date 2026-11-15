<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    
    protected $table = 'pelanggans';
    protected $fillable = ['nama', 'telepon', 'alamat'];

    // Relasi: Satu pelanggan bisa punya banyak kendaraan
    public function kendaraans()
    {
        return $this->hasMany(Kendaraan::class);
    }
}