<?php

namespace App\Http\Controllers;

use App\Models\SaldoKoin;
use App\Models\TransaksiSetoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaldoKoinController extends Controller
{
    // Admin: list semua saldo koin
    public function index()
    {
        $saldo = SaldoKoin::with('warga')->latest()->get();

        return view('admin.saldo.index', compact('saldo'));
    }

    // Admin: lihat detail saldo untuk satu warga
    public function show(int $wargaId)
    {
        $saldo = SaldoKoin::with('warga')->where('warga_id', $wargaId)->firstOrFail();

        // optional: hitung ulang dari transaksi untuk keakuratan
        $calculated = TransaksiSetoran::where('warga_id', $wargaId)->sum('total_koin');

        return view('admin.saldo.show', [
            'saldo' => $saldo,
            'calculated_total' => $calculated,
        ]);
    }

    // Admin: rekalkulasi saldo berdasarkan transaksi
    public function recalculate(int $wargaId)
    {
        DB::transaction(function () use ($wargaId) {
            $total = TransaksiSetoran::where('warga_id', $wargaId)->sum('total_koin');

            $saldo = SaldoKoin::firstOrCreate(['warga_id' => $wargaId], ['total_koin' => 0]);
            $saldo->total_koin = $total;
            $saldo->save();
        });

        return redirect()->back()->with('success', 'Saldo berhasil direkalkulasi');
    }
}
