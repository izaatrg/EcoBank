<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    // Penting: agar Laravel tidak mencari tabel 'barang_masuks'
    protected $table = 'barang_masuk';

    protected $fillable = [
        'kode_transaksi', 'nama_barang', 'kategori', 'satuan', 'jumlah', 'tanggal_masuk'
    ];
}