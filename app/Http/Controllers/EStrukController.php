<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; 

class EStrukController extends Controller
{
    public function index(Request $request)
    {
        $struks = collect($this->dummyStruks());
        if ($q = $request->get('q')) {
            $struks = $struks->filter(fn ($s) => str_contains(strtolower($s['nomor']), strtolower($q))
                || str_contains(strtolower($s['nasabah']), strtolower($q)));
        }
        return view('admin.estruck.index', compact('struks'));
    }

    public function show(string $nomor)
    {
        $struk = collect($this->dummyStruks())->firstWhere('nomor', $nomor)
            ?? $this->dummyStruks()[0];
        return view('admin.estruck.show', compact('struk'));
    }

    // Fungsi untuk PDF
    public function generatePdf($nomor)
    {
        $struk = collect($this->dummyStruks())->firstWhere('nomor', $nomor);
        if (!$struk) return abort(404);

        $pdf = Pdf::loadView('admin.estruck.pdf_view', compact('struk'));
        return $pdf->download('Struk_' . $struk['nomor'] . '.pdf');
    }

    // Fungsi untuk Batalkan
    public function cancel($nomor)
    {
        // Logika penghapusan database bisa ditaruh di sini nanti
        return redirect()->route('admin.estruck.index')
            ->with('success', 'Transaksi ' . $nomor . ' berhasil dibatalkan.');
    }

    private function dummyStruks(): array
    {
        return [
            [
                'nomor' => 'EB-20231024-089',
                'tanggal' => '24 Okt 2023, 14:22 WIB',
                'nasabah' => 'BUDI SANTOSO',
                'id_nasabah' => 'ID-992811',
                'items' => [
                    ['jenis' => 'Botol PET (Plastik)', 'berat' => '4.5 kg', 'harga' => '2,000', 'total' => '9,000'],
                    ['jenis' => 'Kardus Bekas', 'berat' => '12.0 kg', 'harga' => '1,500', 'total' => '18,000'],
                    ['jenis' => 'Kaleng Alumunium', 'berat' => '1.2 kg', 'harga' => '12,000', 'total' => '14,400'],
                ],
                'total_setoran' => '41,400',
                'total_koin' => '156,200',
                'emisi' => '8.2 kg',
                'air' => '124 Liter',
            ],
        ];
    }
}