<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanans';
    protected $fillable = ['nama_layanan', 'biaya'];

    // Relasi: Layanan bisa dipilih di banyak antrean
    public function antrians()
    {
        return $this->hasMany(Antrian::class);
    }
}
