<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reward;
use App\Models\TransaksiSetoran;
use App\Models\Penjemputan;
use App\Models\PenukaranReward;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'total_warga' => User::where('role', 'warga')->count(),
            'total_petugas' => User::where('role', 'petugas')->count(),
            'total_reward' => Reward::count(),
            'total_transaksi' => TransaksiSetoran::count(),
            'total_penjemputan' => Penjemputan::count(),
            'total_penukaran' => PenukaranReward::count(),
        ]);
    }
}
