<?php

namespace App\Http\Controllers;

use App\Models\TransaksiSetoran;
use App\Models\User;
use App\Models\KategoriSampah;
use Illuminate\Http\Request;

class TransaksiSetoranController extends Controller
{
    public function create()
    {
        $wargas = User::where('role', 'warga')->get();
        $kategoris = KategoriSampah::all();
        
        // PASTI KAN INI SESUAI LOKASI FILE: resources/views/admin/transaksi/create.blade.php
        return view('admin.transaksi.create', compact('wargas', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required',
            'kategori_id' => 'required',
            'berat' => 'required|numeric',
        ]);

        TransaksiSetoran::create([
            'warga_id' => $request->warga_id,
            'kategori_id' => $request->kategori_id,
            'berat' => $request->berat,
            'tanggal' => now(),
            'status' => 'Pending',
        ]);

        return redirect()->route('admin.transaksi.index')->with('success', 'Berhasil!');
    }
}