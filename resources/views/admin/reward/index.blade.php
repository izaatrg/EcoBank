@extends('layouts.admin')

@section('page_title', 'Tukar Koin')
@section('search_placeholder', 'Cari barang penukaran...')

@section('content')
<div class="space-y-6 animate-fade-in">
    <div class="flex flex-col lg:flex-row justify-between items-start gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Katalog Penukaran Koin</h1>
            <p class="text-xs font-medium text-slate-400 mt-1">Tukarkan koin keberlanjutan Anda dengan berbagai barang bermanfaat.</p>
        </div>
        <div class="bg-[#1E5631] p-5 rounded-2xl text-white w-full lg:w-72 shadow-lg hover:shadow-xl transition-shadow duration-300">
            <p class="text-emerald-200 text-[10px] font-bold uppercase tracking-wider">Nasabah Premium</p>
            <p class="text-[10px] text-emerald-100/80 mt-1">TOTAL KOIN TERSEDIA</p>
            <p class="text-3xl font-black mt-1">{{ number_format($totalKoin, 0, ',', '.') }} <span class="text-base font-bold">KOIN</span></p>
        </div>
    </div>

    <div class="flex flex-wrap gap-2">
        @foreach(['Semua', 'Kebutuhan Pokok', 'Alat Tulis', 'Voucher', 'Elektronik'] as $i => $cat)
            <button type="button" class="filter-pill {{ $i === 0 ? 'filter-pill-active' : '' }}">{{ $cat }}</button>
        @endforeach
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach($rewards as $item)
        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-xs hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
            <div class="relative h-36 bg-gradient-to-br from-slate-100 to-emerald-50 flex items-center justify-center">
                <i class="fa-solid fa-gift text-4xl text-emerald-200 group-hover:scale-110 transition-transform duration-300"></i>
                @if(!empty($item->badge))
                    <span class="absolute top-3 left-3 text-[9px] font-black px-2 py-1 rounded-md {{ str_contains($item->badge, 'TERBATAS') ? 'bg-red-100 text-red-700' : 'bg-emerald-600 text-white' }}">{{ $item->badge }}</span>
                @endif
            </div>
            <div class="p-4 space-y-3">
                <h3 class="font-bold text-slate-800 text-sm leading-snug">{{ $item->nama_reward }}</h3>
                <p class="text-[#1E5631] font-black text-sm">{{ number_format($item->jumlah_koin, 0, ',', '.') }} Koin</p>
                @php $pct = min(100, max(5, ($item->stok / 50) * 100)); @endphp
                <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                    <div class="h-full rounded-full {{ $item->stok <= 5 ? 'bg-red-500' : 'bg-emerald-500' }} transition-all duration-500" style="width: {{ $pct }}%"></div>
                </div>
                <p class="text-[10px] text-slate-400">Stok: {{ $item->stok }}</p>
                <button type="button" class="admin-btn-primary w-full text-xs opacity-90 hover:opacity-100" disabled>
                    <i class="fa-solid fa-cart-shopping"></i> Tukar Sekarang
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <div class="flex justify-between items-center text-xs text-slate-500 pt-2">
        <span>Menampilkan {{ $rewards->count() }} dari 32 barang penukaran</span>
        <div class="flex items-center gap-1">
            <button class="admin-btn-ghost px-3 py-1.5" disabled><i class="fa-solid fa-chevron-left"></i></button>
            <button class="w-8 h-8 rounded-lg bg-[#1E5631] text-white font-bold">1</button>
            <button class="admin-btn-ghost w-8 h-8">2</button>
            <button class="admin-btn-ghost w-8 h-8">3</button>
            <button class="admin-btn-ghost px-3 py-1.5"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
    </div>
</div>
@endsection
