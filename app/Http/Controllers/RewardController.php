<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::all();

        if ($rewards->isEmpty()) {
            $rewards = collect($this->dummyRewards());
        }

        return view('admin.reward.index', [
            'rewards' => $rewards,
            'totalKoin' => 12850,
            'isDummy' => Reward::count() === 0,
        ]);
    }

    public function create()
    {
        return view('admin.reward.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_reward' => 'required|string|max:255',
            'jumlah_koin' => 'required|integer|min:1',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|string|max:255',
        ]);

        Reward::create($request->only('nama_reward', 'jumlah_koin', 'stok', 'gambar'));

        return redirect()->route('admin.reward.index')->with('success', 'Reward berhasil ditambahkan');
    }

    public function edit(int $id)
    {
        $reward = Reward::findOrFail($id);

        return view('admin.reward.edit', compact('reward'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama_reward' => 'required|string|max:255',
            'jumlah_koin' => 'required|integer|min:1',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|string|max:255',
        ]);

        Reward::findOrFail($id)->update($request->only('nama_reward', 'jumlah_koin', 'stok', 'gambar'));

        return redirect()->route('admin.reward.index')->with('success', 'Reward berhasil diupdate');
    }

    public function destroy(int $id)
    {
        Reward::findOrFail($id)->delete();

        return redirect()->route('admin.reward.index')->with('success', 'Reward berhasil dihapus');
    }

    private function dummyRewards(): array
    {
        return [
            (object) ['id' => 1, 'nama_reward' => 'Beras Premium 5kg', 'jumlah_koin' => 2500, 'stok' => 12, 'badge' => 'TERLARIS', 'kategori' => 'Kebutuhan Pokok'],
            (object) ['id' => 2, 'nama_reward' => 'Paket Alat Tulis Eco', 'jumlah_koin' => 800, 'stok' => 25, 'badge' => null, 'kategori' => 'Alat Tulis'],
            (object) ['id' => 3, 'nama_reward' => 'Botol Minum Tumbler', 'jumlah_koin' => 1200, 'stok' => 3, 'badge' => 'STOK TERBATAS', 'kategori' => 'Elektronik'],
            (object) ['id' => 4, 'nama_reward' => 'Susu Segar 1L', 'jumlah_koin' => 900, 'stok' => 18, 'badge' => null, 'kategori' => 'Kebutuhan Pokok'],
            (object) ['id' => 5, 'nama_reward' => 'Tas Belanja Kain', 'jumlah_koin' => 600, 'stok' => 30, 'badge' => null, 'kategori' => 'Kebutuhan Pokok'],
            (object) ['id' => 6, 'nama_reward' => 'Voucher Listrik Rp50rb', 'jumlah_koin' => 5000, 'stok' => 8, 'badge' => 'TERLARIS', 'kategori' => 'Voucher'],
            (object) ['id' => 7, 'nama_reward' => 'Bibit Tanaman Hias', 'jumlah_koin' => 450, 'stok' => 20, 'badge' => null, 'kategori' => 'Kebutuhan Pokok'],
            (object) ['id' => 8, 'nama_reward' => 'Paket Sayur Organik', 'jumlah_koin' => 1100, 'stok' => 15, 'badge' => null, 'kategori' => 'Kebutuhan Pokok'],
        ];
    }
}
