@extends('layouts.admin')

@section('page_title', 'Ringkasan Operasional')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div class="space-y-1">
            <h1 class="text-3xl font-black text-[#143E22]">Halo, Pak Budi</h1>
            <p class="text-sm font-semibold text-slate-400">Berikut ringkasan statistik Bank Sampah hari ini.</p>
        </div>
        <button class="bg-[#1E5631] hover:bg-[#143E22] text-white px-6 py-3 rounded-xl font-bold text-sm 
                       transition-all duration-300 hover:scale-105 active:scale-95 shadow-lg flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Input Sampah Baru
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @php
        $stats = [
        ['label' => 'Total Sampah Terkumpul', 'val' => '0', 'unit' => 'Kg', 'icon' => 'fa-recycle'],
        ['label' => 'Total Nasabah Aktif', 'val' => '0', 'unit' => 'Warga', 'icon' => 'fa-user'],
        ['label' => 'Koin Terdistribusi', 'val' => '0', 'unit' => 'IDR', 'icon' => 'fa-wallet'],
        ['label' => 'Total Arus Barang', 'val' => '0', 'unit' => 'Item', 'icon' => 'fa-right-left'],
        ];
        @endphp

        @foreach($stats as $s)
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm 
                    transition-all duration-300 hover:scale-[1.03] hover:shadow-md cursor-pointer group">
            <div class="flex justify-between items-start">
                <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center">
                    <i class="fa-solid {{ $s['icon'] }}"></i>
                </div>
            </div>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-4">{{ $s['label'] }}</p>
            <div class="flex items-baseline gap-1 mt-1">
                <h2 class="text-2xl font-black text-slate-800">{{ $s['val'] }}</h2>
                <span class="text-xs font-bold text-slate-400">{{ $s['unit'] }}</span>
            </div>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-8 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-sm font-bold text-slate-800">Tren Pengumpulan Mingguan</h2>
                <span class="text-[10px] font-bold text-slate-400 bg-slate-50 px-3 py-1 rounded-lg">Minggu Ini</span>
            </div>
            <div class="h-48 flex items-end justify-between gap-4">
                @foreach(['SEN','SEL','RAB','KAM','JUM','SAB','MIN'] as $hari)
                <div class="w-full flex flex-col items-center gap-2">
                    <div class="w-full bg-slate-50 rounded-t-lg h-16"></div>
                    <span class="text-[10px] font-bold text-slate-400">{{ $hari }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-4 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <h2 class="text-sm font-bold text-slate-800 mb-4">Transaksi Terbaru</h2>
            <div class="h-48 flex flex-col items-center justify-center text-slate-400 italic text-xs">Belum ada transaksi</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-8 bg-[#1E5631] p-6 rounded-2xl text-white shadow-lg">
            <h3 class="text-sm font-bold">Target Keberlanjutan</h3>
            <p class="text-[10px] text-emerald-100 mt-1">Bantu komunitas mencapai target 2 Ton sampah bulan ini.</p>
            <div class="mt-8">
                <div class="w-full bg-emerald-900 rounded-full h-2">
                    <div class="bg-emerald-400 h-2 rounded-full" style="width: 0%"></div>
                </div>
                <div class="flex justify-between text-[10px] font-bold mt-2 opacity-80"><span>0 Kg</span><span>2.000 Kg</span></div>
            </div>
        </div>

        <button class="lg:col-span-4 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm text-left
                       transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]
                       flex items-center justify-between group">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center">
                    <i class="fa-solid fa-qrcode"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-800">Scan E-Struk</h3>
                    <p class="text-[11px] text-slate-400">Validasi cepat via QR.</p>
                </div>
            </div>
            <i class="fa-solid fa-arrow-right text-slate-300 group-hover:text-emerald-600 transition-colors"></i>
        </button>
    </div>
</div>
@endsection