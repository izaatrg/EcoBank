<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $data = BarangKeluar::latest()->get();
        return view('admin.barang_keluar.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'tujuan' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal_keluar' => 'required'
        ]);

        BarangKeluar::create($request->all());
        return redirect()->route('admin.barang_keluar.index')->with('success', 'Data berhasil disimpan!');
    }
}