<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSampah extends Model
{
    use HasFactory;

    protected $table = 'kategori_sampah';

    protected $fillable = [
        'nama_kategori',
        'koin_per_kg'
    ];

    public function transaksiSetoran()
    {
        return $this->hasMany(TransaksiSetoran::class, 'kategori_id');
    }
}
