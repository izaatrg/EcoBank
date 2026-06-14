@extends('layouts.admin')

@section('page_title', 'E-Struk')
@section('search_placeholder', 'Cari nomor struk...')

@section('content')
<div class="space-y-6 animate-fade-in">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-800">Daftar E-Struk</h1>
        <p class="text-xs text-slate-400 mt-1">Pilih struk untuk melihat detail, cetak, atau bagikan.</p>
    </div>

    <form method="GET" class="flex gap-3">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nomor struk..." class="admin-input max-w-md">
        <button type="submit" class="admin-btn-primary text-xs">Cari</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($struks as $struk)
        <a href="{{ route('admin.estruck.show', $struk['nomor']) }}" class="block bg-white border border-slate-100 rounded-2xl p-5 shadow-xs hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase">Nomor Struk</p>
                    <p class="text-sm font-black text-[#1E5631] mt-1">#{{ $struk['nomor'] }}</p>
                </div>
                <i class="fa-solid fa-receipt text-emerald-200 text-2xl group-hover:text-emerald-400 transition-colors"></i>
            </div>
            <div class="mt-4 space-y-1 text-xs text-slate-500">
                <p><span class="font-bold text-slate-700">Nasabah:</span> {{ $struk['nasabah'] }}</p>
                <p><span class="font-bold text-slate-700">Tanggal:</span> {{ $struk['tanggal'] }}</p>
                <p><span class="font-bold text-slate-700">Total:</span> {{ $struk['total_setoran'] }} Koin</p>
            </div>
            <span class="inline-flex items-center gap-1 mt-4 text-xs font-bold text-emerald-700">Lihat Detail <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i></span>
        </a>
        @empty
        <div class="col-span-full py-20 text-center text-slate-400 italic bg-white rounded-2xl border border-slate-100">Belum ada data E-Struk.</div>
        @endforelse
    </div>
</div>
@endsection
