<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    /**
     * Menampilkan daftar reward dengan paginasi
     */
    public function index()
    {
        // Menggunakan paginate(8) agar tombol halaman (1, 2, 3, dst) berfungsi
        $rewards = Reward::paginate(8); 
        
        // Mengambil saldo user yang sedang login
        $saldo = Auth::check() ? Auth::user()->saldo : 0;
        
        return view('admin.reward.index', compact('rewards', 'saldo'));
    }

    /**
     * Menyimpan data reward baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_reward' => 'required|string|max:255',
            'kategori'    => 'required|string|max:100',
            'jumlah_koin' => 'required|integer',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('rewards', 'public');
        }

        Reward::create($data);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Mengupdate data reward
     */
    public function update(Request $request, $id)
    {
        $reward = Reward::findOrFail($id);

        $request->validate([
            'nama_reward' => 'required|string|max:255',
            'kategori'    => 'required|string|max:100',
            'jumlah_koin' => 'required|integer',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($reward->gambar) {
                Storage::disk('public')->delete($reward->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('rewards', 'public');
        }

        $reward->update($data);

        return redirect()->back()->with('success', 'Barang berhasil diupdate!');
    }

    /**
     * Menghapus data reward
     */
    public function destroy($id)
    {
        $reward = Reward::findOrFail($id);

        if ($reward->gambar) {
            Storage::disk('public')->delete($reward->gambar);
        }

        $reward->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus!');
    }
}