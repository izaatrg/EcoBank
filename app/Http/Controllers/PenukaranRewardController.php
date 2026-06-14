<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenukaranRewardController extends Controller
{
    public function index()
    {
        // Data dummy untuk keperluan tampilan
        $rewards = [
            ['nama' => 'Beras Premium 5kg', 'koin' => 2500, 'stok' => 12, 'label' => 'TERLARIS'],
            ['nama' => 'Paket Alat Tulis Eco', 'koin' => 850, 'stok' => 45, 'label' => null],
            ['nama' => 'Botol Minum Tumbler', 'koin' => 1200, 'stok' => 3, 'label' => 'STOK TERBATAS'],
            ['nama' => 'Susu Segar 1L', 'koin' => 450, 'stok' => 24, 'label' => null],
            ['nama' => 'Tas Belanja Kain', 'koin' => 300, 'stok' => 150, 'label' => null],
            ['nama' => 'Voucher Listrik Rp50rb', 'koin' => 5200, 'stok' => 99, 'label' => null],
            ['nama' => 'Bibit Tanaman Hias', 'koin' => 150, 'stok' => 80, 'label' => null],
            ['nama' => 'Paket Sayur Organik', 'koin' => 600, 'stok' => 8, 'label' => null],
        ];

        return view('admin.penukaran.index', compact('rewards'));
    }
}