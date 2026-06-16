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
        return view('admin.warga.index', compact('transaksis'));
    }

    public function create()
    {
        return view('admin.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'warga',
        ]);

        return redirect()->route('admin.warga.index')->with('success', 'Warga berhasil ditambah');
    }

    public function dashboard()
    {
        $warga = auth()->user();
        
        $saldo = $warga->saldoKoin ? $warga->saldoKoin->total_koin : 0;
        
        $totalSetoran = $warga->transaksiSetoran()->sum('berat');
        
        $recentTransaksis = $warga->transaksiSetoran()
            ->with('kategori')
            ->latest()
            ->limit(5)
            ->get();
            
        return view('warga.dashboard', compact('saldo', 'totalSetoran', 'recentTransaksis'));
    }
}