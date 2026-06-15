<?php

namespace App\Http\Controllers;

use App\Models\TransaksiSetoran;
use App\Models\User;
use App\Models\KategoriSampah;
use Illuminate\Http\Request;

class TransaksiSetoranController extends Controller
{
    public function index()
    {
        $transaksi = TransaksiSetoran::with(['warga', 'kategori'])->latest()->get();
        return view('admin.transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $wargas = User::where('role', 'warga')->get();
        $kategoris = KategoriSampah::all();
        
        return view('admin.transaksi.create', compact('wargas', 'kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id'    => 'required|exists:users,id',
            'kategori_id' => 'required|exists:kategori_sampah,id',
            'berat'       => 'required|numeric',
            'total_koin'  => 'required|numeric',
        ]);

        $validated['petugas_id'] = auth()->id();
        $validated['tanggal_setor'] = now();

        TransaksiSetoran::create($validated);

        return redirect()->route('admin.transaksi.index')
                         ->with('success', 'Transaksi berhasil disimpan!');
    }
}