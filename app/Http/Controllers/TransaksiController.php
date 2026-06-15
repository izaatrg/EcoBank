<?php

namespace App\Http\Controllers;

use App\Models\TransaksiSetoran;
use App\Models\KategoriSampah;
use App\Models\User;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan form input transaksi
    public function create()
    {
        // Mengambil data warga dan kategori untuk dropdown di form
        $wargas = User::where('role', 'warga')->get();
        $kategoris = KategoriSampah::all();
        
        return view('admin.transaksi.create', compact('wargas', 'kategoris'));
    }

    // Memproses simpan data transaksi
    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:users,id',
            'kategori_id' => 'required|exists:kategori_sampah,id',
            'berat' => 'required|numeric|min:0.1',
        ]);

        // Mengambil harga dari kategori yang dipilih
        $kategori = KategoriSampah::findOrFail($request->kategori_id);
        
        // Kalkulasi otomatis: total_koin = berat * harga
        $totalKoin = $request->berat * $kategori->harga;

        // Menyimpan ke database
        TransaksiSetoran::create([
            'warga_id'    => $request->warga_id,
            'kategori_id' => $request->kategori_id,
            'berat'       => $request->berat,
            'total_koin'  => $totalKoin,
            'status'      => 'proses', // Sesuai dengan kolom status yang baru di-migrate
        ]);

        // Redirect kembali ke daftar warga/transaksi dengan pesan sukses
        return redirect()->route('admin.warga.index')->with('success', 'Transaksi setoran sampah berhasil dicatat!');
    }
}