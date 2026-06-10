<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        $reward = Reward::all();

        return view('admin.reward.index', compact('reward'));
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

        Reward::create([
            'nama_reward' => $request->nama_reward,
            'jumlah_koin' => $request->jumlah_koin,
            'stok' => $request->stok,
            'gambar' => $request->gambar
        ]);

        return redirect()->route('reward.index');
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

        $reward = Reward::findOrFail($id);

        $reward->update([
            'nama_reward' => $request->nama_reward,
            'jumlah_koin' => $request->jumlah_koin,
            'stok' => $request->stok,
            'gambar' => $request->gambar
        ]);

        return redirect()->route('reward.index');
    }

    public function destroy(int $id)
    {
        Reward::destroy($id);

        return redirect()->route('reward.index');
    }
}
