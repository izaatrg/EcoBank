<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangMasuk::query()->latest();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_transaksi', 'like', "%{$search}%")
                    ->orWhere('nama_barang', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        $data = $query->get();

        return view('admin.barang_masuk.index', [
            'data' => $data,
            'totalHariIni' => BarangMasuk::whereDate('tanggal_masuk', today())->sum('jumlah'),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_transaksi' => 'required|string|max:50|unique:barang_masuk,kode_transaksi',
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'satuan' => 'required|string|max:20',
            'jumlah' => 'required|numeric|min:0.01',
            'tanggal_masuk' => 'required|date',
        ]);

        BarangMasuk::create($validated);

        return redirect()
            ->route('admin.barang_masuk.index')
            ->with('success', 'Data barang masuk berhasil disimpan!');
    }

    public function export()
    {
        $data = BarangMasuk::orderBy('tanggal_masuk', 'desc')->get();
        $fileName = 'barang_masuk_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, ['ID Transaksi', 'Nama Barang', 'Kategori', 'Satuan', 'Jumlah', 'Tanggal']);

            foreach ($data as $item) {
                fputcsv($file, [
                    $item->kode_transaksi,
                    $item->nama_barang,
                    $item->kategori,
                    $item->satuan,
                    $item->jumlah,
                    $item->tanggal_masuk,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
