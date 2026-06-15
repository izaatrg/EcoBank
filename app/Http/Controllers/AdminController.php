<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\KategoriSampah;
use App\Models\TransaksiSetoran;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function create() 
    {
        // Mengambil data warga dan kategori
        $wargas = User::where('role', 'warga')->get();
        $kategoris = KategoriSampah::all();
        
        // Mengirimkan kedua data tersebut ke view
        return view('admin.transaksi.create', compact('wargas', 'kategoris'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'user_id' => 'required',
            'kategori_id' => 'required',
            'berat' => 'required|numeric',
        ]);

        $kategori = KategoriSampah::findOrFail($request->kategori_id);
        
        TransaksiSetoran::create([
            'user_id' => $request->user_id,
            'kategori_id' => $request->kategori_id,
            'berat' => $request->berat,
            'total_koin' => $request->berat * $kategori->harga, 
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Transaksi berhasil disimpan!');
    }
}