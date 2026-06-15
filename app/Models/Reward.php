<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $table = 'rewards'; // Pastikan sesuai nama tabel di DB

    protected $fillable = [
        'nama_reward',
        'jumlah_koin',
        'stok',
        'gambar',
        'kategori' 
    ];
}