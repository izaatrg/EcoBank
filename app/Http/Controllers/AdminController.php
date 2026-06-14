<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reward;
use App\Models\TransaksiSetoran;
use App\Models\Penjemputan;
use App\Models\PenukaranReward;
use App\Models\BarangMasuk;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Calculate real statistics
        $totalSampah = TransaksiSetoran::sum('berat');
        $totalWarga = User::where('role', 'warga')->count();
        $totalKoin = TransaksiSetoran::sum('total_koin');
        $totalBarang = BarangMasuk::sum('jumlah');

        // Get recent transactions
        $recentTransaksi = TransaksiSetoran::with(['warga', 'kategori'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'total_sampah' => $totalSampah,
            'total_warga' => $totalWarga,
            'total_koin' => $totalKoin,
            'total_barang' => $totalBarang,
            'recent_transaksi' => $recentTransaksi,
        ]);
    }
}
