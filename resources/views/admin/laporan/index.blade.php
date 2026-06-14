@extends('layouts.admin')

@section('page_title', 'Laporan')
@section('search_placeholder', 'Cari data laporan...')

@section('content')
<div class="space-y-6 animate-fade-in">
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800">Laporan Performa</h1>
            <p class="text-xs text-slate-400 mt-1">Pantau alur sampah masuk vs keluar dan performa operasional.</p>
        </div>
        <div class="flex gap-2">
            <button type="button" class="admin-btn-primary text-xs"><i class="fa-solid fa-file-pdf"></i> Unduh Laporan (PDF)</button>
            <button type="button" class="admin-btn-ghost w-10 h-10"><i class="fa-solid fa-share-nodes"></i></button>
        </div>
    </div>

    <div class="flex gap-2">
        @foreach(['Mingguan', 'Bulanan', 'Tahunan'] as $i => $tab)
            <button type="button" class="filter-pill {{ $i === 0 ? 'filter-pill-active' : '' }}">{{ $tab }}</button>
        @endforeach
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
        <div class="xl:col-span-8 bg-white border border-slate-100 rounded-2xl p-6 shadow-xs hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-sm font-bold text-slate-800">Alur Sampah Masuk vs Keluar</h3>
                <div class="flex gap-4 text-[10px] font-bold">
                    <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-[#1E5631]"></span> Masuk</span>
                    <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-emerald-300"></span> Keluar</span>
                </div>
            </div>
            <div class="h-56 bg-gradient-to-t from-emerald-50/80 to-transparent rounded-xl border border-dashed border-emerald-100 flex items-end justify-around px-4 pb-4">
                @foreach(['Sen','Sel','Rab','Kam','Jum','Sab','Min'] as $day)
                    <div class="flex flex-col items-center gap-2 group">
                        <div class="w-8 bg-[#1E5631]/70 rounded-t-md group-hover:bg-[#1E5631] transition-colors" style="height: {{ rand(40, 120) }}px"></div>
                        <div class="w-8 bg-emerald-300/70 rounded-t-md" style="height: {{ rand(20, 80) }}px"></div>
                        <span class="text-[10px] text-slate-400 font-bold">{{ $day }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="xl:col-span-4 space-y-4">
            <div class="bg-white border border-slate-100 rounded-2xl p-6 text-center shadow-xs hover:shadow-md transition-all duration-300">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Target Mingguan</p>
                <div class="relative w-28 h-28 mx-auto my-4">
                    <svg class="w-full h-full -rotate-90" viewBox="0 0 36 36">
                        <circle cx="18" cy="18" r="15.9" fill="none" stroke="#E8F9EE" stroke-width="3"/>
                        <circle cx="18" cy="18" r="15.9" fill="none" stroke="#1E5631" stroke-width="3" stroke-dasharray="{{ $targetPersen }}, 100" stroke-linecap="round"/>
                    </svg>
                    <span class="absolute inset-0 flex items-center justify-center text-xl font-black text-[#1E5631]">{{ $targetPersen }}%</span>
                </div>
                <p class="text-xs text-slate-500">Target 5.000 Kg</p>
            </div>
            <div class="bg-[#1E5631] rounded-2xl p-5 text-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                <p class="text-[10px] font-bold uppercase tracking-wider text-emerald-200">Total Tabungan</p>
                <p class="text-2xl font-black mt-2">{{ $totalTabungan }}</p>
                <p class="text-[10px] text-emerald-200 mt-2 flex items-center gap-1"><i class="fa-solid fa-arrow-up"></i> +12.4% vs Bulan Lalu</p>
                <i class="fa-solid fa-wallet float-right -mt-8 text-3xl text-white/20"></i>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-xs">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-sm font-bold text-slate-800">Detail Transaksi Sampah</h3>
            <a href="#" class="text-xs font-bold text-emerald-700 hover:underline">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="text-[10px] font-bold text-slate-400 uppercase border-b border-slate-100">
                        <th class="py-3 px-2">Kategori</th>
                        <th class="py-3 px-2">Total Masuk</th>
                        <th class="py-3 px-2">Total Keluar</th>
                        <th class="py-3 px-2">Stok Gudang</th>
                        <th class="py-3 px-2">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($kategoriLaporan as $row)
                    <tr class="hover:bg-emerald-50/30 transition-colors duration-200">
                        <td class="py-3 px-2 font-semibold text-slate-700"><i class="fa-solid fa-recycle text-emerald-600 mr-2"></i>{{ $row['nama'] }}</td>
                        <td class="py-3 px-2">{{ $row['masuk'] }}</td>
                        <td class="py-3 px-2">{{ $row['keluar'] }}</td>
                        <td class="py-3 px-2">{{ $row['stok'] }}</td>
                        <td class="py-3 px-2">
                            <span class="status-badge status-{{ $row['color'] }}">{{ $row['status'] }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($stats as $stat)
        <div class="bg-white border border-slate-100 rounded-2xl p-5 flex items-center gap-4 hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-lg"><i class="fa-solid {{ $stat['icon'] }}"></i></div>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase">{{ $stat['label'] }}</p>
                <p class="text-lg font-black text-slate-800">{{ $stat['value'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
