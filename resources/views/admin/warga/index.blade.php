@extends('layouts.admin')

@section('search_placeholder', 'Cari nasabah...')
@section('page_title', 'Waste Bank Management')

@section('content')
<div class="max-w-[1300px] mx-auto space-y-6">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Daftar Tamu</h1>
            <p class="text-slate-400 text-xs font-medium mt-0.5">Catat dan pantau transaksi harian setoran sampah dari nasabah EcoBank.</p>
        </div>
        
        {{-- Tombol Tambah Transaksi yang sudah berfungsi --}}
        <a href="{{ route('admin.warga.create') }}" class="bg-[#1E5631] hover:bg-emerald-800 text-white px-4 py-2.5 rounded-xl font-bold flex items-center gap-2 transition-all active:scale-95 cursor-pointer shadow-sm">
            <i class="fa-solid fa-plus text-[10px]"></i> 
            <span class="text-sm">Tambah Transaksi</span>
        </a>
    </div>

    {{-- Statistik (Ganti $stat['val'] dengan variabel Controller nantinya) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach([
            ['label' => 'Total Nasabah Hari Ini', 'val' => $nasabahHariIni ?? 0, 'icon' => 'fa-user-plus', 'color' => 'emerald', 'unit' => ''],
            ['label' => 'Total Berat Masuk', 'val' => $totalBerat ?? 0, 'icon' => 'fa-scale-balanced', 'color' => 'emerald', 'unit' => 'kg'],
            ['label' => 'Total Koin Terbit', 'val' => $totalKoin ?? 0, 'icon' => 'fa-coins', 'color' => 'emerald', 'unit' => ''],
            ['label' => 'Perlu Verifikasi', 'val' => $perluVerifikasi ?? 0, 'icon' => 'fa-clipboard-check', 'color' => 'amber', 'unit' => '']
        ] as $stat)
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm transition-all duration-300 hover:shadow-md hover:border-emerald-100 flex flex-col justify-between h-28">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 bg-{{$stat['color']}}-50 text-{{$stat['color']}}-600 rounded-lg flex items-center justify-center text-xs">
                    <i class="fa-solid {{$stat['icon']}}"></i>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ $stat['label'] }}</span>
            </div>
            <div class="flex items-baseline gap-1 mt-1">
                <span class="text-3xl font-extrabold text-slate-900">{{ $stat['val'] }}</span>
                @if($stat['unit']) <span class="text-xs font-bold text-slate-400">{{ $stat['unit'] }}</span> @endif
            </div>
        </div>
        @endforeach
    </div>

    {{-- Tabel Data --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-3">
                <input type="date" class="bg-slate-50 border border-slate-200/60 rounded-xl px-3 py-1.5 text-xs font-semibold text-slate-700 outline-none focus:border-emerald-500 transition-colors">
                <select class="bg-slate-50 border border-slate-200/60 rounded-xl px-3 py-1.5 text-xs font-semibold text-slate-700 outline-none cursor-pointer focus:border-emerald-500 transition-colors">
                    <option value="">Semua Status</option>
                    <option value="selesai">Selesai</option>
                    <option value="proses">Proses</option>
                    <option value="pending">Pending</option>
                </select>
            </div>
            <button class="border border-slate-200 text-slate-600 hover:bg-slate-50 px-4 py-1.5 rounded-xl text-xs font-bold flex items-center gap-2 transition-all cursor-pointer">
                <i class="fa-solid fa-download text-slate-400"></i> Unduh Laporan
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-emerald-50/40 border-b border-slate-100 text-[10px] font-bold text-emerald-800 uppercase tracking-wider">
                    <tr>
                        <th class="py-4 px-6">Tanggal</th>
                        <th class="py-4 px-6">Nama Nasabah</th>
                        <th class="py-4 px-6">Jenis Sampah</th>
                        <th class="py-4 px-6 text-center">Berat (KG)</th>
                        <th class="py-4 px-6 text-center">Total Koin</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis ?? [] as $transaksi)
                        @empty
                    <tr>
                        <td colspan="7" class="py-24 text-center text-slate-400 font-medium italic text-sm">Belum ada data transaksi yang ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination Placeholder --}}
        <div class="p-4 bg-slate-50/30 border-t border-slate-100 flex justify-between items-center text-[11px] font-bold text-slate-400">
            <span>Menampilkan 0 dari 0 entri</span>
        </div>
    </div>
</div>
@endsection