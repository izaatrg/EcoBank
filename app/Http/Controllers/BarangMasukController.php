<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index() {
        $data = BarangMasuk::latest()->get();
        return view('admin.barang_masuk.index', compact('data'));
    }

    public function store(Request $request) {
        $request->validate(['kode_transaksi' => 'required|unique:barang_masuk', 'nama_barang' => 'required', 'jumlah' => 'required']);
        BarangMasuk::create($request->all());
        return redirect()->back()->with('success', 'Data tersimpan!');
    }

    public function export() {
        $data = BarangMasuk::all();
        $fileName = 'barang_masuk_' . date('Y-m-d') . '.csv';
        $headers = ["Content-type" => "text/csv", "Content-Disposition" => "attachment; filename=$fileName"];
        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID Transaksi', 'Nama Barang', 'Kategori', 'Jumlah', 'Tanggal']);
            foreach ($data as $item) {
                fputcsv($file, [$item->kode_transaksi, $item->nama_barang, $item->kategori, $item->jumlah, $item->tanggal_masuk]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}