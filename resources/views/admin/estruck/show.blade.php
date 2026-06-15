@extends('layouts.admin')

@section('page_title', 'Detail E-Struk')
@section('search_placeholder', 'Cari nomor struk...')

@section('content')
<div class="grid grid-cols-1 xl:grid-cols-12 gap-6 animate-fade-in">
    <div class="xl:col-span-7">
        <div id="cetak-struk" class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden receipt-paper">
            <div class="bg-[#1E5631] text-white text-center py-6 px-4">
                <div class="w-12 h-12 bg-white/20 rounded-xl mx-auto flex items-center justify-center mb-2"><i class="fa-solid fa-recycle"></i></div>
                <h2 class="font-black text-lg">EcoBank Manager</h2>
                <p class="text-[10px] text-emerald-100 mt-1">Layanan Bank Sampah Masyarakat Mandiri</p>
            </div>
            <div class="p-6 space-y-4 text-xs">
                <div class="grid grid-cols-2 gap-3 border-b border-dashed border-slate-200 pb-4">
                    <div><p class="text-[10px] font-bold text-slate-400 uppercase">Nomor Struk</p><p class="font-black text-slate-800 mt-1">#{{ $struk['nomor'] }}</p></div>
                    <div><p class="text-[10px] font-bold text-slate-400 uppercase">Tanggal</p><p class="font-bold text-slate-800 mt-1">{{ $struk['tanggal'] }}</p></div>
                    <div><p class="text-[10px] font-bold text-slate-400 uppercase">Nama Nasabah</p><p class="font-bold text-slate-800 mt-1">{{ $struk['nasabah'] }}</p></div>
                    <div><p class="text-[10px] font-bold text-slate-400 uppercase">ID Nasabah</p><p class="font-bold text-slate-800 mt-1">{{ $struk['id_nasabah'] }}</p></div>
                </div>
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-bold text-slate-400 uppercase border-b border-slate-100">
                            <th class="py-2">Jenis Sampah</th><th class="py-2">Berat</th><th class="py-2">Harga/Kg</th><th class="py-2 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($struk['items'] as $item)
                        <tr>
                            <td class="py-2 font-medium">{{ $item['jenis'] }}</td>
                            <td class="py-2">{{ $item['berat'] }}</td>
                            <td class="py-2">{{ $item['harga'] }}</td>
                            <td class="py-2 text-right font-bold">{{ $item['total'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="bg-[#1E5631] text-white rounded-xl p-4 flex justify-between items-center">
                    <div>
                        <p class="text-[10px] text-emerald-200 uppercase font-bold">Total Setoran</p>
                        <p class="text-xl font-black">{{ $struk['total_setoran'] }} Koin</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] text-emerald-200 uppercase font-bold">Total Koin Terkumpul</p>
                        <p class="text-lg font-black">{{ $struk['total_koin'] }} Koin</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 pt-2 border-t border-dashed border-slate-200">
                    <div class="w-16 h-16 bg-slate-100 rounded-lg flex items-center justify-center">
                        {!! QrCode::size(64)->generate(route('admin.estruck.show', $struk['nomor'])) !!}
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-500 uppercase">Pindai untuk verifikasi keaslian</p>
                        <p class="text-xs italic text-slate-400 mt-2">"Sampahmu adalah tabungan masa depanmu."</p>
                        <p class="text-xs font-bold text-emerald-800 mt-2">Terima Kasih Atas Kontribusi Anda!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="xl:col-span-5 space-y-4">
        <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-xs">
            <h3 class="text-sm font-bold text-slate-800 mb-4">Tindakan</h3>
            <div class="space-y-3">
                <button type="button" onclick="window.print()" class="admin-btn-primary w-full bg-emerald-700 hover:bg-emerald-800 text-white py-3 rounded-xl font-bold text-xs transition-colors">
                    <i class="fa-solid fa-print"></i> Cetak Struk
                </button>

                <a href="{{ route('admin.estruck.pdf', $struk['nomor']) }}" class="admin-btn-outline w-full block text-center py-3 border border-emerald-600 text-emerald-600 rounded-xl font-bold text-xs hover:bg-emerald-50 transition-all">
                    <i class="fa-solid fa-share-nodes"></i> Bagikan (PDF)
                </a>

                <form action="{{ route('admin.estruck.cancel', $struk['nomor']) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan transaksi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-3 text-red-500 text-xs font-bold hover:bg-red-50 rounded-xl transition-colors">
                        <i class="fa-solid fa-trash"></i> Batalkan Transaksi
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-[#1E5631] rounded-2xl p-5 text-white shadow-lg">
            <h3 class="font-bold text-sm">Statistik Dampak</h3>
            <p class="text-xs text-emerald-100 mt-1 opacity-90">Transaksi ini membantu mengurangi:</p>
            <div class="mt-4 space-y-3">
                <div>
                    <div class="flex justify-between text-xs mb-1"><span>Emisi Karbon</span><span class="font-bold">{{ $struk['emisi'] }}</span></div>
                    <div class="h-1.5 bg-white/20 rounded-full"><div class="h-full bg-emerald-300 rounded-full w-3/4"></div></div>
                </div>
                <div>
                    <div class="flex justify-between text-xs mb-1"><span>Konsumsi Air</span><span class="font-bold">{{ $struk['air'] }}</span></div>
                    <div class="h-1.5 bg-white/20 rounded-full"><div class="h-full bg-emerald-300 rounded-full w-2/3"></div></div>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.estruck.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-emerald-700 hover:underline"><i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Struk</a>
    </div>
</div>

<style>
    @media print {
        body * { visibility: hidden !important; }
        #cetak-struk, #cetak-struk * { visibility: visible !important; }
        #cetak-struk {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0 !important;
            padding: 0 !important;
        }
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }
</style>
@endsection