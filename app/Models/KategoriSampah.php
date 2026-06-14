<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSampah extends Model
{
    use HasFactory;
    protected $table = 'kategori_sampah';
    protected $fillable = ['nama', 'harga', 'stok', 'kondisi'];

    public function getNamaKategoriAttribute(): ?string
    {
        return $this->nama;
    }

    public function getKoinPerKgAttribute(): ?int
    {
        return $this->harga;
    }
}