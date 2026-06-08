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
        Reward::create([
            'nama_reward' => $request->nama_reward,
            'jumlah_koin' => $request->jumlah_koin,
            'stok' => $request->stok,
            'gambar' => $request->gambar
        ]);

        return redirect()->route('reward.index');
    }

    public function edit($id)
    {
        $reward = Reward::findOrFail($id);

        return view('admin.reward.edit', compact('reward'));
    }

    public function update(Request $request, $id)
    {
        $reward = Reward::findOrFail($id);

        $reward->update([
            'nama_reward' => $request->nama_reward,
            'jumlah_koin' => $request->jumlah_koin,
            'stok' => $request->stok,
            'gambar' => $request->gambar
        ]);

        return redirect()->route('reward.index');
    }

    public function destroy($id)
    {
        Reward::destroy($id);

        return redirect()->route('reward.index');
    }
}
