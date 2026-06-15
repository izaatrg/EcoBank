<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TransaksiSetoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WargaController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiSetoran::with(['user', 'kategoriSampah'])->latest()->get();
        $nasabahHariIni = TransaksiSetoran::whereDate('created_at', today())->count();
        $totalBerat = TransaksiSetoran::sum('berat');
        $totalKoin = TransaksiSetoran::sum('total_koin');

        return view('admin.warga.index', compact('transaksis', 'nasabahHariIni', 'totalBerat', 'totalKoin'));
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $warga */
        $warga = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $warga->id,
        ]);

        $warga->update($request->only(['name', 'email', 'no_hp', 'alamat']));

        if ($request->filled('password')) {
            $warga->password = Hash::make($request->password);
            $warga->save();
        }

        return back()->with('success', 'Profil berhasil diupdate');
    }
}