<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangKeluar::query()->latest();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('tujuan', 'like', "%{$search}%");
            });
        }

        $data = $query->paginate(8)->withQueryString();

        $totalHariIni = BarangKeluar::whereDate('tanggal_keluar', today())->sum('jumlah');
        $itemTerbanyak = BarangKeluar::selectRaw('nama_barang, SUM(jumlah) as total')
            ->groupBy('nama_barang')
            ->orderByDesc('total')
            ->value('nama_barang') ?? '-';

        return view('admin.barang_keluar.index', compact('data', 'totalHariIni', 'itemTerbanyak'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0.01',
            'tanggal_keluar' => 'required|date',
        ]);

        BarangKeluar::create($validated);

        return redirect()
            ->route('admin.barang_keluar.index')
            ->with('success', 'Data barang keluar berhasil disimpan!');
    }

    public function export()
    {
        $data = BarangKeluar::orderBy('tanggal_keluar', 'desc')->get();
        $fileName = 'barang_keluar_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, ['Nama Barang', 'Penerima', 'Jumlah', 'Tanggal']);

            foreach ($data as $item) {
                fputcsv($file, [
                    $item->nama_barang,
                    $item->tujuan,
                    $item->jumlah,
                    $item->tanggal_keluar,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
