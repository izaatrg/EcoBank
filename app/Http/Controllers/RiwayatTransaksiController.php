<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatTransaksiController extends Controller
{
    public function index(Request $request)
    {
        $transaksi = collect($this->dummyTransaksi());

        if ($q = $request->get('q')) {
            $transaksi = $transaksi->filter(fn ($t) => str_contains(strtolower($t['id']), strtolower($q))
                || str_contains(strtolower($t['nasabah']), strtolower($q)));
        }

        if ($jenis = $request->get('jenis')) {
            $transaksi = $transaksi->where('jenis', $jenis);
        }

        if ($status = $request->get('status')) {
            $transaksi = $transaksi->where('status', $status);
        }

        return view('admin.riwayat_transaksi.index', [
            'transaksi' => $transaksi->values(),
            'stats' => [
                ['label' => 'Total Koin', 'value' => '12.450.000', 'icon' => 'fa-coins', 'color' => 'emerald'],
                ['label' => 'Sampah Terolah', 'value' => '452 kg', 'icon' => 'fa-leaf', 'color' => 'emerald'],
                ['label' => 'Penukaran', 'value' => '2.100.000', 'icon' => 'fa-arrow-trend-up', 'color' => 'red'],
                ['label' => 'Nasabah Aktif', 'value' => '128', 'icon' => 'fa-users', 'color' => 'blue'],
            ],
        ]);
    }

    private function dummyTransaksi(): array
    {
        return [
            ['id' => '#TRX-88291', 'tanggal' => '12 Okt 2023, 14:20', 'jenis' => 'Setoran', 'nasabah' => 'Ahmad Hidayat', 'inisial' => 'AH', 'nilai' => '+45.000', 'status' => 'Berhasil'],
            ['id' => '#TRX-88290', 'tanggal' => '12 Okt 2023, 11:05', 'jenis' => 'Penukaran', 'nasabah' => 'Siti Nurhaliza', 'inisial' => 'SN', 'nilai' => '-150.000', 'status' => 'Berhasil'],
            ['id' => '#TRX-88289', 'tanggal' => '11 Okt 2023, 16:40', 'jenis' => 'Setoran', 'nasabah' => 'Budi Santoso', 'inisial' => 'BS', 'nilai' => '+28.500', 'status' => 'Proses'],
            ['id' => '#TRX-88288', 'tanggal' => '11 Okt 2023, 09:15', 'jenis' => 'Penukaran', 'nasabah' => 'Dewi Lestari', 'inisial' => 'DL', 'nilai' => '-75.000', 'status' => 'Batal'],
        ];
    }
}
