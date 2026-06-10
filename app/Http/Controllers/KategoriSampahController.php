<?php

namespace App\Http\Controllers;

use App\Models\KategoriSampah;
use Illuminate\Http\Request;

class KategoriSampahController extends Controller
{
    public function index()
    {
        $kategori = KategoriSampah::all();

        return view(
            'admin.kategori.index',
            compact('kategori')
        );
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
        ]);

        KategoriSampah::create([
            'nama_kategori' => $request->nama_kategori,
            'koin_per_kg' => $request->koin_per_kg
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(int $id)
    {
        $kategori = KategoriSampah::findOrFail($id);

        return view(
            'admin.kategori.edit',
            compact('kategori')
        );
    }

    public function update(Request $request,int $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'koin_per_kg' => 'required|integer|min:1',
        ]);

        $kategori = KategoriSampah::findOrFail($id);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'koin_per_kg' => $request->koin_per_kg
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(int $id)
    {
        $kategori = KategoriSampah::findOrFail($id);

        $kategori->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Data berhasil dihapus');
    }
}