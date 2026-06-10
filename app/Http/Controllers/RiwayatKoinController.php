<?php

namespace App\Http\Controllers;

use App\Models\TransaksiSetoran;
use App\Models\PenukaranReward;
use App\Models\User;
use Illuminate\Http\Request;

class RiwayatKoinController extends Controller
{
    // Admin: lihat riwayat koin gabungan untuk semua warga (ringkasan)
    public function index()
    {
        $wargas = User::where('role', 'warga')->get();

        return view('admin.riwayat.index', compact('wargas'));
    }

    // Admin: lihat riwayat koin detail untuk satu warga
    public function show(int $wargaId)
    {
        $setoran = TransaksiSetoran::where('warga_id', $wargaId)
            ->selectRaw("id, 'setoran' as type, tanggal_setor as tanggal, total_koin as jumlah, berat")
            ->orderBy('tanggal_setor', 'desc');

        $penukaran = PenukaranReward::where('warga_id', $wargaId)
            ->selectRaw("id, 'penukaran' as type, created_at as tanggal, jumlah_koin as jumlah")
            ->orderBy('created_at', 'desc');

        // union all and order by tanggal desc
        $combined = $setoran->unionAll($penukaran)->get()->sortByDesc('tanggal')->values();

        return view('admin.riwayat.show', [
            'riwayat' => $combined,
            'warga' => User::findOrFail($wargaId),
        ]);
    }
}
