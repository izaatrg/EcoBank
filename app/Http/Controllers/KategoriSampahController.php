<?php

namespace App\Http\Controllers;

use App\Models\KategoriSampah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; 

class KategoriSampahController extends Controller
{
    public function index()
    {
        $kategoris = KategoriSampah::all();

        // Data statistik yang ditambahkan
        $totalJenis     = $kategoris->count();
        $stokTerbanyak  = $kategoris->max('stok');
        $rataRataHarga  = $kategoris->avg('harga');
        $updateTerakhir = $kategoris->sortByDesc('updated_at')->first();

        return view('admin.kategori.index', compact(
            'kategoris', 
            'totalJenis', 
            'stokTerbanyak', 
            'rataRataHarga', 
            'updateTerakhir'
        ));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'koin_per_kg'   => 'required|numeric',
            'stok'          => 'nullable|numeric',
            'kondisi'       => 'nullable|string'
        ]);

        KategoriSampah::create([
            'nama'    => $request->nama_kategori,
            'harga'   => $request->koin_per_kg,
            'stok'    => $request->stok ?? 0,
            'kondisi' => $request->kondisi ?? '-'
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kategori = KategoriSampah::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'koin_per_kg'   => 'required|numeric',
            'stok'          => 'nullable|numeric',
            'kondisi'       => 'nullable|string'
        ]);

        $kategori = KategoriSampah::findOrFail($id);
        $kategori->update([
            'nama'    => $request->nama_kategori,
            'harga'   => $request->koin_per_kg,
            'stok'    => $request->stok ?? 0,
            'kondisi' => $request->kondisi ?? '-'
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        KategoriSampah::findOrFail($id)->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }

    // FUNGSI TAMBAHAN EKSPOR
    public function exportCsv()
    {
        $fileName = 'laporan_kategori_' . date('Y-m-d') . '.csv';
        $kategoris = KategoriSampah::all();

        $callback = function() use ($kategoris) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ["Kategori", "Harga", "Stok (Kg)", "Kondisi"]);
            foreach ($kategoris as $k) {
                fputcsv($file, [$k->nama, $k->harga, $k->stok, $k->kondisi]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ]);
    }

    public function exportPdf()
    {
        $kategoris = KategoriSampah::all();
        $pdf = Pdf::loadView('admin.kategori.pdf', compact('kategoris'));
        return $pdf->download('laporan_kategori_' . date('Y-m-d') . '.pdf');
    }
}