<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiSetoran extends Model
{
    use HasFactory;

    protected $table = 'transaksi_setoran';

    protected $fillable = [
        'warga_id', 
        'kategori_id', 
        'berat', 
        'total_koin', 
        'petugas_id', 
        'tanggal_setor', 
        'status' 
    ];

    // SATUKAN NAMA RELASI AGAR SESUAI DENGAN CONTROLLER
    public function warga() {
        return $this->belongsTo(User::class, 'warga_id');
    }

    public function kategori() {
        return $this->belongsTo(KategoriSampah::class, 'kategori_id');
    }
}