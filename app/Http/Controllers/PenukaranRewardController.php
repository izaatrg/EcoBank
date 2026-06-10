<?php

namespace App\Http\Controllers;

use App\Models\PenukaranReward;
use App\Models\Reward;
use App\Models\SaldoKoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenukaranRewardController extends Controller
{
    /**
     * ==========================================
     * ADMIN METHODS
     * ==========================================
     */

    // Admin: list all penukaran
    public function index()
    {
        $penukaran = PenukaranReward::with(['warga', 'reward'])
            ->latest()
            ->paginate(10);

        return view('admin.penukaran.index', compact('penukaran'));
    }

    // Admin: show single penukaran
    public function show(int $id)
    {
        $penukaran = PenukaranReward::with(['warga', 'reward'])->findOrFail($id);

        return view('admin.penukaran.show', compact('penukaran'));
    }

    // Admin: update status (menunggu, disetujui, diambil)
    public function update(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,disetujui,diambil,ditolak',
        ]);

        $penukaran = PenukaranReward::findOrFail($id);

        $penukaran->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.penukaran.index')->with('success', 'Status penukaran berhasil diperbarui');
    }

    /**
     * ==========================================
     * WARGA METHODS
     * ==========================================
     */

    // Warga: Show form to exchange reward
    public function showFormWarga()
    {
        $rewards = Reward::where('stok', '>', 0)->get();
        $saldo = SaldoKoin::where('warga_id', auth()->id())->value('total_koin') ?? 0;

        return view('warga.tukar.form', compact('rewards', 'saldo'));
    }

    // Warga: Store reward exchange
    public function storeWarga(Request $request)
    {
        $request->validate([
            'reward_id' => 'required|exists:reward,id',
        ]);

        $wargaId = auth()->id();
        $reward = Reward::findOrFail($request->reward_id);

        if ($reward->stok <= 0) {
            return back()->with('error', 'Stok reward habis');
        }

        $saldo = SaldoKoin::where('warga_id', $wargaId)->first();

        if (!$saldo || $saldo->total_koin < $reward->jumlah_koin) {
            return back()->with('error', 'Koin tidak cukup untuk menukar reward ini');
        }

        DB::transaction(function () use ($wargaId, $reward, $saldo) {
            $saldo->decrement('total_koin', $reward->jumlah_koin);

            PenukaranReward::create([
                'warga_id' => $wargaId,
                'reward_id' => $reward->id,
                'jumlah_koin' => $reward->jumlah_koin,
                'status' => 'menunggu',
            ]);

            $reward->decrement('stok');
        });

        return redirect()->route('warga.tukar.history')->with('success', 'Reward berhasil ditukar! Tunggu admin untuk mengonfirmasi.');
    }

    // Warga: View exchange history
    public function historyWarga()
    {
        $penukaran = PenukaranReward::where('warga_id', auth()->id())
            ->with('reward')
            ->latest()
            ->paginate(10);

        return view('warga.tukar.history', compact('penukaran'));
    }
}
