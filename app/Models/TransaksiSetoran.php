<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiSetoran extends Model
{
    protected $table = 'transaksi_setoran';

    // Tambahkan 'status' di sini agar tidak kena MassAssignmentException
    protected $fillable = [
        'warga_id', 
        'kategori_id', 
        'berat', 
        'total_koin', 
        'petugas_id', 
        'tanggal_setor', 
        'status' 
    ];

    // Relasi ke User
    public function user() {
        return $this->belongsTo(User::class, 'warga_id');
    }

    // Relasi ke Kategori Sampah
    public function kategoriSampah() {
        return $this->belongsTo(KategoriSampah::class, 'kategori_id');
    }
}