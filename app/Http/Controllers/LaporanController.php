<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index', [
            'targetPersen' => 82,
            'totalTabungan' => 'Rp 12.450.000',
            'kategoriLaporan' => $this->dummyKategori(),
            'stats' => [
                ['label' => 'Karbon Terselamatkan', 'value' => '1.280 Kg CO2', 'icon' => 'fa-tree'],
                ['label' => 'Nasabah Baru', 'value' => '48 Orang', 'icon' => 'fa-users'],
                ['label' => 'Mitra Industri', 'value' => '12 Pabrik', 'icon' => 'fa-industry'],
            ],
        ]);
    }

    private function dummyKategori(): array
    {
        return [
            ['nama' => 'Plastik (PET)', 'masuk' => '1.240 kg', 'keluar' => '980 kg', 'stok' => '260 kg', 'status' => 'STABIL', 'color' => 'emerald'],
            ['nama' => 'Kertas & Karton', 'masuk' => '890 kg', 'keluar' => '820 kg', 'stok' => '70 kg', 'status' => 'CEPAT TERJUAL', 'color' => 'amber'],
            ['nama' => 'Logam / Besi', 'masuk' => '540 kg', 'keluar' => '410 kg', 'stok' => '130 kg', 'status' => 'STABIL', 'color' => 'emerald'],
            ['nama' => 'Organik (Kompos)', 'masuk' => '320 kg', 'keluar' => '290 kg', 'stok' => '30 kg', 'status' => 'STOK MENIPIS', 'color' => 'red'],
        ];
    }
}
