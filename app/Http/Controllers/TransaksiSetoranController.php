<?php

namespace App\Http\Controllers;

use App\Models\KategoriSampah;
use App\Models\SaldoKoin;
use App\Models\TransaksiSetoran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiSetoranController extends Controller
{
    /**
     * ==========================================
     * ADMIN METHODS
     * ==========================================
     */

    // Admin: List all transaksi
    public function index()
    {
        $transaksi = TransaksiSetoran::with(['warga', 'petugas', 'kategori'])
            ->latest()
            ->paginate(10);

        return view('admin.transaksi.index', compact('transaksi'));
    }

    // Admin: Create form
    public function create()
    {
        $kategori = KategoriSampah::all();
        $warga = User::where('role', 'warga')->get();

        return view('admin.transaksi.create', compact('kategori', 'warga'));
    }

    // Admin: Store transaksi
    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:users,id',
            'kategori_id' => 'required|exists:kategori_sampah,id',
            'berat' => 'required|numeric|min:0.01',
        ]);

        $kategori = KategoriSampah::findOrFail($request->kategori_id);
        $totalKoin = (int) round($request->berat * $kategori->koin_per_kg);

        DB::transaction(function () use ($request, $totalKoin) {
            TransaksiSetoran::create([
                'warga_id' => $request->warga_id,
                'petugas_id' => auth()->id(),
                'kategori_id' => $request->kategori_id,
                'berat' => $request->berat,
                'total_koin' => $totalKoin,
                'tanggal_setor' => now()->toDateString(),
            ]);

            $saldo = SaldoKoin::firstOrCreate(
                ['warga_id' => $request->warga_id],
                ['total_koin' => 0]
            );

            $saldo->increment('total_koin', $totalKoin);
        });

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan. Koin +' . $totalKoin);
    }

    // Admin: Edit form
    public function edit(int $id)
    {
        $transaksi = TransaksiSetoran::findOrFail($id);
        $kategori = KategoriSampah::all();
        $warga = User::where('role', 'warga')->get();

        return view('admin.transaksi.edit', compact('transaksi', 'kategori', 'warga'));
    }

    // Admin: Update transaksi
    public function update(Request $request, int $id)
    {
        $transaksi = TransaksiSetoran::findOrFail($id);
        $oldWargaId = $transaksi->warga_id;
        $oldTotalKoin = $transaksi->total_koin;

        $request->validate([
            'kategori_id' => 'required|exists:kategori_sampah,id',
            'berat' => 'required|numeric|min:0.01',
            'warga_id' => 'required|exists:users,id',
        ]);

        $kategori = KategoriSampah::findOrFail($request->kategori_id);
        $totalKoin = (int) round($request->berat * $kategori->koin_per_kg);

        DB::transaction(function () use ($transaksi, $request, $totalKoin, $oldWargaId, $oldTotalKoin) {
            $transaksi->update([
                'kategori_id' => $request->kategori_id,
                'berat' => $request->berat,
                'total_koin' => $totalKoin,
                'warga_id' => $request->warga_id,
            ]);

            // If warga changed, recalculate both saldos
            if ($oldWargaId !== $request->warga_id) {
                $oldSaldo = SaldoKoin::firstOrCreate(['warga_id' => $oldWargaId], ['total_koin' => 0]);
                $oldSaldo->total_koin = TransaksiSetoran::where('warga_id', $oldWargaId)->sum('total_koin');
                $oldSaldo->save();
            }

            $saldo = SaldoKoin::firstOrCreate(['warga_id' => $request->warga_id], ['total_koin' => 0]);
            $saldo->total_koin = TransaksiSetoran::where('warga_id', $request->warga_id)->sum('total_koin');
            $saldo->save();
        });

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil diupdate');
    }

    // Admin: Delete transaksi
    public function destroy(int $id)
    {
        $transaksi = TransaksiSetoran::findOrFail($id);
        $wargaId = $transaksi->warga_id;
        $transaksi->delete();

        // Recalculate saldo
        $totalFromTransaksi = TransaksiSetoran::where('warga_id', $wargaId)->sum('total_koin');
        $saldo = SaldoKoin::firstOrCreate(['warga_id' => $wargaId], ['total_koin' => 0]);
        $saldo->total_koin = $totalFromTransaksi;
        $saldo->save();

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }

    /**
     * ==========================================
     * PETUGAS METHODS
     * ==========================================
     */

    // Petugas: List setoran
    public function indexPetugas()
    {
        $transaksi = TransaksiSetoran::with(['warga', 'kategori'])
            ->latest()
            ->paginate(10);

        return view('petugas.setoran.index', compact('transaksi'));
    }

    // Petugas: Create form
    public function createPetugas()
    {
        $kategori = KategoriSampah::all();
        $warga = User::where('role', 'warga')->get();

        return view('petugas.setoran.create', compact('kategori', 'warga'));
    }

    // Petugas: Store setoran
    public function storePetugas(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:users,id',
            'kategori_id' => 'required|exists:kategori_sampah,id',
            'berat' => 'required|numeric|min:0.01',
        ]);

        $kategori = KategoriSampah::findOrFail($request->kategori_id);
        $totalKoin = (int) round($request->berat * $kategori->koin_per_kg);

        DB::transaction(function () use ($request, $totalKoin) {
            TransaksiSetoran::create([
                'warga_id' => $request->warga_id,
                'petugas_id' => auth()->id(),
                'kategori_id' => $request->kategori_id,
                'berat' => $request->berat,
                'total_koin' => $totalKoin,
                'tanggal_setor' => now()->toDateString(),
            ]);

            $saldo = SaldoKoin::firstOrCreate(
                ['warga_id' => $request->warga_id],
                ['total_koin' => 0]
            );

            $saldo->increment('total_koin', $totalKoin);
        });

        return redirect()->route('petugas.setoran.index')->with('success', 'Setoran berhasil dicatat! Koin +' . $totalKoin);
    }

    // Petugas: Edit form
    public function editPetugas(int $id)
    {
        $transaksi = TransaksiSetoran::findOrFail($id);
        $kategori = KategoriSampah::all();
        $warga = User::where('role', 'warga')->get();

        return view('petugas.setoran.edit', compact('transaksi', 'kategori', 'warga'));
    }

    // Petugas: Update setoran
    public function updatePetugas(Request $request, int $id)
    {
        $transaksi = TransaksiSetoran::findOrFail($id);
        $oldWargaId = $transaksi->warga_id;

        $request->validate([
            'kategori_id' => 'required|exists:kategori_sampah,id',
            'berat' => 'required|numeric|min:0.01',
            'warga_id' => 'required|exists:users,id',
        ]);

        $kategori = KategoriSampah::findOrFail($request->kategori_id);
        $totalKoin = (int) round($request->berat * $kategori->koin_per_kg);

        DB::transaction(function () use ($transaksi, $request, $totalKoin, $oldWargaId) {
            $transaksi->update([
                'kategori_id' => $request->kategori_id,
                'berat' => $request->berat,
                'total_koin' => $totalKoin,
                'warga_id' => $request->warga_id,
            ]);

            if ($oldWargaId !== $request->warga_id) {
                $oldSaldo = SaldoKoin::firstOrCreate(['warga_id' => $oldWargaId], ['total_koin' => 0]);
                $oldSaldo->total_koin = TransaksiSetoran::where('warga_id', $oldWargaId)->sum('total_koin');
                $oldSaldo->save();
            }

            $saldo = SaldoKoin::firstOrCreate(['warga_id' => $request->warga_id], ['total_koin' => 0]);
            $saldo->total_koin = TransaksiSetoran::where('warga_id', $request->warga_id)->sum('total_koin');
            $saldo->save();
        });

        return redirect()->route('petugas.setoran.index')->with('success', 'Setoran berhasil diupdate');
    }

    // Petugas: Delete setoran
    public function destroyPetugas(int $id)
    {
        $transaksi = TransaksiSetoran::findOrFail($id);
        $wargaId = $transaksi->warga_id;
        $transaksi->delete();

        $totalFromTransaksi = TransaksiSetoran::where('warga_id', $wargaId)->sum('total_koin');
        $saldo = SaldoKoin::firstOrCreate(['warga_id' => $wargaId], ['total_koin' => 0]);
        $saldo->total_koin = $totalFromTransaksi;
        $saldo->save();

        return redirect()->route('petugas.setoran.index')->with('success', 'Setoran berhasil dihapus');
    }

    // Petugas: View riwayat
    public function showRiwayatPetugas()
    {
        $transaksi = TransaksiSetoran::where('petugas_id', auth()->id())
            ->with(['warga', 'kategori'])
            ->latest()
            ->paginate(10);

        return view('petugas.riwayat', compact('transaksi'));
    }

    /**
     * ==========================================
     * WARGA METHODS
     * ==========================================
     */

    // Warga: Show form to deposit sampah
    public function showFormWarga()
    {
        $kategori = KategoriSampah::all();

        return view('warga.setor.form', compact('kategori'));
    }

    // Warga: Store sampah deposit
    public function storeWarga(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_sampah,id',
            'berat' => 'required|numeric|min:0.01',
        ]);

        $kategori = KategoriSampah::findOrFail($request->kategori_id);
        $totalKoin = (int) round($request->berat * $kategori->koin_per_kg);

        DB::transaction(function () use ($request, $totalKoin) {
            TransaksiSetoran::create([
                'warga_id' => auth()->id(),
                'kategori_id' => $request->kategori_id,
                'berat' => $request->berat,
                'total_koin' => $totalKoin,
                'tanggal_setor' => now()->toDateString(),
            ]);

            $saldo = SaldoKoin::firstOrCreate(
                ['warga_id' => auth()->id()],
                ['total_koin' => 0]
            );

            $saldo->increment('total_koin', $totalKoin);
        });

        return redirect()->route('warga.riwayat')->with('success', 'Setoran berhasil! Koin +' . $totalKoin);
    }

    // Warga: View riwayat
    public function showRiwayatWarga()
    {
        $transaksi = TransaksiSetoran::where('warga_id', auth()->id())
            ->with(['kategori'])
            ->latest()
            ->paginate(10);

        return view('warga.riwayat', compact('transaksi'));
    }
}
