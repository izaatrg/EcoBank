<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    // Tambahkan ini agar Laravel sinkron dengan file migrasi Anda
    protected $table = 'barang_keluar'; 

    protected $fillable = [
        'nama_barang', 
        'tujuan', 
        'jumlah', 
        'tanggal_keluar'
    ];
}