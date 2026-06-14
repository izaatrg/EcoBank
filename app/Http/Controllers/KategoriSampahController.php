<?php

namespace App\Http\Controllers;

use App\Models\KategoriSampah;
use Illuminate\Http\Request;

class KategoriSampahController extends Controller
{
    public function index()
    {
        $kategoris = KategoriSampah::latest()->get();

        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'koin_per_kg' => 'required|integer|min:1',
            'stok' => 'nullable|integer|min:0',
            'kondisi' => 'nullable|string|max:100',
        ]);

        KategoriSampah::create([
            'nama' => $request->nama_kategori,
            'harga' => $request->koin_per_kg,
            'stok' => $request->stok ?? 0,
            'kondisi' => $request->kondisi ?? 'Baik',
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(int $id)
    {
        $kategori = KategoriSampah::findOrFail($id);

        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'koin_per_kg' => 'required|integer|min:1',
            'stok' => 'nullable|integer|min:0',
            'kondisi' => 'nullable|string|max:100',
        ]);

        $kategori = KategoriSampah::findOrFail($id);
        $kategori->update([
            'nama' => $request->nama_kategori,
            'harga' => $request->koin_per_kg,
            'stok' => $request->stok ?? 0,
            'kondisi' => $request->kondisi ?? 'Baik',
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(int $id)
    {
        KategoriSampah::findOrFail($id)->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
